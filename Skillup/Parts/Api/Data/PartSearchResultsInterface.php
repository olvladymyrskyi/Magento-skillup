<?php

declare(strict_types=1);

namespace Skillup\Parts\Api\Data;

interface PartSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Skillup\Parts\Api\Data\PartInterface[]
     */
    public function getItems();

    /**
     * Set part items
     *
     * @param \Skillup\Parts\Api\Data\PartInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
