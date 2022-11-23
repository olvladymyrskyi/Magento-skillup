<?php
namespace Skillup\Success\Block\Onepage;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class Recap extends \Magento\Framework\View\Element\Template
{
    /**
     * @var LayoutProcessorInterface[]
     */
    protected $layoutProcessors;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->layoutProcessors = $layoutProcessors;
    }

    /**
     * Retrieve encoded js layout.
     *
     * @return string
     */
    public function getJsLayout() : string
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return json_encode($this->jsLayout, JSON_HEX_TAG);
    }
}
