const { Module } = Shopware;

Shopware.Module.register('emz-faq', {
    name: "emz-faq",
    routes: {
        list: {
            component: 'emz-faq-list',
            path: 'list'
        },
    },
    navigation: [{
        label: "FAQ",
        color: "#ff3d58",
        path: "emz.faq.list",
        icon: "regular-content",
        position: 100,
        parent: "sw-content"
    }],
});