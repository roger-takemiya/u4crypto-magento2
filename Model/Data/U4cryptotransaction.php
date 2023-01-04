<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Model\Data;

use Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface;

class U4cryptotransaction extends \Magento\Framework\Api\AbstractExtensibleObject implements U4cryptotransactionInterface
{

    /**
     * Get u4cryptotransaction_id
     * @return string|null
     */
    public function getU4cryptotransactionId()
    {
        return $this->_get(self::U4CRYPTOTRANSACTION_ID);
    }

    /**
     * Set u4cryptotransaction_id
     * @param string $u4cryptotransactionId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setU4cryptotransactionId($u4cryptotransactionId)
    {
        return $this->setData(self::U4CRYPTOTRANSACTION_ID, $u4cryptotransactionId);
    }

    /**
     * Get transaction
     * @return string|null
     */
    public function getTransaction()
    {
        return $this->_get(self::TRANSACTION);
    }

    /**
     * Set transaction
     * @param string $transaction
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setTransaction($transaction)
    {
        return $this->setData(self::TRANSACTION, $transaction);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Takemiya\U4crypto\Api\Data\U4cryptotransactionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Takemiya\U4crypto\Api\Data\U4cryptotransactionExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get billet_id
     * @return string|null
     */
    public function getBilletId()
    {
        return $this->_get(self::BILLET_ID);
    }

    /**
     * Set billet_id
     * @param string $billetId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setBilletId($billetId)
    {
        return $this->setData(self::BILLET_ID, $billetId);
    }

    /**
     * Get billet
     * @return string|null
     */
    public function getBillet()
    {
        return $this->_get(self::BILLET);
    }

    /**
     * Set billet
     * @param string $billet
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setBillet($billet)
    {
        return $this->setData(self::BILLET, $billet);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_get(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get documentnumber
     * @return string|null
     */
    public function getDocumentnumber()
    {
        return $this->_get(self::DOCUMENTNUMBER);
    }

    /**
     * Set documentnumber
     * @param string $documentnumber
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setDocumentnumber($documentnumber)
    {
        return $this->setData(self::DOCUMENTNUMBER, $documentnumber);
    }

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->_get(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $orderId
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get billet_link
     * @return string|null
     */
    public function getBilletLink()
    {
        return $this->_get(self::BILLET_LINK);
    }

    /**
     * Set billet_link
     * @param string $billetLink
     * @return \Takemiya\U4crypto\Api\Data\U4cryptotransactionInterface
     */
    public function setBilletLink($billetLink)
    {
        return $this->setData(self::BILLET_LINK, $billetLink);
    }
}

