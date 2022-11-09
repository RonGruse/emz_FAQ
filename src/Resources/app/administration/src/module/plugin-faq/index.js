import "./component/faq-list/index.js"
import "./component/faq-detail/index.js"

const { Module } = Shopware;

Shopware.Module.register('emz-faq', {
    name: "emz-faq",
    entity: "emz_faq_entry",
    routes: {
        overview: {
            component: 'emz-faq-list',
            path: 'overview'
        },
        detail: {
            component: 'emz-faq-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'emz.faq.overview',
            }
        },
        create: {
            component:"emz-faq-detail",
            path: 'create',
            meta: {
                parentPath: "emz.faq.overview"
            }
        }
    },
    navigation: [{
        label: "emz.faq.menu.faq",
        color: "#ff3d58",
        path: "emz.faq.overview",
        icon: "regular-content",
        position: 100,
        parent: "sw-content"
    }],
});