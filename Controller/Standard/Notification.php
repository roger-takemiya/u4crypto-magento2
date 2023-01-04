<?php

namespace Takemiya\U4crypto\Controller\Standard;





class Notification extends \Takemiya\U4crypto\Controller\Standard\ApiController {



     protected $order;
     protected $context;
     protected $scopeConfig;

     protected $_u4cryptotransaction;
     protected $_u4cryptoHelper;

     protected $orderRepository;
     protected $invoiceService;
     protected $transaction;
     protected $invoiceSender;

	 public function __construct(
	 	\Magento\Framework\App\Action\Context $context,          
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Takemiya\U4crypto\Model\U4cryptotransaction $u4cryptotransaction,
        \Takemiya\U4crypto\Helper\Data $u4cryptoHelper,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Model\Service\InvoiceService $invoiceService,
        \Magento\Sales\Model\Order\Email\Sender\InvoiceSender $invoiceSender,
        \Magento\Framework\DB\Transaction $transaction
    ) {
        

        parent::__construct($context);

        $this->context = $context;
       
        $this->scopeConfig = $scopeConfig;
      
        $this->_u4cryptotransaction = $u4cryptotransaction;
        $this->_u4cryptoHelper = $u4cryptoHelper;

        $this->orderRepository = $orderRepository;
        $this->invoiceService = $invoiceService;
        $this->transaction = $transaction;
        $this->invoiceSender = $invoiceSender;
      

    }

	public function execute() {  		 
	
		 $entityBody = file_get_contents('php://input');

		
         //$data = json_decode(stripslashes(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', utf8_encode($entityBody))), true );

         $output = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($entityBody));

         $data = json_decode($output, true);


         if( $data ){



         	 $transactions = $this->_u4cryptotransaction->getCollection()
                                  ->addFieldToSelect('*')
                                  ->addFieldToFilter('transaction', $data['id']);
                                  
         
	         
	         if($transactions->getSize()){

	             $data = $transactions->getFirstItem();

				 $order = $this->orderRepository->get($data->getOrder_id());


				 if (!$order->getId()) {
				 	echo json_encode(["status" => __("Order not founded"), "error" => 1]);
				 }

				 if ($order->isCanceled()) {
				 	echo json_encode(["status" => __("Order is canceled"), "error" => 1]);
				 }

		         if ($order->canInvoice()) {

		             $invoice = $this->invoiceService->prepareInvoice($order);
		             $invoice->register();
		             $invoice->save();
		             $transactionSave = $this->transaction->addObject(
		                $invoice
		             )->addObject(
		                $invoice->getOrder()
		             );
		             $transactionSave->save();
		             $this->invoiceSender->send($invoice);
	
		             $order->addStatusHistoryComment(
		                __('Invoice created #%1.', $invoice->getId())
		             )
		                ->setIsCustomerNotified(false)
		                ->save();

		             echo json_encode(["status" => __("Invoice created"), "error" => 0]);
		        }else{
		        	 echo json_encode(["status" => __("Invoice already created"), "error" => 1]);
		        }
	             
	         }else{
	         	echo json_encode(["status" => __("Transaction not founded"), "error" => 1]);
	         }

		 }else{
		 	echo json_encode(["status" => __("Invalid JSON"), "error" => 1]);
		 }

	}





}