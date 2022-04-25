function page(path) {
    return () =>
        import ( /* webpackChunkName: '' */ `~/modules/${path}`).then(
            m => m.default || m
        )
}

export default [

    {
        path: '/branch',
        name: 'branch',
        // meta: { layout: 'auth' },
        redirect: '/branch/list',
        component: page('Branch/view/Main.vue'),
        children: [{
            path: '/branch/list',
            name: 'list-branch',
            component: page('Branch/view/List.vue')
        }, ]
    },
];