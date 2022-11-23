<?php

declare(strict_types=1);

namespace Skillup\Parts\Api\Data;

interface PartManagementDataInterface
{
    public const ITEMS = 'items';

    /**
     * @return \Skillup\Parts\Api\Data\PartInterface[]|null
     */
    public function getItems(): array;

    /**
     * @param \Skillup\Parts\Api\Data\PartInterface[] $items
     * @return \Skillup\Parts\Api\Data\PartManagementDataInterface
     */
    public function setItems(array $items): PartManagementDataInterface;
}
