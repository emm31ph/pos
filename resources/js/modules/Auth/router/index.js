function page(path) {
    return () =>
        import( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [ 
    {
        path: '/login',
        name: 'login',
        // meta: { layout: 'default'}, 
        component: page('Auth/view/Login.vue')
    }, 
    {
        path: '/dashboard',
        name: 'dashboard',
        // meta: { layout: 'auth' },
        component: page('Auth/view/Dashboard.vue')
    }, 
    // {
    //     path: '/profile',
    //     name: 'profile',
    //     meta: { layout: 'default' },    
    //     component: page('Auth/view/Profile.vue'),
    // }
];

 