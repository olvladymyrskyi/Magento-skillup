<?php

declare(strict_types=1);

namespace Skillup\Parts\Model\ResourceModel;

class Part extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('skillup_parts', 'part_id');
    }

    /**
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     * @codeCoverageIgnore
     */
    public function getConnection()
    {
        return $this->_resources->getConnection();
    }
}
