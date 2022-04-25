<template>
<div class="full-height d-flex align-items-stretch" data-aos="zoom-in">

    <router-view></router-view>

</div>
</template>

<script>
export default {
    name: "LookupMain",
    middleware: "auth",
    layout: "auth",
    data() {
        return {
            pagename: "Lookup",
            rows: [],
        };
    },
    metaInfo() {
        return {
            title: this.pagename
        };
    },
    mounted() {
    //  this.hasAccess("lookup-*");
         this.rows = [{
             level: 0,
             label: "File",
             href: "#void",
             access: true,
             databstoggle: "dropdown",
             childs: [{
                     level: 1,
                     label: "New Lookup",
                    //  modal : 'MUserCreate',
                    //  databstoggle: "modal",
                    //  databstarget: "#MUserCreate",
                     access: this.can("lookup-create"),
                 },
                 {
                     level: 1,
                     label: "List of Lookup",
                     to: "list",
                     access: this.can("lookup-access"),
                 }
             ],
         }];

         this.$store.dispatch("Menu", {
             menu: this.rows
         });

         this.$store.dispatch("MenuName", {
             menuname: ['Lookup', 'List']
         });

     },

   
     beforeDestroy: function () {
         this.$store.dispatch("Menu", {
             menu: []
         });
     }
}
</script>

<style lang="scss" scoped>

</style>
