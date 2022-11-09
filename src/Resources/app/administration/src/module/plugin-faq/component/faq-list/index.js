const { Component } = Shopware;
const { Criteria } = Shopware.Data;

import template from "./faq-list.html.twig";
import "./faq-list.scss"

Component.register("emz-faq-list", {
    inject: ['repositoryFactory'],
    template,
    data: function () {
        return {
            faqs: undefined
        }
    },
    computed: {
        productRepository() {
            return this.repositoryFactory.create('product');
        },
        faqRepository() {
            return this.repositoryFactory.create('emz_faq_entry');
        },
        faqColumns() {
            return this.getFaqColumns();
        },
        faqCriteria() {
            const faqCriteria = new Criteria(this.page, this.limit);
            faqCriteria.addAssociation("product");
            return faqCriteria;
        }
    },

    async created() {
        this.faqs = await this.faqRepository.search(this.faqCriteria);
    },
    methods: {
        getFaqColumns: () => {
            return [{
                property: 'question',
                label: "Question",
                routerLink: 'emz.faq.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true,
            }, {
                property: 'answer',
                naturalSorting: true,
                label: "Answer",
                align: 'right',
                allowResize: true,
            }, {
                property: 'product.name',
                label: "Product",
                allowResize: true,
            }];
        }
    }
})