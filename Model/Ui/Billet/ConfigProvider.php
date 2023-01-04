<?php

namespace Takemiya\U4crypto\Model\Ui\Billet;


use Magento\Checkout\Model\ConfigProviderInterface;
use Takemiya\U4crypto\Model\Transaction\Billet\Config\ConfigInterface;
   
final class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'u4crypto_billet';

    protected $billetConfig;

    /**
     * ConfigProvider constructor.
     * @param ConfigInterface $billetConfig
     */
    public function __construct(
        ConfigInterface $billetConfig
    )
    {
        $this->setBilletConfig($billetConfig);
    }

    public function getConfig()
    {
        return [
            'payment' => [
                self::CODE =>[
                    'text' => $this->getBilletConfig()->getText(),
                    'title' => $this->getBilletConfig()->getTitle(),
                    'instructions' => $this->getBilletConfig()->getInstructions()
                ]
            ]
        ];
    }

    /**
     * @return ConfigInterface
     */
    protected function getBilletConfig()
    {
        return $this->billetConfig;
    }

    /**
     * @param ConfigInterface $billetConfig
     * @return $this
     */
    protected function setBilletConfig(ConfigInterface $billetConfig)
    {
        $this->billetConfig = $billetConfig;
        return $this;
    }
}
