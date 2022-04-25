<template>
<div class="full-height d-flex align-items-stretch" data-aos="zoom-in">
    <router-view></router-view>
   
</div>
</template>

<script>
 
export default {
    name: "EmployeeMain",
    middleware: "auth",
    layout: "auth",
    data() {
        return {
            pagename: "Employee",
            rows: [],
        };
    },
    metaInfo() {
        return {
            title: this.pagename
        };
    },
    mounted() {
        this.hasAccess("employee-access");
        this.rows = [{
            level: 0,
            label: "File",
            href: "#void",
            access: true,
            databstoggle: "dropdown",
            childs: [{
                    level: 1,
                    label: "New Employee",
                    to:'create',
                    // modal: 'MEmployeeCreate',
                    // databstoggle: "modal",
                    // databstarget: "#MEmployeeCreate",
                    access: this.can("employee-create"),
                },
                {
                    level: 1,
                    label: "List of Employee",
                    to: "list",
                    access: this.can("employee-access"),
                }
            ],
        }];

        this.$store.dispatch("Menu", {
            menu: this.rows
        });

        this.$store.dispatch("MenuName", {
            menuname: ['Employee']
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
