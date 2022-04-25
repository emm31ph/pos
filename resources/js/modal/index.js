import Vue from 'vue'

import camelCase from 'lodash/camelCase'
import upperFirst from 'lodash/upperFirst'

// import modal from './modal';
// Vue.component('BModal', modal);

const requireComponent = require.context('~/modules/', true, /modal\/.*.vue$/)
requireComponent.keys().forEach(fileName => {

    const componentConfig = requireComponent(fileName)
    const componentName = upperFirst(
        camelCase(fileName.replace(/^\.\//, '').replace(/\.\w+$/, ''))
    )
    Vue.component(componentConfig.default.name, componentConfig.default || componentConfig)

})