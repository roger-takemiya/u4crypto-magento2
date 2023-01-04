<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Api\Data;

interface U4cryptotransactionInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CREATED_AT = 'created_at';
    const BILLET = 'billet';
    const CUSTOMER_ID = 'customer_id';
    const DOCUMENTNUMBER = 'documentnumber';
    const BILLET_LINK = 'billet_link';
    const U4CRYPTOTRANSACTION_ID = 'u4cryptotransaction_id';
    const TRANSACTION = 'transaction';
    const ORDER_ID = 'order_id';
    const BILLET_ID = 'billet_id';
    const UPDATED_AT = 'updated_at';

    /**
     * Get u4cryptotransaction_id
     * @return string|null
     */
    public function getU4cryptotransactionId();

    /**
     * Set u4cryptotransaction_id
     * @param string $u4cryptotransactionId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setU4cryptotransactionId($u4cryptotransactionId);

    /**
     * Get transaction
     * @return string|null
     */
    public function getTransaction();

    /**
     * Set transaction
     * @param string $transaction
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setTransaction($transaction);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Takemiya\U4crypto\Api\Data\U4cryptotransactionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Takemiya\U4crypto\Api\Data\U4cryptotransactionExtensionInterface $extensionAttributes
    );

    /**
     * Get billet_id
     * @return string|null
     */
    public function getBilletId();

    /**
     * Set billet_id
     * @param string $billetId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setBilletId($billetId);

    /**
     * Get billet
     * @return string|null
     */
    public function getBillet();

    /**
     * Set billet
     * @param string $billet
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setBillet($billet);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get documentnumber
     * @return string|null
     */
    public function getDocumentnumber();

    /**
     * Set documentnumber
     * @param string $documentnumber
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setDocumentnumber($documentnumber);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setOrderId($orderId);

    /**
     * Get billet_link
     * @return string|null
     */
    public function getBilletLink();

    /**
     * Set billet_link
     * @param string $billetLink
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setBilletLink($billetLink);
}

