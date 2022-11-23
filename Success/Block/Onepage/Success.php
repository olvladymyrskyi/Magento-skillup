<?php
namespace Skillup\Success\Block\Onepage;

class Success extends \Magento\Checkout\Block\Onepage\Success
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;

    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    protected $_orderConfig;

    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    /**
     * @var \Magento\Sales\Model\Order
     */
    private $_order;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    private $priceHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Sales\Model\Order\Config $orderConfig
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order\Config $orderConfig,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        array $data = []
    ) {
        parent::__construct($context, $checkoutSession, $orderConfig, $httpContext);
        $this->_checkoutSession = $checkoutSession;
        $this->_orderConfig = $orderConfig;
        $this->_isScopePrivate = true;
        $this->httpContext = $httpContext;
        $this->priceHelper  = $priceHelper;
        $this->_order = $this->_checkoutSession->getLastRealOrder();
    }

    /**
     * Get order created date
     * @return string
     */
    public function getDate() : string
    {
        return  date('d/m/Y', strtotime($this->_order->getCreatedAt())) ;
    }

    /**
     * Get customer name
     * @return string
     */
    public function getCustomerName() : string
    {
        return  $this->_order->getCustomerFirstname() . " " . $this->_order->getCustomerLastname();
    }

    /**
     * Get total item count
     * @return int
     */
    public function getTotalItemCount() : int
    {
        return  $this->_order->getTotalItemCount();
    }

    /**
     * Get Grand Total
     * @return string
     */
    public function getGrandTotal() : string
    {
        return  $this->priceHelper->currency($this->_order->getGrandTotal(),true,false);
    }

    /**
     * Get Sub Total
     * @return string
     */
    public function getSubtotal() : string
    {
        return  $this->priceHelper->currency($this->_order->getSubtotal(),true,false);
    }

    /**
     * Get Tax Amount
     * @return string
     */
    public function getTaxAmount() : string
    {
        return  $this->priceHelper->currency($this->_order->getTaxAmount(),true,false);
    }

    /**
     * Get Shipping Amount
     * @return string
     */
    public function getShippingAmount() : string
    {
        return  $this->priceHelper->currency($this->_order->getShippingAmount(),true,false);
    }

    /**
     *  Get Order Items
     * @return array
     */
    public function getItems() : array
    {
        return $this->_order->getAllVisibleItems();
    }
}
