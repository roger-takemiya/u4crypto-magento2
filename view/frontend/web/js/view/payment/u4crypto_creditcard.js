define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'u4crypto_creditcard',
                component: 'Takemiya_U4crypto/js/view/payment/method-renderer/u4crypto_creditcard-method'
            }
        );
        return Component.extend({});
    }
);