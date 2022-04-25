<template>
  <div class="page-wrapper chiller-theme toggled">
    <MModalBranch />
    <modals ref="modalLoop" v-for="(data, i) in menu" :item="data" :key="i" />
    <sidebar :menu="menuMenu" />
    <main class="page-content pt-0">
      <AuthNavbar />
      <div class="container-fluid ps-0">
        <div class="content-box" id="content-box">
          <breadcrumb />
          <router-view />
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "BasicLayout",
  data() {
    return {};
  },
  computed: {
    ...mapState(["menu"]),
    menuMenu() {
      return [
        "General",
        [
          {
            to: "/items",
            label: "Items",
            icon: "fa-handshake",
            alt: "Payroll",
            access: this.can("items-access"),
          },
          {
            to: "/user",
            label: "DTR",
            icon: "fa-table",
            alt: "Dailt time record",
            // access: this.can("users-access"),
          },
          {
            to: "/user",
            label: "OB/OT",
            icon: "fa-bus",
            alt: "Official Business/Over Time",
            // access: this.can("users-access"),
          },
          {
            to: "/employee",
            label: "Employee",
            icon: "fa-book",
            alt: "Employees record",
            access: this.can("employee-access"),
            // child: [{
            //     to: "/user",
            //     label: "User",
            //     // access: this.can("users-access"),
            // }, {
            //     to: "/user",
            //     label: "User",
            //     // access: this.can("users-access"),
            // }, ],
            // access: this.can("employee-access"),
          },
          {
            to: "/user",
            label: "User",
            icon: "fa-users",
            alt: "User record",
            access: this.can("users-access"),
          },
        ],
        "Setup",
        [
          {
            to: "/acl",
            label: "Access Control List",
            icon: "fa-wrench",
            access: this.can("acl-access"),
          },
          {
            to: "/lookup",
            label: "Lookup",
            icon: "fa-window-restore",
            access: this.can("lookup-access"),
          },
        ],
      ];
    },
  },
  methods: {},
  mounted() {
    $('<script src="/js/scripts.js"></' + "script>").appendTo(document.body);
    $("head").append('<link href="/css/theme.css" rel="stylesheet">');

    this.$store.dispatch("Acl/fetchAcl", {
      trnmode: "fetchRole",
      trntype: "fetch",
    });
    this.$store.dispatch("Branch/fetchBranch", {
      trnmode: "fetchBranch",
      trntype: "fetch",
    });

    this.$store.dispatch("Lookup/fetchLookup", {
      trnmode: "fetchLookup",
      trntype: "fetch",
    });
    var x = localStorage.getItem("branch");

    if (this.isNull(x)) {
      $("#MModalBranch").modal("show").css("background-color", "gray");
    } else {
      this.isUser.company = JSON.parse(x);

      this.$store.dispatch("Auth/updateUser", { user: this.isUser });
    }
  },
  destroyed() {
    // $(document.body).removeTo('<script src="/js/scripts.js"></' + 'script>');
    // $('head').remove('<link href="/css/theme.css" rel="stylesheet">');
  },
};
</script>

<style lang="scss" scoped>
</style>
