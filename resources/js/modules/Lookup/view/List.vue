<template>
  <div class="card w-100">
    <div class="card-header">
      <h5 class="card-title mb-0 d-flex justify-content-between">
        <div class="d-flex align-items-center justify-content-center">
          {{ pagename }}
        </div>
        <!-- <download-excel :fetch="fetchData" :fields="json_fields" worksheet="My Worksheet" name="filename.xls" class="btn btn-sm btn-outline-primary">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z" />
          </svg>
        </download-excel> -->
      </h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-3">
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th scope="col">List</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(data, i) in loadData" :key="i">
                <th scope="row" @dblclick="handleRedirect(data)" @click="handleClick(data)">{{ data.fulltitle }}</th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-9">
          <div class="col-12" v-if="form.code != ''">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">lookup ({{ form.code }})</label>
              <input type="text" class="form-control" v-model="form.lookup" :disabled="form.id != ''" />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Fulltitle</label>
              <input type="text" class="form-control" v-model="form.fulltitle" />
            </div>
            <div class="mb-3" v-if="form.code != '0001'">
              <label for="exampleFormControlTextarea1" class="form-label">Fulldesc</label>
              <textarea class="form-control" rows="2" v-model="form.fulldesc"></textarea>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-sm btn-outline-success" @click="handleSave" :disabled="form.fulltitle == ''">Save</button>
              <button type="button" class="btn btn-sm btn-outline-danger" @click="handleRemove" v-if="form.id">Remove</button>
              <button type="button" class="btn btn-sm btn-outline-info" @click="handleClear">Clear</button>
            </div>
          </div>
          <div class="col tableFixHead" style="height: 300px" v-if="data != ''">
            <table class="table table-sm table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col">Link</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, i) in data" :key="i">
                  <td @click="handleClickData(item, i)">
                    {{ item.fulltitle }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
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
  name: "LookupMain",
  middleware: "auth",
  layout: "auth",
  data() {
    return {
      pagename: "Lookup",
      data: [],
      description: "",
      index: "",
      form: new Form({
        trnmode: "",
        trntype: "",
        id: "",
        code: "",
        lookup: "",
        fulltitle: "",
        fulldesc: "",
      }),
    };
  },
  metaInfo() {
    return {
      title: this.pagename,
    };
  },
  mounted() {
    // this.hasAccess("settings-*");
    this.$store.dispatch("MenuName", {
      menuname: ["Lookup", "List"],
    });

    this.currentPage = 1;
    bus.$on("send", (data) => {
      this.query = data;
    });
    
    this.onLoad();
  },
  created() {
    this.$root.$refs.LookupMain = this;
  },
  methods: {
    onLoad() {
      this.$store.dispatch("Lookup/fetchUserLookup", {
        trnmode: "fetchUserLookup",
        trntype: "fetch",
      });
    },
    handleClick(data) {
      this.form.reset();
      this.form.code = data.code;
      if (data.code == "0001") {
        this.getLoadBranch();
        const data = store.getters["Branch/list"];
        this.data = data;
      } else {
        this.description = data.fulldesc;
        this.data = data.lookup;
      }
    },
    getLoadBranch() {
      this.$store.dispatch("Branch/fetchBranch", {
        trnmode: "fetchBranch",
        trntype: "fetch",
      });
    },
    handleClickData(data, i) {
      this.index = i;
      this.form.id = data.id;
      this.form.lookup = data.lookup;
      this.form.fulltitle = data.fulltitle;
      this.form.fulldesc = data.fulldesc;
    },
    handleSave() {
      if (this.form.code == "0001") {
        this.saveBranch();
      } else {
        this.saveLookup();
      }
    },
    handleRemove() {
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
          this.data.splice(this.index, 1);

          if (this.form.code == "0001") {
            this.deleteBranch();
          } else {
            this.deleteLookup();
          }
        }
      });
    },
    deleteBranch() {
      this.form.trnmode = "deleteBranch";
      this.form.trntype = "";
      // this.form.id = this.form.id;
      this.form.post("/api/auth/branch").then((res) => {
        this.ToastSuccess("Removed Successfully");
        this.handleClear();
        this.getLoadBranch();
      });
    },
    deleteLookup() {
      this.form.trnmode = "deleteLookup";
      this.form.trntype = "";
      // this.form.id = this.form.id;
      this.form.post("/api/lookup").then((res) => {
        this.ToastSuccess("Removed Successfully");
        this.handleClear();
        this.onLoad();
      });
    },
    saveLookup() {
      this.form.trnmode = !this.isNull(this.form.id) ? "updateLookup" : "storeLookup";
      this.form.trntype = !this.isNull(this.form.id) ? "update" : "store";
      this.form
        .post("/api/lookup")
        .then((res) => {
          this.ToastSuccess("Successfully Save");
          this.handleClear();
          this.onLoad();

          this.data.splice(this.index, 1);
          this.data.push({ id: res.data.id, lookup: res.data.lookup, fulltitle: res.data.fulltitle, fulldesc: res.data.fulldesc });
        })
        .catch((err) => {});
    },
    saveBranch() {
      this.form.trnmode = !this.isNull(this.form.id) ? "updateBranch" : "storeBranch";
      this.form.trntype = !this.isNull(this.form.id) ? "update" : "store";
      this.form
        .post("/api/auth/branch")
        .then((res) => {
          this.ToastSuccess("Successfully Save");
          this.data.splice(this.index, 1);
          // console.log(res.data[0]);
          this.data.push({ id: res.data[0].id, lookup: res.data[0].lookup, fulltitle: res.data[0].fulltitle, fulldesc: res.data[0].fulldesc });
          this.handleClear();
          this.getLoadBranch();
        })
        .catch((err) => {});
    },
    handleClear() {
      this.form.id = "";
      this.form.lookup = "";
      this.form.fulltitle = "";
      this.form.fulldesc = "";
    },
    handleRedirect(data) {
      this.$router
        .push({
          name: data.to,
        })
        .catch(() => {});
    },
  },
  computed: {
    loadData() {
      const data = store.getters["Lookup/userlist"] ? store.getters["Lookup/userlist"] : "";
      if (store.getters["Lookup/userlist"] != "undefined ") {
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

<style lang="scss" scoped>
</style>
