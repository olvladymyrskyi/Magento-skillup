define([
    'uiComponent',
    'ko',
    'jquery',
    'Magento_Checkout/js/model/quote'
], function (Component, ko, $, quote) {
    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();
            let quoteTotals = JSON.parse(sessionStorage.getItem('quoteTotals'));
            quote.setTotals(quoteTotals);

            return this;
        },
    });
});
