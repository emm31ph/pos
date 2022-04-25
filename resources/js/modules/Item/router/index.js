function page(path) {
    return () =>
        import(/* webpackChunkName: '' */ `~/modules/${path}`).then(
            (m) => m.default || m
        );
}

export default [
    {
        path: "/items",
        name: "items",
        // meta: { layout: 'auth' },
        redirect: "/items/list",
        component: page("Item/view/Main.vue"),
        children: [
            {
                path: "/items/list",
                name: "list-item",
                component: page("Item/view/List.vue"),
            },
        ],
    },
    // {
    //     path: '/lookup/branch',
    //     name: 'branch',
    //     meta: { layout: 'default' },
    //     component: page('Lookup/view/Branch.vue'),
    // }
];
