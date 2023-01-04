<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Api;

interface OrderStatusManagementInterface
{

    /**
     * POST for orderStatus api
     * @param string $param
     * @return string
     */
    public function postOrderStatus($param);
}

