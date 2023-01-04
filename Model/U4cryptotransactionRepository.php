<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Takemiya\U4crypto\Api\Data\U4cryptotransactionInterfaceFactory;
use Takemiya\U4crypto\Api\Data\U4cryptotransactionSearchResultsInterfaceFactory;
use Takemiya\U4crypto\Api\U4cryptotransactionRepositoryInterface;
use Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction as ResourceU4cryptotransaction;
use Takemiya\U4crypto\Model\ResourceModel\U4cryptotransaction\CollectionFactory as U4cryptotransactionCollectionFactory;

class U4cryptotransactionRepository implements U4cryptotransactionRepositoryInterface
{

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $u4cryptotransactionCollectionFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $dataU4cryptotransactionFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $u4cryptotransactionFactory;


    /**
     * @param ResourceU4cryptotransaction $resource
     * @param U4cryptotransactionFactory $u4cryptotransactionFactory
     * @param U4cryptotransactionInterfaceFactory $dataU4cryptotransactionFactory
     * @param U4cryptotransactionCollectionFactory $u4cryptotransactionCollectionFactory
     * @param U4cryptotransactionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceU4cryptotransaction $resource,
        U4cryptotransactionFactory $u4cryptotransactionFactory,
        U4cryptotransactionInterfaceFactory $dataU4cryptotransactionFactory,
        U4cryptotransactionCollectionFactory $u4cryptotransactionCollectionFactory,
        U4cryptotransactionSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->u4cryptotransactionFactory = $u4cryptotransactionFactory;
        $this->u4cryptotransactionCollectionFactory = $u4cryptotransactionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataU4cryptotransactionFactory = $dataU4cryptotransactionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface $u4cryptotransaction
    ) {
        /* if (empty($u4cryptotransaction->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $u4cryptotransaction->setStoreId($storeId);
        } */
        
        $u4cryptotransactionData = $this->extensibleDataObjectConverter->toNestedArray(
            $u4cryptotransaction,
            [],
            \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface::class
        );
        
        $u4cryptotransactionModel = $this->u4cryptotransactionFactory->create()->setData($u4cryptotransactionData);
        
        try {
            $this->resource->save($u4cryptotransactionModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the u4cryptotransaction: %1',
                $exception->getMessage()
            ));
        }
        return $u4cryptotransactionModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($u4cryptotransactionId)
    {
        $u4cryptotransaction = $this->u4cryptotransactionFactory->create();
        $this->resource->load($u4cryptotransaction, $u4cryptotransactionId);
        if (!$u4cryptotransaction->getId()) {
            throw new NoSuchEntityException(__('U4cryptotransaction with id "%1" does not exist.', $u4cryptotransactionId));
        }
        return $u4cryptotransaction->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->u4cryptotransactionCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface $u4cryptotransaction
    ) {
        try {
            $u4cryptotransactionModel = $this->u4cryptotransactionFactory->create();
            $this->resource->load($u4cryptotransactionModel, $u4cryptotransaction->getU4cryptotransactionId());
            $this->resource->delete($u4cryptotransactionModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the U4cryptotransaction: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($u4cryptotransactionId)
    {
        return $this->delete($this->get($u4cryptotransactionId));
    }
}

