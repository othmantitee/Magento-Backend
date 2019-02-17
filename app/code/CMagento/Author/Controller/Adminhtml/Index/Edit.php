<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/10/19
 * Time: 11:05 AM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;

use CMagento\Author\Controller\Adminhtml\Index\Author as AuthorController;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

/**
 * Edit action controller
 * @package CMagento\Author\Controller\Adminhtml\Index
 */
class Edit extends AuthorController
{
    /**
     * @var PageFactory
     */
    protected  $_pageFactory;

    /**
     * @var \CMagento\Author\Model\AuthorFactory
     */
    protected $_authorFactory;

    /**
     * @var \CMagento\Author\Model\ResourceModel\AuthorFactory
     */
    protected $_authorResourceFactory;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $pageFactory
     * @param \CMagento\Author\Model\AuthorFactory $authorFactory
     * @param \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory
     */
    public function __construct(
        Action\Context $context,
        Registry $coreRegistry,
        PageFactory $pageFactory,
        \CMagento\Author\Model\AuthorFactory $authorFactory,
        \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_authorFactory = $authorFactory;
        $this->_authorResourceFactory =$authorResourceFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     *Edit action
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $id= $this->getRequest()->getParam('author_id');
        $model = $this->_authorFactory->create();
        $resourceModel = $this->_authorResourceFactory->create();

        if($id){
            $resourceModel->load($model,$id,'author_id');
            if(!$model){
                $this->messageManager->addErrorMessage(__('This author is no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('author',$model);

        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu('CMagento_Author::Author');
        $this->initPage($resultPage)->addBreadcrumb(
          $id ? __('Edit Author'): __('New Author'),
          $id ? __('Edit Author') : __('New Author')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Author'));
        $resultPage->getConfig()->getTitle()->prepend($id ?  __('Edit Author') : __('New Author'));

        return $resultPage;
    }
}