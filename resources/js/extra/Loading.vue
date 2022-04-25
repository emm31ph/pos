<template>
<div>
 
    <div  class="preloader1 " v-show="isActive==true" data-aos-offset="200" >
        <div class="loader" data-aos="fade-up"></div> 
    </div>
</div>
</template>

<script>
// https://github.com/nuxt/nuxt.js/blob/master/lib/app/components/nuxt-loading.vue
export default {
    data: () => ({
        isActive: true,
        percent: 0,
        show: false,
        canSuccess: true,
        duration: 300000,
        height: "2px",
        color: "#77b6ff",
        failedColor: "red",
    }),

    methods: {
        start() {
            this.show = true;
            this.canSuccess = true;
            if (this._timer) {
                clearInterval(this._timer);
                this.percent = 0;
            }
            this._cut = 10000 / Math.floor(this.duration);
            this._timer = setInterval(() => {
                this.increase(this._cut * Math.random());
                if (this.percent > 95) {
                    this.finish();
                }
            }, 100);
            return this;
        },
        set(num) {
            this.show = true;
            this.canSuccess = true;
            this.percent = Math.floor(num);
            return this;
        },
        get() {
            return Math.floor(this.percent);
        },
        increase(num) {
            this.percent = this.percent + Math.floor(num);
            return this;
        },
        decrease(num) {
            this.percent = this.percent - Math.floor(num);
            return this;
        },
        finish() {
            this.percent = 100;
            this.hide();
            return this;
        },
        pause() {
            clearInterval(this._timer);
            return this;
        },
        hide() {
            clearInterval(this._timer);
            this._timer = null;
            setTimeout(() => {
                this.show = false;
                this.$nextTick(() => {
                    setTimeout(() => {
                        this.percent = 0;
                        this.isActive = false;
                    }, 200);
                });
            }, 1000);
            return this;
        },
        fail() {
            this.canSuccess = false;
            return this;
        },
    },
};
</script>

<style scoped>
.progress {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    height: 2px;
    width: 0%;
    transition: width 0.2s, opacity 0.4s;
    opacity: 1;
    background-color: #efc14e;
    z-index: 999999;
}

.preloader1 {
    /*
          Making the preloader floating over other elements.
          The preloader is visible by default. 
          */
    /* position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 1000;
     */
      position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: #fff;
}

.loader {
    border: 16px solid #f3f3f3;
    /* Light grey */
    border-top: 16px solid #3498db;
    /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
     
  margin: auto;
  padding: 10px;
  top: 40%;
  position: relative;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
