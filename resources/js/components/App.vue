<template>
<div id="app"> 

    <loading ref="loading" />  
    <transition name="page"   >
        <component :is="layout" v-if="layout" />
    </transition>

</div>
</template>

<script>
import Loading from '../extra/Loading.vue';
// Load layout components dynamically.
const requireContext = require.context("~/layouts", false, /.*\.vue$/);

const layouts = requireContext
    .keys()
    .map((file) => [file.replace(/(^.\/)|(\.vue$)/g, ""), requireContext(file)])
    .reduce((components, [name, component]) => {
        components[name] = component.default || component;
        return components;
    }, {});
 
export default {
    components: {
        Loading
    },
    el: "#app",

    data: () => ({
        layout: null,
        defaultLayout: "default",
    }),
    computed:{  
    },
    mounted() {
        this.$loading = this.$refs.loading;
    },
    metaInfo() {
        // const { appName } = (window.config);  
        return {
            title: 'PAYROLL',
            titleTemplate: '%s | TCC GROUP INC.'
        };
    },

    methods: {
        /**
         * Set the application layout.
         *
         * @param {String} layout
         */
        setLayout(layout) {

            if (!layout || !layouts[layout]) {
                layout = this.defaultLayout;
            }

            this.layout = layouts[layout];

        },
    },
};
</script>
