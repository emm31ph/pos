<template>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
     <li class="breadcrumb-item" v-for="(data, i) in getTitle" :key="i">{{getTitle[i]}}</li> 
    </ol>
</nav>
</template>

<script>
import store from "~/store"; 
export default {
    computed: {
        getTitle() {
            const data = store.getters["menuname"];
            if (data) {
                return data;
            }
            return [];
        },
    },
}
</script>

<style lang="scss" scoped>

</style>
