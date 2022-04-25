import Vue from 'vue'
import store from '~/store'
import axios from 'axios'

Vue.mixin({
    computed: {
        getRole() {
            const data = store.getters['Acl/list']
            if (data) {
                return data
            }
            return false
        },
        getPermission() {
            const data = store.getters['Acl/perm_list']
            if (data) {
                return data
            }
            return false
        },
    },
    methods: {
        can(permission) {

            const authUser = store.getters['Auth/user'];
            if (this.isNull(authUser)) { return false; };

            if (authUser.role !== undefined || this.isNull(authUser)) {

                if (authUser != null) {
                    const uPermission = authUser.role;
                    if (Array.isArray(permission)) {
                        var i;
                        for (i = 0; i < permission.length; i++) {
                            const aa = uPermission.filter(function(item) {
                                return (item["name"].toLowerCase().startsWith(permission[i].replace("*", "")))
                            });

                            if (aa.length) {
                                return true;
                            }
                        }

                    } else {
                        const aa = uPermission.filter(function(item) {
                            return (item["name"].toLowerCase().startsWith(permission.replace("*", "")))
                        });

                        if (aa.length) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }

            return false;
        },
        hasAccess(permission) {

            const authUser = store.getters['Auth/user'];
            if (authUser != null) {
                const uPermission = authUser.role;

                if (Array.isArray(permission)) {
                    var i;
                    for (i = 0; i < permission.length; i++) {
                        const aa = uPermission.filter(function(item) {
                            return (item["name"].toLowerCase().startsWith(permission[i].replace("*", "")))
                        });

                        if (aa.length) {
                            return true;
                        }
                    }

                } else {
                    const aa = uPermission.filter(function(item) {
                        return (item["name"].toLowerCase().startsWith(permission.replace("*", "")))
                    });

                    if (aa.length) {
                        return true;
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            toast: true,
                            title: 'you don\'t have permission',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        this.$router.go(-1)
                    }
                }
            }
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                toast: true,
                title: 'you don\'t have permission',
                showConfirmButton: false,
                timer: 2500
            })
            this.$router.go(-1)
        },
    }
})