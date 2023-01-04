<?php

namespace Takemiya\U4crypto\Model\Transaction\Pix\Config;



use Takemiya\U4crypto\Model\Transaction\Base\Config\AbstractConfig;

class Config extends AbstractConfig implements ConfigInterface
{
    /**
     * {@inheritdoc}
     */
    public function getInstructions()
    {
        return $this->getConfig(static::PATH_INSTRUCTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function getText()
    {
        return $this->getConfig(static::PATH_TEXT);
    }

 
    /**
     * {@inheritdoc}
     */
    public function getExpirationDays()
    {
        return $this->getConfig(static::PATH_EXPIRATION_DAYS);
    }



    /**
     * @return string
     */
    public function getTitle()
    {
        $title = $this->getConfig(static::PATH_TITLE);

        if(empty($title)){
            return __('U4Crypto Pix');
        }

        return $title;
    }
}
