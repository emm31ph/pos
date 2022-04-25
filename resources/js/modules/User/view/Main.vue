<template>
<div class="full-height d-flex align-items-stretch" data-aos="zoom-in">
    <router-view></router-view>
   
</div>
</template>

<script>
 
export default {
    name: "UserMain",
    middleware: "auth",
    layout: "auth",
    data() {
        return {
            pagename: "User",
            rows: [],
        };
    },
    metaInfo() {
        return {
            title: this.pagename
        };
    },
    mounted() {
        this.hasAccess("users-*");
        this.rows = [{
            level: 0,
            label: "File",
            href: "#void",
            access: true,
            databstoggle: "dropdown",
            childs: [{
                    level: 1,
                    label: "New User",
                    modal: 'MUserCreate',
                    databstoggle: "modal",
                    databstarget: "#MUserCreate",
                    access: this.can("users-create"),
                },
                {
                    level: 1,
                    label: "List of User",
                    to: "list",
                    access: this.can("users-access"),
                }
            ],
        }];

        this.$store.dispatch("Menu", {
            menu: this.rows
        });

        this.$store.dispatch("MenuName", {
            menuname: ['User', 'List']
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
