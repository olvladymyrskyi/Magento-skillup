<?php

namespace Skillup\Swatches\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckoutCartAddProductComplete  implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
    }
}
