<template>
  <!-- Modal -->
  <div class="modal fade" id="MAclCreate" ref="usercreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{ title }} - {{ !isNull(data) ? "Edit" : "Create" }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal" aria-label="Close"></button>
        </div>

        <form class="">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-6">
                <div class="row">
                  <div class="col-12">
                    <label for="inputName" class="form-label">Slug</label>
                    <input type="text" v-model="form.name" class="form-control" placeholder="" :disabled="data" />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="col-12">
                    <label for="inputName" class="form-label">Display Name</label>
                    <input type="text" v-model="form.display_name" class="form-control" placeholder="" />
                    <has-error :form="form" field="display_name"></has-error>
                  </div>
                  <div class="col-12">
                    <label for="inputName" class="form-label">Description</label>
                    <textarea rows="5" style="height: 100%" v-model="form.description" class="form-control" placeholder=""></textarea>
                    <has-error :form="form" field="description"></has-error>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <label for="inputUserName" class="form-label">Permissions</label>
                <div style="max-height: 400px; overflow-y: scroll; width: auto">
                  <table class="table is-striped is-hoverable is-fullwidth is-narrow">
                    <tbody data-aos="fade-down" data-aos-delay="1500">
                      <tr v-for="(item, i) in loadData" :key="i">
                        <td>
                          <label class="checkbox">
                            <input type="checkbox" :value="item.id" v-model="form.permission" :id="item.id" />
                            {{ item.display_name }}
                          </label>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <has-error :form="form" field="permission"></has-error>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeModal">Close</button>
            <button type="button" class="btn btn-primary" @click="handleSubmitUpdate" :disabled="form.busy" v-if="!isNull(data)">Update</button>
            <button type="button" class="btn btn-primary" @click="handleSubmit" :disabled="form.busy" v-if="isNull(data)">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

import store from "~/store";
import Form from "vform";
export default {
  name: "MAclCreate",
  data() {
    return {
      title: "Role",
      form: new Form({
        trnmode: "",
        trntype: "",
        id: "",
        name: "",
        display_name: "",
        description: "",
        permission: [],
      }),
    };
  },
  computed: {
    ...mapState(["data"]),
    loadData() {
      const data = store.getters["Acl/perm_list"] ? store.getters["Acl/perm_list"] : "";
      return data;
    },
  },
  mounted() {},
  created() {
    this.$root.$refs.MAclCreate = this;
  },
  methods: {
    handleSubmitUpdate() {
      this.form.trnmode = "updateAcl";
      this.form.trntype = "update";
      this.form
        .post("/api/auth/acl")
        .then((res) => {
          this.ToastSuccess("Successfully Updated");
          this.form.reset();
          this.$root.$refs.AclList.onLoad();
          $("#MAclCreate").modal("hide");
        })
        .catch((err) => {});
    },
    handleSubmit() {
      this.form.trnmode = "storeRole";
      this.form.trntype = "create";
      this.form
        .post("/api/auth/acl")
        .then((res) => {
          this.ToastSuccess("Successfully Added");
          this.form.reset();
          this.$root.$refs.AclList.onLoad();
          $("#MAclCreate").modal("hide");
        })
        .catch((err) => {});
    },
    closeModal() {
      $("#MAclCreate").modal("hide");
      this.form.reset();
      this.$store.dispatch("Data", {
        data: "",
      });
    },
    onLoad() {
      this.form.fill(this.data);
      this.form.permission = this.pluck(this.data.permissions, "id");
    },
  },
  beforeDestroy: function () {
    this.$store.dispatch("Acl/updateAcl", {
      list: [],
    });
  },
};
</script>

<style lang="scss" scoped>
</style>
