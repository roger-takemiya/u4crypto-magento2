<?php

namespace Takemiya\U4crypto\Controller\Standard;

class Billet extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $order;
    protected $context;
    protected $scopeConfig;

    protected $regionFactory;

    protected $_u4cryptotransaction;
    protected $_u4cryptoHelper;
    protected $_paymentbillet;
    protected $_paymentpix;

    protected $_curl;


    /**
     * Constructor
     * @param \Magento\Framework\App\Action\Context              $context
     * @param \Magento\Framework\View\Result\PageFactory         $resultPageFactory
     * @param \Magento\Sales\Model\Order                         $order   
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Directory\Model\RegionFactory $regionFactory
     * @param \Takemiya\U4crypto\Model\U4cryptotransaction $u4cryptotransaction
     * @param \Takemiya\U4crypto\Helper\Data $u4cryptoHelper
     * @param \Takemiya\U4crypto\Model\Payment\Billet $paymentbillet
     * @param \Magento\Framework\HTTP\Client\Curl $curl
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Sales\Model\Order $order,        
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Takemiya\U4crypto\Model\U4cryptotransaction $u4cryptotransaction,
        \Takemiya\U4crypto\Helper\Data $u4cryptoHelper,
        \Takemiya\U4crypto\Model\Payment\Billet $paymentbillet,
        \Takemiya\U4crypto\Model\Payment\Pix $paymentpix,
        \Magento\Framework\HTTP\Client\Curl $curl
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

        $this->context = $context;
        $this->order = $order;        
        $this->scopeConfig = $scopeConfig;
        $this->regionFactory = $regionFactory;
        $this->_u4cryptotransaction = $u4cryptotransaction;
        $this->_u4cryptoHelper = $u4cryptoHelper;
        $this->_curl = $curl;
        $this->_paymentbillet = $paymentbillet;
        $this->_paymentpix = $paymentpix;

    }

    /**
     * Return request parameter value
     *
     * @param  string $sKey
     * @return string
     */
    protected function getParam($sKey)
    {
        return $this->context->getRequest()->getParam($sKey, '');
    }



    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
         $orderIncrementId = $this->getParam('number');
         $order = $this->order->loadByIncrementId($orderIncrementId);
         if ($order->isCanceled()) {
             return $this->getResponse()->setBody(__('This order was canceled'));            
         }



         $link = $this->_paymentbillet->getBilletLink( $order->getId() );

         if($link){  
            header("location: " . $link);
            die();
         }

         return $this->getResponse()->setBody(__('Order not found'));
    }


}
