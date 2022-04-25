<template>
  <!-- Modal -->
  <div class="modal fade" id="MUserCreate" ref="usercreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{ title }} - {{ !isNull(data) ? "Edit" : "Create" }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal" aria-label="Close"></button>
        </div>

        <form class="">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-12">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="" />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="col-12">
                <label for="inputUserName" class="form-label">Username</label>
                <input type="text" v-model="form.username" class="form-control" id="inputUserName" placeholder="" :disabled="!isNull(data)" />
                <has-error :form="form" field="username"></has-error>
              </div>
              <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" v-model="form.email" class="form-control" id="inputEmail4" />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" v-model="form.password" class="form-control" id="inputPassword4" />
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="col-md-6">
                <label for="inputState" class="form-label">Branch/Company</label>
                <multi-select v-if="branch2" :index="100" v-model="form.branch" v-bind:options="branch2" display-property="fulltitle" value-property="id" class="form-select" />
                <has-error :form="form" field="branch"></has-error>
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Roles</label>
                <multi-select v-if="getRoless" :index="900" v-model="form.role" v-bind:options="getRoless" display-property="name" value-property="id" class="form-select" />
                <has-error :form="form" field="role"></has-error>
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
  name: "MUserCreate",
  data() {
    return {
      title: "User",

      form: new Form({
        trnmode: "",
        trntype: "",
        id: "",
        name: "",
        username: "",
        email: "",
        password: "",
        role: [],
        selectedOptionsBranch: [],
      }),
    };
  },
  computed: {
    // ...mapState(["data"], { branch2: (state) => state.Branch }),
    ...mapState({ data: (state) => state.data, branch2: (state) => state.Branch.list, getRoless: (state) => state.Acl.list }),
  },
  mounted() {},
  created() {
    this.$root.$refs.MUserCreate = this;
  },
  methods: {
    handleSubmitUpdate() {
      this.form.trnmode = "updateUser";
      this.form.trntype = "update";
      this.form
        .post("/api/auth/user")
        .then((res) => {
          this.ToastSuccess("Successfully Updated!");
          this.form.reset();
          this.$root.$refs.UserMain.onLoad();
          this.closeModal();
        })
        .catch((err) => {});
    },
    handleSubmit() {
      this.form.trnmode = "storeUser";
      this.form.trntype = "create";
      this.form
        .post("/api/auth/user")
        .then((res) => {
          this.ToastSuccess("Successfully Added");
          this.form.reset();
          this.$root.$refs.UserMain.onLoad();
          this.$store.dispatch("Data", { data: "" });
          this.closeModal();
        })
        .catch((err) => {});
    },
    closeModal() {
      $("#MUserCreate").modal("hide");
      this.form.reset();
      this.$store.dispatch("Data", {
        data: "",
      });
    },
    onLoad() {
      // this.$nextTick(() => {
      // let roleid = this.data.roles.map(function (item) {
      //   return item.id;
      // });
      // let branchid = this.data.mybranch.map(function (item) {
      //   return item.id;
      // });
      // this.form.reset();
      // this.form.fill(this.data);
      // this.form.role = roleid;
      // this.form.branch = branchid;
      // });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
