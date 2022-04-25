import Vue from 'vue'
// import Child from './Child'
import { Button, HasError, AlertError, AlertSuccess } from 'vform/src/components/bootstrap5'

[

    // Child,
    Button,
    HasError,
    AlertError,
    AlertSuccess,
].forEach(Component => {
    Vue.component(Component.name, Component)
})