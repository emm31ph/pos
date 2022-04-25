function page(path) {
    return () =>
        import ( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [

    {
        path: '/employee',
        name: 'employee',
        // meta: { layout: 'auth' },
        redirect: '/employee/list',
        component: page('Employee/view/Main.vue'),
        children: [{
            path: '/employee/list',
            name: 'list-employee',
            component: page('Employee/view/List.vue')
        }, {
            path: '/employee/create',
            name: 'create-employee',
            component: page('Employee/view/Create.vue')
        }, ]
    },
    // {
    //     path: '/profile',
    //     name: 'profile',
    //     meta: { layout: 'default' },    
    //     component: page('Auth/view/Profile.vue'),
    // }
];