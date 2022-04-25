<template>
  <!-- Modal -->
  <div class="modal fade" id="MBranchEditCreate" ref="MBranchEditCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{ title }} - {{ !isNull(data) ? "Edit" : "Create" }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal" aria-label="Close"></button>
        </div>

        <form class="">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-12">
                <label for="inputUserName" class="form-label">ID</label>
                <input type="text" v-model="form.branch" class="form-control" id="inputUserName" placeholder="" :disabled="!isNull(data)" />
                <has-error :form="form" field="branch"></has-error>
              </div>
              <div class="col-12">
                <label for="inputName" class="form-label">Full Description</label>
                <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="" />
                <has-error :form="form" field="name"></has-error>
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
import Form from "vform";
export default {
  name: "MBranchEditCreate",
  data() {
    return {
      title: "Company/Branch",

      form: new Form({
        trnmode: "",
        trntype: "",
        branch: "",
        name: "",
        id: "",
      }),
    };
  },
  computed: {
    ...mapState(["data"]),
  },
  mounted() {},
  created() {
    this.$root.$refs.MBranchEditCreate = this;
  },
  methods: {
    handleSubmitUpdate() {
      this.form.trnmode = "updateBranch";
      this.form.trntype = "update";
      this.form
        .post("/api/auth/branch")
        .then((res) => {
          this.ToastSuccess("Successfully Updated");
          this.form.reset();
          this.$root.$refs.BranchMain.onLoad();
          this.closeModal();
        })
        .catch((err) => {});
    },
    handleSubmit() {
      this.form.trnmode = "storeBranch";
      this.form.trntype = "create";
      this.form
        .post("/api/auth/branch")
        .then((res) => {
          this.ToastSuccess("Added Updated");
          this.closeModal();
          this.form.reset();
          this.$root.$refs.BranchMain.onLoad();
        })
        .catch((err) => {});
    },
    closeModal() {
      $("#MBranchEditCreate").modal("hide");
      this.form.reset();
      this.$store.dispatch("Data", {
        data: "",
      });
    },
    onLoad() {
      this.form.fill(this.data);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
