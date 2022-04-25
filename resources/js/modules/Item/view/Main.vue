<template>
  <div class="full-height d-flex align-items-stretch" data-aos="zoom-in">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "ItemMain",
  middleware: "auth",
  layout: "auth",
  data() {
    return {
      pagename: "Item",
      rows: [],
    };
  },
  metaInfo() {
    return {
      title: this.pagename,
    };
  },
  mounted() {
    this.hasAccess("items-*");
    this.rows = [
      {
        level: 0,
        label: "File",
        href: "#void",
        access: true,
        databstoggle: "dropdown",
        childs: [
          {
            level: 1,
            label: "New Item",
            // modal: "MItemCreate",
            // databstoggle: "modal",
            // databstarget: "#MItemCreate",
            access: this.can("items-create"),
          },
          {
            level: 1,
            label: "List of Item",
            to: "list",
            access: this.can("items-access"),
          },
        ],
      },
    ];

    this.$store.dispatch("Menu", {
      menu: this.rows,
    });

    this.$store.dispatch("MenuName", {
      menuname: ["Items", "List"],
    });
  },

  beforeDestroy: function () {
    this.$store.dispatch("Menu", {
      menu: [],
    });
  },
};
</script>

<style lang="scss" scoped>
</style>
