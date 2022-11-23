define([
    'Magento_Ui/js/model/messageList',
    'mage/translate'
], function (globalMessageList, $t) {
    'use strict';

    return {
        process: function (response, messageContainer) {
            var error;
            messageContainer = messageContainer || globalMessageList;

            try {
                var data = JSON.parse(response),
                    message = data.message || data.responseText;
                error = {
                    message: $t('Something went wrong with your request. Please try again later.')
                };

            } catch (exception) {
                error = {
                    message: $t('Something went wrong with your request. Please try again later.')
                };
            }
            messageContainer.addErrorMessage(error);
        }
    };
});
