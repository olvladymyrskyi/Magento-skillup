define([
    'uiComponent',
    'ko',
    'jquery',
    'Magento_Checkout/js/model/sidebar',
    'Magento_Checkout/js/checkout-data',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/payment/place-order-hooks'
], function (Component, ko, $, sidebarModel, checkoutData, quote, placeOrderHooks) {
    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();

            if (placeOrderHooks) {
                placeOrderHooks.requestModifiers.push(function () {
                    let checkoutConfig = window.checkoutConfig,
                        quoteTotals = quote.totals();

                    if (quoteTotals.items_qty > 0) {
                        sessionStorage.setItem('checkoutConfig', JSON.stringify(checkoutConfig));
                        sessionStorage.setItem('quoteTotals', JSON.stringify(quoteTotals));
                    }
                });
            }

            return this;
        },
    });
});
