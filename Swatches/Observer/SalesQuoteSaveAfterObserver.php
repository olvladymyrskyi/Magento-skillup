<?php
namespace Skillup\Swatches\Observer;

use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SalesQuoteSaveAfterObserver
 */
class SalesQuoteSaveAfterObserver implements ObserverInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @codeCoverageIgnore
     */
    public function __construct(\Magento\Checkout\Model\Session $checkoutSession)
    {
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Assign quote to session
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        foreach ($quote->getItems() as $item) {
            $isConfigurable = $item->getProductType() == Configurable::TYPE_CODE;
        }
    }
}
