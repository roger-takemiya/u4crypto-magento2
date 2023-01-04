<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Api\Data;

interface U4cryptotransactionSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get U4cryptotransaction list.
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface[]
     */
    public function getItems();

    /**
     * Set transaction list.
     * @param \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

