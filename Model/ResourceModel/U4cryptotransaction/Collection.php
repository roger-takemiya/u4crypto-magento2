<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'u4cryptotransaction_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Takemiya\U4crypto\Model\U4cryptotransaction::class,
            \Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction::class
        );
    }
}

