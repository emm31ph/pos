<template>
<div class="full-height d-flex align-items-stretch" data-aos="zoom-in">
    <router-view></router-view>
</div>
</template>

<script>
 
 export default {
     name: "BranchMain",
     middleware: "auth",
     layout: "auth",
     data() {
         return {
             pagename: "Branch",
             rows:[],
         };
     },
     metaInfo() {
         return {
             title: this.pagename
         };
     },
     mounted() {
         this.hasAccess("branch-*");
         this.rows = [{
             level: 0,
             label: "File",
             href: "#void",
             access: true,
             databstoggle: "dropdown",
             childs: [{
                     level: 1,
                     label: "New Branch",
                     modal : 'MBranchEditCreate',
                     databstoggle: "modal",
                     databstarget: "#MBranchEditCreate",
                     access: this.can("branch-create"),
                 },
                 {
                     level: 1,
                     label: "List of Branch",
                     to: "list",
                     access: this.can("branch-access"),
                 }
             ],
         }];

         this.$store.dispatch("Menu", {
             menu: this.rows
         });

         this.$store.dispatch("MenuName", {
             menuname: ['Branch', 'List']
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
