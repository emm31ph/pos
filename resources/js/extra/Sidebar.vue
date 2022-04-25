<template>
  <div>
    <a id="show-sidebar" class="btn btn-sm btn-dark" style="z-index: 1080" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <router-link to="/dashboard">TCC Group Inc.</router-link>
          <!-- <a href="/dashboard"></a> -->
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic">
            <img class="img-responsive img-rounded" src="/img/user/user.jpg" alt="User picture" />
          </div>
          <div class="user-info">
            <span class="user-name">
              {{ isUser.name }}
            </span>
            <span class="user-role" v-if="isUser.company"> {{ isUser.company.name }}</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>

        <div class="sidebar-menu">
          <template v-for="(menuGroup, index) in menu">
            <ul v-if="typeof menuGroup === 'string'" :key="index">
              <li class="header-menu">
                <span> {{ menuGroup }}</span>
              </li>
            </ul>
            <sidebar-list v-else :key="index" @menu-click="menuClick" :menu="menuGroup" />
            <!-- {{ menuGroup }} -->
          </template>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
      <div class="sidebar-footer">
        <!-- <a href="#">
          <i class="fa fa-bell"></i>
          <span class="badge bg-warning notification">3</span>
        </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge bg-success notification">7</span>
      </a>-->
        <a href="#" @click="selectBranch">
          <i class="fa fa-cog"></i>
        </a>
        <a href="#" @click="logout">
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </nav>
  </div>
</template>

<script>
import store from "~/store";
// import { mapState}  from 'vuex'

export default {
  name: "sidebar",
  props: {
    menu: {
      type: Array,
      default: () => [],
    },
  },
  data: () => ({
    // sideBarOpen: false
  }),
  watch: {
    sideBarOpen() {
      //     this.sideBarOpen = store.getters['sideBarOpen'];
    },
  },
  mounted() {
    // console.log(this.menu);
  },
  computed: {
    // ...mapState(['sideBarOpen'])
  },
  methods: {
    selectBranch() {
      // this.$store.dispatch('toggleSidebar')

      $("#MModalBranch").modal("show").css("background-color", "gray");
    },
    menuClick(item) {
      this.$emit("menu-click", item);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
