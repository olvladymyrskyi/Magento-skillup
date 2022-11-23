<?php

namespace Skillup\FlyOrder\Model;

/**
 * FlyOrder payment method model
 *
 */
class FlyOrderPayment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_FLYORDER_CODE = 'flyorder';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_FLYORDER_CODE;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

}
