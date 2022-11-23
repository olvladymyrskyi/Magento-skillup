<?php

declare(strict_types=1);

namespace Skillup\Parts\Model\Data;

use Magento\Framework\Api\AbstractSimpleObject;
use Skillup\Parts\Api\Data\PartManagementDataInterface;

class PartManagementData extends AbstractSimpleObject implements PartManagementDataInterface
{
    public function getItems(): array
    {
        return $this->_get(\Skillup\Parts\Api\Data\PartManagementDataInterface::ITEMS);
    }

    public function setItems(array $items): PartManagementDataInterface
    {
        return $this->setData(\Skillup\Parts\Api\Data\PartManagementDataInterface::ITEMS, $items);
    }
}
