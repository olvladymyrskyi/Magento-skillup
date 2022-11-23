define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
], function (Component, rendererList) {
    'use strict';

    rendererList.push(
        {
            type: 'flyorder',
            component: 'Skillup_FlyOrder/js/view/payment/method-renderer/flyorder-method'
        }
    );

    return Component.extend({});
});
