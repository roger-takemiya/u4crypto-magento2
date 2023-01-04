<?php

namespace Takemiya\U4crypto\Model\Transaction\Pix\Config;
          
interface ConfigInterface
{
    const PATH_INSTRUCTIONS     = 'payment/u4crypto_pix/instructions';
    const PATH_EXPIRATION_DAYS  = 'payment/u4crypto_pix/expiration_days';
    const PATH_TITLE = 'payment/u4crypto_pix/title';
    const PATH_TEXT = 'payment/u4crypto_pix/text';

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
