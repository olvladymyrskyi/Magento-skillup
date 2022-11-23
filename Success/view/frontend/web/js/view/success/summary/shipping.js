define([
    'jquery',
    'underscore',
    'Magento_Checkout/js/view/summary/shipping',
], function ($, _, Component) {
    'use strict';

    return Component.extend({
        isCalculated: function () {
            return this.totals() != null;
        }
    });
});
