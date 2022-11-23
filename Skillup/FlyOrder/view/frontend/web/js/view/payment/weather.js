define([
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/url-builder',
    'Magento_Checkout/js/model/quote'
], function (
    ko,
    Component,
    urlBuilder,
    quote
){
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Skillup_FlyOrder/payment/weather/default',
            weather: ''
        },

        /** @inheritdoc */
        initObservable: function () {
            this._super()
                .observe('weather');

            return this;
        },


        initialize: function () {
            this._super();
            this.getWeather();
            return this;
        },

        getWeather: function () {
            if(quote.shippingAddress() === null){
               return;
            }
            let self = this,
                payload = {city: quote.shippingAddress().city},
                serviceUrl = urlBuilder.createUrl('/skillup/flyorder/weather', {});

            storage.post(serviceUrl, JSON.stringify(payload)).done(
                function (response) {
                    self.weather(response);
                    console.log(response);
                }
            ).fail(
                function (response) {
                    console.log('something gone wrong');
                    // errorProcessor.process(response);
                }
            ).always(function () {});
        }
    });
});
