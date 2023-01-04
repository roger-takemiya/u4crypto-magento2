<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface U4cryptotransactionRepositoryInterface
{

    /**
     * Save U4cryptotransaction
     * @param \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface $u4cryptotransaction
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface $u4cryptotransaction
    );

    /**
     * Retrieve U4cryptotransaction
     * @param string $u4cryptotransactionId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($u4cryptotransactionId);

    /**
     * Retrieve U4cryptotransaction matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete U4cryptotransaction
     * @param \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface $u4cryptotransaction
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface $u4cryptotransaction
    );

    /**
     * Delete U4cryptotransaction by ID
     * @param string $u4cryptotransactionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($u4cryptotransactionId);
}

