function page(path) {
    return () =>
        import ( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [

    {
        path: '/user',
        name: 'user',
        // meta: { layout: 'auth' },
        redirect: '/user/list',
        component: page('User/view/Main.vue'),
        children: [{
            path: '/user/list',
            name: 'list-user',
            component: page('User/view/List.vue')
        }, ]
    },
    // {
    //     path: '/profile',
    //     name: 'profile',
    //     meta: { layout: 'default' },    
    //     component: page('Auth/view/Profile.vue'),
    // }
];