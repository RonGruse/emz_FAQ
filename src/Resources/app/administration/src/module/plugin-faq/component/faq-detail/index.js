const { Component } = Shopware;
const { Criteria } = Shopware.Data;

import template from './faq-detail.html.twig';
import './faq-detail.scss';

Component.register("emz-faq-detail", {
    inject: ['repositoryFactory'],
    template,
    data: function () {
        return {
            faq: undefined,
            isLoading: true,
            isSaveSuccessful: false,
        }
    },
    computed: {
        productRepository() {
            return this.repositoryFactory.create('product');
        },
        faqRepository() {
            return this.repositoryFactory.create('emz_faq_entry');
        }
    },
    created() {
        // Fetch FAQ
        if (this.$route.params.id){
            this.faqRepository.get(this.$route.params.id, Shopware.Context.api).then(result => {
                this.faq = result;
            });
            return;
        }

        // Create new FAQ Entry
        this.faq = this.faqRepository.create(Shopware.Context.api);
    },
    watch: {
        faq: {
            handler: function() {
                this.isSaveSuccessful = false;
                if (this.faq != undefined){
                    this.isLoading = false;
                }
            },
            deep: true
        }
    },
    methods: {
        onSave: async function () {
            this.isLoading = true;
            await this.faqRepository.save(this.faq, Shopware.Context.api);
            this.isLoading = false;
            this.isSaveSuccessful = true;
        },
    },
})