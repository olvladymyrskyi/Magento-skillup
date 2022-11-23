<?php

declare(strict_types=1);

namespace Skillup\Parts\Model\ResourceModel\Part;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Skillup\Parts\Model\Part::class,
            \Skillup\Parts\Model\ResourceModel\Part::class
        );
    }
}
