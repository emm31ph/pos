<template> 
<li :class="!isNull(item.childs)?'nav-item dropdown':item.level==0?'nav-item':''" v-if="item.access"> 

    <component :to="itemTo" :href="itemHref" @click="menuClick" :is="componentIs" class="nav-link " :class="!isNull(item.childs) && item.level==0?'dropdown-toggle':''" :data-bs-toggle="item.databstoggle" :data-bs-target="item.databstarget">
        {{item.label}}
        {{!isNull(item.childs) && item.level!=0?'&raquo;':''}}
    </component>
 
    <ul class="dropdown-menu" :class="item.level==1?'submenu':''" v-if="!isNull(item.childs)">
        <auth-navbar-item v-for="(data, i) in item.childs" :item="data" :key="i" />
    </ul>
</li> 
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
        },
        sub: {
            type: Number,
            default: 0,
        },
        index: {
            type: Number,
            default: 0,
        },
    },
    computed: {
        componentIs() {
            return this.item.to ? 'router-link' : 'a'
        },

        itemTo() {
            return this.item.to ? this.item.to : null
        },
        itemHref() {
            return this.item.href ? this.item.href : null
        },
    },
    methods: {
        menuClick() {
        
            this.$emit('menu-click', this.item);
            
        },

        itemComponent(data) {
            return data.component ? data.component : null;
        },
    },
    mounted() {
 
    // console.log('*mounted',)
    }
};
</script>

<style lang="scss" scoped>

</style>
