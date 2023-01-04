<?php

namespace Takemiya\U4crypto\Model\Ui\Creditcard;


use Magento\Checkout\Model\ConfigProviderInterface;
use Takemiya\U4crypto\Model\Transaction\Creditcard\Config\ConfigInterface;
   
final class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'u4crypto_creditcard';

    protected $creditcardConfig;

    /**
     * ConfigProvider constructor.
     * @param ConfigInterface $creditcardConfig
     */
    public function __construct(
        ConfigInterface $creditcardConfig
    )
    {
        $this->setCreditcardConfig($creditcardConfig);
    }

    public function getConfig()
    {
        return [
            'payment' => [
                self::CODE =>[
                    'text' => $this->getCreditcardConfig()->getText(),
                    'title' => $this->getCreditcardConfig()->getTitle(),
                    'instructions' => $this->getCreditcardConfig()->getInstructions()
                ]
            ]
        ];
    }

    /**
     * @return ConfigInterface
     */
    protected function getCreditcardConfig()
    {
        return $this->creditcardConfig;
    }

    /**
     * @param ConfigInterface $creditcardConfig
     * @return $this
     */
    protected function setCreditcardConfig(ConfigInterface $creditcardConfig)
    {
        $this->creditcardConfig = $creditcardConfig;
        return $this;
    }
}
