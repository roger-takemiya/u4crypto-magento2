<?php

namespace Takemiya\U4crypto\Model\Transaction\Billet\Config;
          
interface ConfigInterface
{
    const PATH_INSTRUCTIONS     = 'payment/u4crypto_billet/instructions';
    const PATH_EXPIRATION_DAYS  = 'payment/u4crypto_billet/expiration_days';
    const PATH_TITLE = 'payment/u4crypto_billet/title';
    const PATH_TEXT = 'payment/u4crypto_billet/text';

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
