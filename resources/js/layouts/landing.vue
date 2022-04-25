<template>
 <div>
  <router-view></router-view>
 </div>
</template>

<script>
import store from '~/store'
export default {
    name: "landing",
    data: () => ({
        sideBarOpen: false
    }),
    watch: {
        sideBarOpen() {
            this.sideBarOpen = store.getters['sideBarOpen'];
        }
    },
    mounted(){
    //      $('head').append('<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">');
    //  $('head').append('<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">');
     $('head').append('<link href="assets/vendor/aos/aos.css" rel="stylesheet">');
     $('head').append('<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">');
    //  $('head').append('<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">');
     $('head').append('<link href="assets/css/variables.css" rel="stylesheet">');
     $('head').append('<link href="assets/css/variables-green.css" rel="stylesheet">');
     $('head').append('<link href="assets/css/variables-blue.css" rel="stylesheet">');
     $('head').append('<link href="plugins/fontawesome-free/css/all.min.css" rel="stylesheet">');
     $('head').append('<link rel="stylesheet" type="text/css" href="assets/css/main.css">');
    //  $('<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></'+'script>').appendTo(document.body);
    //  $('<script src="assets/vendor/aos/aos.js"></'+'script>').appendTo(document.body);
    //  $('<script src="assets/vendor/glightbox/js/glightbox.min.js"></'+'script>').appendTo(document.body);
    //  $('<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></'+'script>').appendTo(document.body);
    //  $('<script src="assets/vendor/swiper/swiper-bundle.min.js"></'+'script>').appendTo(document.body);
    //  $('<script src="assets/vendor/php-email-form/validate.j"></'+'script>').appendTo(document.body);
    //  $('<script src="assets/js/main.js"></'+'script>').appendTo(document.body);
    //  $('<script src="dist/js/demo.js"></'+'script>').appendTo(document.body);
    
        // $('<script src="/js/scripts.js"></' + 'script>').appendTo(document.body);
    },
  
    destroyed() {
        // document.documentElement.setAttribute("class", "has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded");
        // document.body.classList.remove('Site')
    },
    computed: {

    },

};
</script>

<style lang="scss" scoped>
</style>
