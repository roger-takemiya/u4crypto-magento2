<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Model;

class OrderStatusManagement implements \Takemiya\U4crypto\Api\OrderStatusManagementInterface
{

    /**
     * {@inheritdoc}
     */
    public function postOrderStatus($param)
    {
        return 'hello api POST return the $param ' . $param;
    }
}

