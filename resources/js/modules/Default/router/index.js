function page(path) {
    return () =>
        import( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [ 
    {
        path: '/',
        name: 'home', 
        component: page('Default/view/Landing.vue')
    } ,{
        path: '*',
        name: '404', 
        component: page('Default/view/404.vue')
    }
];

 