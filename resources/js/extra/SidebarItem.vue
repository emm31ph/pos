<template>
<li :class="item.child?'sidebar-dropdown':''" v-if="item.access">

    <component :is="componentIs" :to="itemTo" :href="itemHref" @click="menuClick" :title="item.alt">
 
            <i :class="`fa ${item.icon}`" v-if="(item.icon)"></i>
            <span> {{item.label}}</span>
        
    </component>
    <div class="sidebar-submenu" v-if="(item.child)">
        <sidebar-list v-if="(item.child)" :menu="item.child" />
    </div>

</li>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            default: null,
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
    }
}
</script>

<style lang="scss" scoped>

</style>
