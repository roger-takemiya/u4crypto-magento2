<?php

namespace Takemiya\U4crypto\Block\Frontend\Onepage;

class Success extends \Magento\Framework\View\Element\Template
{
    protected $checkoutSession;
    protected $_paymentpix;


    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\View\Element\Template\Context $context,
        \Takemiya\U4crypto\Model\Payment\Pix $paymentpix,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->_paymentpix = $paymentpix;

    }

    public function getOrderIncrementId()
    {
        return $this->checkoutSession->getLastRealOrderId();
    }

    public function canShowBillet()
    {
        $order = $this->checkoutSession->getLastRealOrder();
        if ($order->getPayment()->getMethod() == \Takemiya\U4crypto\Model\Payment\Billet::CODE) {
            return true;
        }

        return false;
    }

    public function canShowPix()
    {
        $order = $this->checkoutSession->getLastRealOrder();
        if ($order->getPayment()->getMethod() == \Takemiya\U4crypto\Model\Payment\Pix::CODE) {
            return true;
        }

        return false;
    }


    public function getBilletPrintUrl()
    {
        return $this->_urlBuilder->getUrl('u4crypto/standard/billet', array('number' => $this->getOrderIncrementId()));
    }

    public function getPixData(){

    	$order = $this->checkoutSession->getLastRealOrder();

    	return $this->_paymentpix->getPix( $order->getId() );



    }
}
