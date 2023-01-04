<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Takemiya\U4crypto\Controller\Adminhtml\U4cryptotransaction;

class Delete extends \Takemiya\U4crypto\Controller\Adminhtml\U4cryptotransaction
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('u4cryptotransaction_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Takemiya\U4crypto\Model\U4cryptotransaction::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the U4Cryptotransaction.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['u4cryptotransaction_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a U4Cryptotransaction to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

