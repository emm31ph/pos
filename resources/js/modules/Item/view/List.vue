<template>
  <div class="card w-100 full-height d-flex align-items-stretch" data-aos="zoom-in">
    <div class="card-header">
      <h5 class="card-title mb-0 d-flex justify-content-between">
        <div class="d-flex align-items-center justify-content-center">
          {{ pagename }}
        </div>
        <download-excel :fetch="fetchData" :fields="json_fields" worksheet="My Worksheet" name="filename.xls" class="btn btn-sm btn-outline-primary">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z" />
          </svg>
        </download-excel>
      </h5>
    </div>

    <div class="card-body tableFixHead">
      <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th scope="col" v-bind:class="[sortBy === 'id' ? sortDirection : '']" @click="sort('id')">#</th>
            <th scope="col" v-bind:class="[sortBy === 'itemcode' ? sortDirection : '']" @click="sort('itemcode')">Itemcode</th>
            <th scope="col" v-bind:class="[sortBy === 'fulltitle' ? sortDirection : '']" @click="sort('fulltitle')">Fulltitle</th>
            <th scope="col" v-bind:class="[sortBy === 'fulldesc' ? sortDirection : '']" @click="sort('fulldesc')">Fulldesc</th>
            <th scope="col" v-bind:class="[sortBy === 'uom' ? sortDirection : '']" @click="sort('uom')">UOM</th>
            <th scope="col" v-bind:class="[sortBy === 'barcode' ? sortDirection : '']" @click="sort('barcode')">Barcode</th>
            <th scope="col" v-bind:class="[sortBy === 'status' ? sortDirection : '']" @click="sort('status')" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(data, i) in filterData" :key="i">
            <th scope="row">{{ data.id }}</th>
            <td>{{ data.itemcode }}</td>
            <td>{{ data.fulltitle }}</td>
            <td>{{ data.fulldesc }}</td>
            <td>{{ data.uom }}</td>
            <td>{{ data.barcode }}</td>
            <td class="text-center">
              <span class="badge" :class="data.status == '000' ? 'bg-success' : 'bg-danger'">{{ data.status == "000" ? "Active" : "Remove" }}</span>
            </td>
            <td class="text-center">
              <a @click="handleEdit(data)" data-bs-target="#MUserCreate" data-bs-toggle="modal" class="btn btn-sm btn-primary" v-if="can('users-update') && data.status == '000'">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a @click="handleDelete(data)" class="btn btn-sm btn-danger" v-if="can('items-delete') && data.status == '000'">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <pagination v-if="loadData" v-model="currentPage" :page-count="totalPages" />
    </div>
  </div>
</template>

<script>
import bus from "../../../EventBus";
import store from "~/store";
import Form from "vform";
export default {
  name: "ItemMain",
  middleware: "auth",
  layout: "auth",
  data() {
    return {
      pagename: "Item",
      json_fields: {
        Name: "name",
        Username: "username",
        "Email Address": "email",
        status: {
          field: "status",
          callback: (value) => {
            return value == "01" ? "Active" : "Remove";
          },
        },
      },

      form: new Form({
        trnmode: "",
        trntype: "",
        id: "",
      }),
    };
  },
  metaInfo() {
    return {
      title: this.pagename,
    };
  },
  mounted() {
    this.hasAccess("users-access");
    this.$store.dispatch("MenuName", {
      menuname: ["Item", "List"],
    });

    this.currentPage = 1;
    bus.$on("send", (data) => {
      this.query = data;
    });
    this.onLoad();
  },
  created() {
    this.$root.$refs.ItemMain = this;
  },
  methods: {
    handleEdit(data) {
      // $("#MUserCreate").modal("show");
      // this.$store.dispatch("Data", {
      //   data: data,
      // });
    },
    handleDelete(data) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form.trnmode = "deleteItem";
          this.form.trntype = "delete";
          this.form.itemcode = data.itemcode;
          this.form.post("/api/auth/item").then((res) => {
            this.ToastSuccess("Removed Successfully");
            this.onLoad();
          });
        }
      });
    },
    onLoad() {
      this.$store.dispatch("Item/fetchItem", {
        trnmode: "fetchItem",
        trntype: "get",
      });
    },
    async fetchData() {
      let da = await axios.get("/api/auth/user", {
        params: {
          trnmode: "fetchUser",
          trntype: "get",
        },
      });

      return da.data;
    },
  },
  computed: {
    loadData() {
      const data = store.getters["Item/list"] ? store.getters["Item/list"] : "";
      if (store.getters["Item/list"] != "undefined ") {
        this.$emit("change", this.query);
        if (!this.query == "") {
          return data
            .filter((item) => {
              if (
                item["fulltitle"]
                  .toLowerCase()
                  // .startsWith(this.query) //search start left side
                  .includes(this.query.toLowerCase())
              ) {
                return (
                  item["fulltitle"]
                    .toLowerCase()
                    // .startsWith(this.query) //search start left side
                    .includes(this.query.toLowerCase())
                );
              }
              if (
                item["fulldesc"]
                  .toLowerCase()
                  // .startsWith(this.query) //search start left side
                  .includes(this.query.toLowerCase())
              ) {
                return (
                  item["fulldesc"]
                    .toLowerCase()
                    // .startsWith(this.query) //search start left side
                    .includes(this.query.toLowerCase())
                );
              }
            })
            .sort((p1, p2) => {
              let modifier = 1;
              if (p1[this.sortBy] != undefined) {
                if (this.sortDirection === "desc") modifier = -1;
                if (parseInt(p1[this.sortBy])) {
                  if (p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier;
                  if (p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
                } else {
                  if (p1[this.sortBy].toString().toLowerCase() < p2[this.sortBy].toString().toLowerCase()) return -1 * modifier;
                  if (p1[this.sortBy].toString().toLowerCase() > p2[this.sortBy].toString().toLowerCase()) return 1 * modifier;
                }
              }
              return 0;
            });
        } else {
          // return Object.keys(data).map((itemcode) => data[itemcode]);
          return Object.keys(data)
            .map((name) => data[name])
            .sort((p1, p2) => {
              let modifier = 1;
              if (p1[this.sortBy] != undefined) {
                if (this.sortDirection === "desc") modifier = -1;
                if (parseInt(p1[this.sortBy])) {
                  if (p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier;
                  if (p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
                } else {
                  if (p1[this.sortBy].toString().toLowerCase() < p2[this.sortBy].toString().toLowerCase()) return -1 * modifier;
                  if (p1[this.sortBy].toString().toLowerCase() > p2[this.sortBy].toString().toLowerCase()) return 1 * modifier;
                }
              }
              return 0;
            });
        }
      }

      return false;
    },
    filterData() {
      var page = this.currentPage;
      var perPage = this.dataPerPage;
      var from = page * perPage - perPage;
      var to = page * perPage;
      return this.loadData.slice(from, to);
    },
    totalPages() {
      return Math.ceil(this.loadData.length / this.dataPerPage);
    },
  },
};
</script>

<style lang="scss" scoped></style>
