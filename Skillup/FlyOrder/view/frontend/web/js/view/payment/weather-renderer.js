define([
    'ko',
    'Magento_Ui/js/form/element/single-checkbox',
    'Magento_Checkout/js/model/url-builder',
    'Magento_Checkout/js/model/quote',
    'Skillup_FlyOrder/js/model/error-processor',
    'mage/storage',
], function (
    ko,
    Component,
    urlBuilder,
    quote,
    errorProcessor,
    storage
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

            quote.shippingAddress.subscribe(function (address) {
                    this.getWeather();
            }, this);
            return this;
        },

        getWeather: function () {
            if(!quote.shippingAddress().city){
               return;
            }
            let self = this,
                payload = {city: quote.shippingAddress().city},
                serviceUrl = urlBuilder.createUrl('/skillup/flyorder/weather', {});

            storage.post(serviceUrl, JSON.stringify(payload)).done(
                function (response) {
                    let data = JSON.parse(response);
                    if(data.cod == '404'){
                        self.weather('');
                        errorProcessor.process(response);
                    }else{
                        self.weather(data);
                    }

                }
            ).fail(
                function (response) {
                    console.log('something gone wrong');
                     errorProcessor.process(response);
                }
            ).always(function () {});
        }
    });
});
