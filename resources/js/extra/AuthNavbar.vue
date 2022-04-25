<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid nav-left">
        <div class="d-flex">
            <input class="form-control mr-2" type="search" placeholder="Search everywhere..." v-model="name" @change="sendMsg" aria-label="Search">
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <auth-navbar-item v-for="(data, i) in menu" :item="data" :key="i" ref='loadData' />
            </ul>
        </div>
    </div>
</nav>
</template>

<script> 
import bus from "../EventBus";
import {
    mapState
} from 'vuex'
export default {
    name: 'Navbar',
    data() {
        return {
            name: null, 
        }
    },
    computed: { 
        ...mapState(['menu']),

    },
    mounted(){
    },
    methods: {
        sendMsg() { 
            bus.$emit("send", this.name);
        },
         
    }
}
</script>

<style lang="scss" scoped>

</style>
