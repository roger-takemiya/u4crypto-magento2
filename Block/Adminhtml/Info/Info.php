<?php

namespace Takemiya\U4crypto\Block\Adminhtml\Info;

use Magento\Framework\View\Element\Template;

class Info extends \Magento\Payment\Block\Info
{

    protected $_u4cryptotransaction;
    protected $orderIncrementId;
    protected $scopeConfig;
    protected $helperData;


    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(     
        \Takemiya\U4crypto\Helper\Data $helperData,
        \Takemiya\U4crypto\Model\U4cryptotransaction $u4cryptotransaction,      
        Template\Context $context,
        array $data = []
    ) {


        parent::__construct($context, $data);

       
        $this->_u4cryptotransaction = $u4cryptotransaction;
        $this->scopeConfig = $context->getScopeConfig();
        $this->helperData = $helperData;
    }


    public function getU4cryptotransaction()
    {


        $transaction = [];

        $orderId = $this->getRequest()->getParam('order_id');

        $transactions = $this->_u4cryptotransaction->getCollection()
                                  ->addFieldToSelect('*')
                                  ->addFieldToFilter('order_id', $orderId );                            


        if($transactions->getSize()){
            return $transactions->getFirstItem()->getData();
        }                      
       
        return $transaction;
    }

 
}
