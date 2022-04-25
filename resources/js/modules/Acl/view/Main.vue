<template>
<div class="full-height d-flex align-items-stretch" data-aos="zoom-in">

    <router-view></router-view>
  
</div>
</template>

<script>
 
 export default {
     name: "AclMain",
     middleware: "auth",
     layout: "auth",
     data() {
         return {
             pagename: "ACL",
             rows:[],
         };
     },
     metaInfo() {
         return {
             title: this.pagename
         };
     },
     mounted() {
         // this.hasAccess("settings-*");
         this.rows = [{
             level: 0,
             label: "File",
             href: "#void",
             access: true,
             databstoggle: "dropdown",
             childs: [{
                     level: 1,
                     label: "New Role",
                     modal : 'MAclCreate',
                     databstoggle: "modal",
                     databstarget: "#MAclCreate",
                     access: this.can("acl-create"),
                 },
                 {
                     level: 1,
                     label: "List of Role",
                     to: "list",
                     access: this.can("acl-access"),
                 }
             ],
         }];

         this.$store.dispatch("Menu", {
             menu: this.rows
         });

         this.$store.dispatch("MenuName", {
             menuname: ['ACL', 'List']
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
