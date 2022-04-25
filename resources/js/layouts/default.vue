<template>
<div> 
    <router-view />
</div>
</template>

<script>
export default {
    name: "default",
    

  
    beforeCreated() {

    },
    mounted() {
         
        // $('<script src="/js/scripts.js"></' + 'script>').appendTo(document.body);
        // $('head').append('<link href="/css/theme.css" rel="stylesheet">');
    },
}
</script>

<style lang="scss" scoped>

</style>
