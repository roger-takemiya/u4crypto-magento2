<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Model;

use Magento\Framework\Api\DataObjectHelper;
use Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface;
use Takemiya\U4crypto\Api\Data\U4cryptotransactionInterfaceFactory;

class U4cryptotransaction extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'takemiya_u4crypto_u4cryptotransaction';
    protected $u4cryptotransactionDataFactory;

    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param U4cryptotransactionInterfaceFactory $u4cryptotransactionDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction $resource
     * @param \Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        U4cryptotransactionInterfaceFactory $u4cryptotransactionDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction $resource,
        \Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction\Collection $resourceCollection,
        array $data = []
    ) {
        $this->u4cryptotransactionDataFactory = $u4cryptotransactionDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve u4cryptotransaction model with u4cryptotransaction data
     * @return U4cryptotransactionInterface
     */
    public function getDataModel()
    {
        $u4cryptotransactionData = $this->getData();
        
        $u4cryptotransactionDataObject = $this->u4cryptotransactionDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $u4cryptotransactionDataObject,
            $u4cryptotransactionData,
            U4cryptotransactionInterface::class
        );
        
        return $u4cryptotransactionDataObject;
    }
}

