const { Component } = Shopware;

Component.register("emz-faq-list", {
    template: '<h2>Hello world!</h2>',
    beforeCreate: () => {
        console.log("test");
    }
})