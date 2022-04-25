<template>
  <!-- Modal -->
  <div class="modal fade" id="MModalBranch" ref="MModalBranch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Branch</h5>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
          <div class="list-group" v-if="data">
            <a v-for="item in data" :key="item.id" :class="select === item.id ? 'active' : ''" @dblclick="handleDBClick(item)" @click="handleClick(item, item.id)" class="list-group-item list-group-item-action" aria-current="true">{{ item.name }}</a>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
          <button type="button" class="btn btn-primary" @click="handleClickSubmit">Submit</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import Form from "vform";
export default {
  name: "MModalBranch",
  data() {
    return {
      title: "Company/Branch",
      select: 999,
      branch: null,
    };
  },
  computed: {
    ...mapState({ data: (state) => (state.Auth.user ? state.Auth.user.companylist : 0) }),
  },
  created() {
    this.$root.$refs.MModalBranch = this;
  },
  mounted() {
    // data.user.companylist
    var x = localStorage.getItem("branch");
    if (this.isNull(x)) {
      $("#MModalBranch").modal("show");
    }
  },
  methods: {
    handleDBClick(data) {
      this.branch = data;
      this.handleClickSubmit();
    },
    handleClick(data, i) {
      this.select = i;
      this.branch = data;
    },
    handleClickSubmit() {
      if (this.branch) {
        localStorage.setItem("branch", JSON.stringify(this.branch));
        this.isUser.company = this.branch;
        this.$store.dispatch("Auth/updateUser", { user: this.isUser });
        this.closeModal();
      } else {
        this.ToasError("Please Select Branch/Company");
      }
    },
    closeModal() {
      var x = localStorage.getItem("branch");
      if (this.isNull(x)) {
        this.autologout();
      }
      $("#MModalBranch").modal("hide");
    },
  },
};
</script>

<style>
</style>