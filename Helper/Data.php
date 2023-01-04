<?php

namespace Takemiya\U4crypto\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_urlBuilder;
    protected $_scopeConfig;
    protected $_order;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Sales\Model\Order $order, 
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->_urlBuilder = $context->getUrlBuilder();
        $this->_scopeConfig = $scopeConfig;
        $this->_order = $order;
    }

    public function getAPIUrl()
    {
         $baseConfigs = $this->getBaseConfig();

         return ( $baseConfigs['developer_mode'] ) ? $baseConfigs['dev_url'] : $baseConfigs['pro_url'];
    }

    public function getBilletPrintUrl($orderIncrementId)
    {
         return $this->urlBuilder->getUrl('u4crypto/standard/billet', ['number' => $orderIncrementId]);
    }


    public function getBaseConfig(){
  
         $configs = ['partner','customerid','token','developer_mode','pro_url','dev_url','street','neighborhood','number','complement'];

         $data = [];

         foreach($configs as $config){
            $data[$config] = $this->_scopeConfig->getValue('payment/u4crypto_base/' . $config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         }

         return $data;
         
    }

    public function isBillet($order_id){
         return ( $this->_order->load($order_id)->getPayment()->getMethod() == "u4crypto_billet" ) ? true : false;
    }

    public function getBilletConfig(){

         $configs = ['inside_billet_instructions','expiration_days'];

         $data = [];

         foreach($configs as $config){
            $data[$config] = $this->_scopeConfig->getValue('payment/u4crypto_billet/' . $config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         }

         return $data;
    }

    public function billetIsExpired($expiration)
    {
        $expirationDays = $this->scopeConfig->getValue('payment/u4crypto_billet/expiration_days', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $expirationDate = new \DateTime($expiration);
        $dateNow = new \DateTime('now');
        return $dateNow->diff($expirationDate)->format("%r%a") < ($expirationDays * (-1));
    }

    public function isPix($order_id){
         return ( $this->_order->load($order_id)->getPayment()->getMethod() == "u4crypto_pix" ) ? true : false;
    }

    public function getPixConfig(){

         $configs = ['expiration_days'];

         $data = [];

         foreach($configs as $config){
            $data[$config] = $this->_scopeConfig->getValue('payment/u4crypto_pix/' . $config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         }

         return $data;
    }






}
