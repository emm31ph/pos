import Vue from "vue";
import store from "~/store";
import axios from "axios";

const mixinsContext = require.context("~/modules/", true, /\/.*mixins.js$/);

mixinsContext.keys().forEach((fileName) => {
    import("~/modules/" + fileName.replace("./", ""));
});
Vue.mixin({
    data() {
        return {
            query: "",
            page: 1,
            currentPage: 1,
            dataPerPage: 15,
            sortBy: "",
            sortDirection: "desc",
        };
    },
    matches() {
        this.$emit("change", this.query);
        if (this.query == "") {
            return [];
        }
    },
    computed: {
        isUser: function () {
            const user = store.getters["Auth/user"];
            if (user) {
                return user;
            }
            return false;
        },
    },
    methods: {
        ToastSuccess(data) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });

            Toast.fire({
                icon: "success",
                title: data,
            });
        },
        ToasError(data) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });

            Toast.fire({
                icon: "error",
                title: data,
            });
        },
        sort: function (s) {
            if (s.toLowerCase() === this.sortBy) {
                this.sortDirection =
                    this.sortDirection === "asc" ? "desc" : "asc";
            }
            this.sortBy = s;
        },

        pluck(objs, name) {
            var sol = [];
            for (var i in objs) {
                if (objs[i].hasOwnProperty(name)) {
                    sol.push(objs[i][name]);
                }
            }
            return sol;
        },

        isNull(data) {
            if (data == null) {
                return true;
            }
            if (data == "") {
                return true;
            }
            if (data == 0) {
                return true;
            }

            return false;
        },
        async autologout() {
            await this.$store.dispatch("Auth/logout");
            await this.$store.dispatch("Employee/logout");
            await this.$store.dispatch("Acl/logout");
            await this.$store.dispatch("Branch/logout");
            await this.$store.dispatch("Lookup/logout");
            await this.$store.dispatch("User/logout");
            localStorage.removeItem("branch");
            // Redirect to login.
            this.$router.push({ name: "login" }).catch(() => {});
            // this.redirect("login")
        },
        logout() {
            Swal.fire({
                title: "Ready to Leave?",
                text: 'Select "Logout" below if you are ready to end your current session.',
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Logout!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$router.push({ name: "login" }).catch(() => {});
                    this.$store.dispatch("Auth/logout");
                    this.$store.dispatch("Employee/logout");
                    this.$store.dispatch("Acl/logout");
                    this.$store.dispatch("Branch/logout");
                    this.$store.dispatch("Lookup/logout");
                    this.$store.dispatch("User/logout");
                    localStorage.removeItem("branch");
                }
            });
        },
    },
});
