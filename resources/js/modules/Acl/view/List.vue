<template>
<div class="card w-100 full-height d-flex align-items-stretch" data-aos="zoom-in">
    <div class="card-header">

        <h5 class="card-title">{{ pagename }}</h5>

    </div>
    <div class="card-body tableFixHead">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col" v-bind:class="[ sortBy === 'id'? sortDirection: '',]" @click="sort('id')">#</th>
                    <th scope="col" v-bind:class="[sortBy === 'display_name'? sortDirection: '',]" @click="sort('display_name')">Display Name</th>
                    <th scope="col" v-bind:class="[sortBy === 'name'? sortDirection: '',]" @click="sort('name')">Name</th>
                    <th scope="col" v-bind:class="[sortBy === 'description'? sortDirection: '',]" @click="sort('description')">Description</th> 
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, i) in filterData" :key="i">
                    <th scope="row">{{data.id}}</th>
                    <td>{{data.display_name}}</td>
                    <td>{{data.name}}</td>
                    <td>{{data.description}}</td> 
                    <td class="text-center">
                        <a @click="handleEdit(data)" class="btn btn-sm btn-primary" v-if="can('acl-update')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a @click="handleDelete(data.id)" class="btn btn-sm btn-danger" v-if="can('acl-delete')">
                            <i class="fa-solid fa-trash"></i>
                            
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer ">
        <pagination v-if="loadData" v-model="currentPage" :page-count="totalPages" />
    </div>

</div>
</template>

<script>
import bus from "../../../EventBus"
import store from "~/store";
import Form from "vform";
export default {
    name: "AclList",
    middleware: "auth",
    layout: "auth",
    data() {
        return {
            pagename: "ACL", 
            form: new Form({
            trnmode:'',
            trntype:'',
            id:'',
            }),
        };
    },
    metaInfo() {
        return {
            title: this.pagename
        };
    },
    mounted() {
         this.hasAccess("users-access");
        this.$store.dispatch("MenuName", {
            menuname: ['ACL', 'List']
        });

        this.currentPage = 1;
        bus.$on("send", (data) => {
            this.query = data;
        });
        this.onLoad();

    },
    created() { 
        this.$root.$refs.AclList = this;
    },
    methods: {
        handleEdit(data) {
         $("#MAclCreate").modal("show");
            this.$store.dispatch("Data", {
                data: data
            });

            this.$root.$refs.MAclCreate.onLoad();
            $("#MAclCreate").modal("show");

        },
         handleDelete(data) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) { 
                
                    this.form.trnmode = "deleteRole";
                    this.form.trntype = "";
                    this.form.id = data; 
               
                    this.form.post("/api/auth/acl").then((res) => { 
                        this.onLoad();
                        this.ToastSuccess('Deleted Successfully'); 
                      
                    })

                }
            })
        },
        onLoad() {

            this.$store.dispatch("Acl/fetchAcl", {
                trnmode: "fetchRole",
                trntype: "fetch",
            });
            
           
        },
    },
    computed: {
        loadData() {
            const data = store.getters["Acl/list"] ? store.getters["Acl/list"] : "";
            if (store.getters["Acl/list"] != "undefined ") {
                this.$emit("change", this.query);
                if (!this.query == "") {
                    return data
                        .filter((item) => {
                            if (
                                item["display_name"]
                                .toLowerCase()
                                // .startsWith(this.query) //search start left side
                                .includes(this.query.toLowerCase())
                            ) {
                                return (
                                    item["display_name"]
                                    .toLowerCase()
                                    // .startsWith(this.query) //search start left side
                                    .includes(this.query.toLowerCase())
                                );
                            }
                            if (
                                item["name"]
                                .toLowerCase()
                                // .startsWith(this.query) //search start left side
                                .includes(this.query.toLowerCase())
                            ) {
                                return (
                                    item["name"]
                                    .toLowerCase()
                                    // .startsWith(this.query) //search start left side
                                    .includes(this.query.toLowerCase())
                                );
                            }
                        })
                        .sort((p1, p2) => {
                            let modifier = 1;
                            if (p1[this.sortBy] != undefined) {
                                if (this.sortDirection === "desc") modifier = -1;
                                if (parseInt(p1[this.sortBy])) {
                                    if (p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier;
                                    if (p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
                                } else {
                                    if (
                                        p1[this.sortBy].toString().toLowerCase() <
                                        p2[this.sortBy].toString().toLowerCase()
                                    )
                                        return -1 * modifier;
                                    if (
                                        p1[this.sortBy].toString().toLowerCase() >
                                        p2[this.sortBy].toString().toLowerCase()
                                    )
                                        return 1 * modifier;
                                }
                            }
                            return 0;
                        });
                } else {
                    // return Object.keys(data).map((itemcode) => data[itemcode]);
                    return Object.keys(data)
                        .map((name) => data[name])
                        .sort((p1, p2) => {
                            let modifier = 1;
                            if (p1[this.sortBy] != undefined) {
                                if (this.sortDirection === "desc") modifier = -1;
                                if (parseInt(p1[this.sortBy])) {
                                    if (p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier;
                                    if (p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
                                } else {
                                    if (
                                        p1[this.sortBy].toString().toLowerCase() <
                                        p2[this.sortBy].toString().toLowerCase()
                                    )
                                        return -1 * modifier;
                                    if (
                                        p1[this.sortBy].toString().toLowerCase() >
                                        p2[this.sortBy].toString().toLowerCase()
                                    )
                                        return 1 * modifier;
                                }
                            }
                            return 0;
                        });
                }
            }

            return false;
        },
        filterData() {
            var page = this.currentPage;
            var perPage = this.dataPerPage;
            var from = page * perPage - perPage;
            var to = page * perPage;
            return this.loadData.slice(from, to);
        },
        totalPages() {
            return Math.ceil(this.loadData.length / this.dataPerPage);
        },
    }

}
</script>

<style lang="scss" scoped>

</style>
