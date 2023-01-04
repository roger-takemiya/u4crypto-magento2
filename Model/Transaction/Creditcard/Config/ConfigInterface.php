<?php

namespace Takemiya\U4crypto\Model\Transaction\Creditcard\Config;
          
interface ConfigInterface
{
    const PATH_INSTRUCTIONS     = 'payment/u4crypto_creditcard/instructions';
    const PATH_EXPIRATION_DAYS  = 'payment/u4crypto_creditcard/expiration_days';
    const PATH_TITLE = 'payment/u4crypto_creditcard/title';
    const PATH_TEXT = 'payment/u4crypto_creditcard/text';

    /**
     * @return string
     */
    public function getInstructions();

    /**
     * @return string
     */
    public function getExpirationDays();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getText();

}
