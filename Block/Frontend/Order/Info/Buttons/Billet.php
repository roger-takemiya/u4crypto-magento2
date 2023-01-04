<?php

namespace Takemiya\U4crypto\Block\Frontend\Order\Info\Buttons;

class Billet extends \Magento\Framework\View\Element\Template
{

    protected $_paymentbillet;
    protected $_u4cryptoHelper;    

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,         
        \Takemiya\U4crypto\Model\Payment\Billet $paymentbillet,
        \Takemiya\U4crypto\Helper\Data $u4cryptoHelper,
        array $data = []
  
    ) {       


        $this->_paymentbillet = $paymentbillet;
        $this->_u4cryptoHelper = $u4cryptoHelper;

        parent::__construct($context, $data);

    }


    public function isBillet(){
         return $this->_u4cryptoHelper->isBillet( $this->_request->getParam('order_id') );
    }

    public function getBilletLink(){      
         return $this->_paymentbillet->getBilletLink( $this->_request->getParam('order_id') );
    }


}
