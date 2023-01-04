<?php

namespace Takemiya\U4crypto\Model\Ui\Pix;


use Magento\Checkout\Model\ConfigProviderInterface;
use Takemiya\U4crypto\Model\Transaction\Pix\Config\ConfigInterface;
   
final class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'u4crypto_pix';

    protected $pixConfig;

    /**
     * ConfigProvider constructor.
     * @param ConfigInterface $pixConfig
     */
    public function __construct(
        ConfigInterface $pixConfig
    )
    {
        $this->setPixConfig($pixConfig);
    }

    public function getConfig()
    {
        return [
            'payment' => [
                self::CODE =>[
                    'text' => $this->getPixConfig()->getText(),
                    'title' => $this->getPixConfig()->getTitle(),
                    'instructions' => $this->getPixConfig()->getInstructions()
                ]
            ]
        ];
    }

    /**
     * @return ConfigInterface
     */
    protected function getPixConfig()
    {
        return $this->pixConfig;
    }

    /**
     * @param ConfigInterface $pixConfig
     * @return $this
     */
    protected function setPixConfig(ConfigInterface $pixConfig)
    {
        $this->pixConfig = $pixConfig;
        return $this;
    }
}
