function page(path) {
    return () =>
        import ( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [

    {
        path: '/lookup',
        name: 'lookup',
        // meta: { layout: 'auth' },
        redirect: '/lookup/list',
        component: page('Lookup/view/Main.vue'),
        children: [{
            path: '/lookup/list',
            name: 'list-lookup',
            component: page('Lookup/view/List.vue')
        }, ]
    },
    // {
    //     path: '/lookup/branch',
    //     name: 'branch',
    //     meta: { layout: 'default' },
    //     component: page('Lookup/view/Branch.vue'),
    // }
];