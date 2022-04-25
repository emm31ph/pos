<template>
<ul>  
    <sidebar-item v-for="(item, index) in menu" @menu-click="menuClick" :item="item" :key="index" /> 
</ul>
</template>

<script>
export default {
    data(){
       return { cnt : 0,}
        
    },
    props: {
        isSubmenuList: {
            type: Boolean,
            default: false,
        },
        menu: {
            type: Array,
            default: () => [],
        },

    },
    mounted(){
         
    },
    methods: {
        menuClick(item) {
            this.$emit("menu-click", item);
        },
    },
}
</script>

<style lang="scss" scoped>

</style>
