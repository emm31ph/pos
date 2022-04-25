<template>
<div>
    <component   ref='modal'  :is="item.modal" v-if="item.modal"></component>

    <modals ref='modalLoop' v-for="(data,i)  in item.childs" :item='data' :key="i" />
 
</div>
</template>

<script>
export default {
  name: 'ModalDisplay',
    props: {
        item: {
            type: Object,
        },
    },
    computed: {

    }, 
  mounted() {
    // console.log(this.$refs);
  }
    
  

}
</script>

<style lang="scss" scoped>

</style>
