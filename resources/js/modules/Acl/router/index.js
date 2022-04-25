function page(path) {
    return () =>
        import ( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [

    {
        path: '/acl',
        name: 'acl',
        // meta: { layout: 'auth' },
        redirect: '/acl/list',
        component: page('Acl/view/Main.vue'),
        children: [{
            path: '/acl/list',
            name: 'list-acl',
            component: page('Acl/view/List.vue')
        }, ]
    },
    // {
    //     path: '/profile',
    //     name: 'profile',
    //     meta: { layout: 'default' },    
    //     component: page('Auth/view/Profile.vue'),
    // }
];