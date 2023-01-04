<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Model\Payment;

class Billet extends \Magento\Payment\Model\Method\AbstractMethod
{

    const CODE = 'u4crypto_billet';

    protected $_code = self::CODE;
    protected $_isOffline = false;


    protected $_canAuthorize = true;
    protected $_canCapture = true;
    protected $_canRefund = true;
    protected $_isInitializeNeeded = true;
    protected $_logger = null;

    protected $_timezoneInterface;
    protected $_productMetadata;

    protected $order;
    protected $regionFactory;
    protected $_u4cryptotransaction;
    protected $_u4cryptoHelper;
    protected $_curl;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\App\ProductMetadataInterface $productMetadata,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Magento\Sales\Model\Order $order,  
        \Takemiya\U4crypto\Model\U4cryptotransaction $u4cryptotransaction,
        \Takemiya\U4crypto\Helper\Data $u4cryptoHelper,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        array $data = []
    ){
   
        $this->orderFactory = $orderFactory;
        $this->_logger = $logger;

        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $resource,
            $resourceCollection,
            $data
        );

        $this->regionFactory = $regionFactory;
        $this->order = $order;
        $this->_curl = $curl;
        $this->_u4cryptotransaction = $u4cryptotransaction;
        $this->_u4cryptoHelper = $u4cryptoHelper;


        $this->_timezoneInterface = $timezoneInterface;
        $this->_productMetadata = $productMetadata;
        $this->checkoutSession    = $checkoutSession;

    }    



    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null      
    ) {
        return parent::isAvailable($quote);
    }



    public function getBilletLink($order_id){


         $transactions = $this->_u4cryptotransaction->getCollection()
                                  ->addFieldToSelect('*')
                                  ->addFieldToFilter('order_id', $order_id);                             
                  
         if($transactions->getSize()){
             $data = $transactions->getFirstItem();
             return $data->getBillet_link();
         }

         $order = $this->order->load($order_id);
         if ($order->isCanceled()) {
             return false;           
         }
         
         $data = $order->getData();

         $billingAddress = $order->getBillingAddress()->getData();

         $baseConfig = $this->_u4cryptoHelper->getBaseConfig();
         $billetConfig = $this->_u4cryptoHelper->getBilletConfig();
         $url = $this->_u4cryptoHelper->getAPIUrl();



         $dueDate = $billetConfig['expiration_days'] * 86400; 


         $street = $order->getBillingAddress()->getStreet();

         $street_address = isset($street[$baseConfig['street']]) ? $street[$baseConfig['street']] : 'endereço';
         $neighborhood = isset($street[$baseConfig['neighborhood']]) ? $street[$baseConfig['neighborhood']] : 'bairro';
         $number = isset($street[$baseConfig['number']]) ? $street[$baseConfig['number']] : '100';
         $complement = isset($street[$baseConfig['complement']]) ? $street[$baseConfig['complement']] : 'complemento';


         $region = $this->regionFactory->create()->load($billingAddress['region_id']);

         $customer_taxvat = empty($data['customer_taxvat']) ? '06341433956' : $data['customer_taxvat'];
         $customer_taxvat = preg_replace("/[^0-9]/", "",  $customer_taxvat);



         $postData = [
            "runAsync"=> false,
            "skipPdf"=> false,
            "skipNotification"=> true,
            "message"=>  $billetConfig['inside_billet_instructions'],
            "amount"=> floatval($data['grand_total']),
            "due_date"=> date('Y-m-d', (time()+$dueDate)), 
            "type"=> "billing",
            "payer"=> [
              "documentNumber"=>$customer_taxvat,
              "name"=> $data['customer_firstname'].' '.$data['customer_lastname'],
              "street_address"=>  $street_address, 
              "number"=> $number,
              "complement"=> $complement, 
              "neighborhood"=>  $neighborhood,
              "cep"=>  preg_replace("/[^0-9]/", "", $billingAddress['postcode'] ),
              "city"=> $billingAddress['city'], 
              "state"=> $region->getCode(), 
              "saveContact"=> false
            ],
            "externalId"=> "01",
            "split" => [
                [ "documentNumber" => "", "percentValue" => 0, "taxValue" => 0, "value" => "" ],
                [ "documentNumber" => "", "percentValue" => 0, "taxValue" => 0, "value" => "" ]
            ]
         ];        


         $urlBillet = $url.'/boleto/erp/create/'.$baseConfig['customerid'];

         $this->_curl->addHeader("Content-Type", "application/json");   
         $this->_curl->addHeader("Accept", "application/json");       
         $this->_curl->addHeader("partner", $baseConfig['partner']);
         $this->_curl->addHeader("token", $baseConfig['token']);


         $this->_curl->setOption(CURLOPT_POSTFIELDS, json_encode($postData));  
         $this->_curl->setOption(CURLOPT_RETURNTRANSFER, true);   
         $this->_curl->setOption(CURLOPT_HTTP_VERSION, '1.1'); 
         $this->_curl->setOption(CURLOPT_TIMEOUT, 30); 

         $this->_curl->post($urlBillet, []);      


         $response = $this->_curl->getBody();

         $response = json_decode( $response );

         if(isset($response->id)){

            $u4cryptotransaction = $this->_u4cryptotransaction;

            $d = [];
            $d['billet'] = $response->digitableLine;
            $d['billet_id'] = $response->id;
            $d['billet_link'] = $response->billet;
            $d['documentnumber'] = $response->documentNumber;
            $d['transaction'] = $response->processorTransactionNumber;

            $d['order_id'] = $order->getId();
            $d['customer_id'] = $data['customer_id'];
            $d['created_at'] = date("Y-m-d H:i:s");
            $d['updated_at'] = date("Y-m-d H:i:s");

            $u4cryptotransaction->setData($d);
            $u4cryptotransaction->save();

            return $response->billet;

         }

         return false;
  
    }



 
    
}

