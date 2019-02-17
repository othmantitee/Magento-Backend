<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/10/19
 * Time: 2:21 PM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;


use CMagento\Author\Controller\Adminhtml\Index\Author as AuthorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

/**
 * Delete action controller
 * @package CMagento\Author\Controller\Adminhtml\Index
 */
class Delete  extends AuthorController
{
    /**
     * @var \CMagento\Author\Model\AuthorFactory
     */
    protected $_authorFactory;

    /**
     * @var \CMagento\Author\Model\ResourceModel\AuthorFactory
     */
    protected $_authorResourceFactory;

    /**
     * @var TypeListInterface
     */
    protected $_cacheTypeList;

    /**
     * @var FrontendPool
     */
    protected $_cacheFrontendPool;


    /**
     * Save constructor.
     * @param Action\Context $context
     * @param Registry $coreRegistry
     * @param \CMagento\Author\Model\AuthorFactory $authorFactory
     * @param \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory
     * @param TypeListInterface $cacheTypeList
     * @param FrontendPool $cacheFrontendPool
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        \CMagento\Author\Model\AuthorFactory $authorFactory,
        \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool)
    {
        $this->_authorFactory = $authorFactory;
        $this->_authorResourceFactory =$authorResourceFactory;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_cacheTypeList = $cacheTypeList;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultRedirect  = $this->resultRedirectFactory->create();
            $id= $this->getRequest()->getParam('author_id');
            if($id){
                try{
                $model = $this->_authorFactory->create();
                $modelResource = $this->_authorResourceFactory->create();
                $modelResource->load($model,$id,'author_id');
                $modelResource->delete($model);
                $this->messageManager->addSuccessMessage(__('You deleted author.'));

                $this->_cacheTypeList->cleanType('config');
                foreach ($this->_cacheFrontendPool as $cacheFrontend){
                    $cacheFrontend->getBackend()->clean();
                }
                return $resultRedirect->setPath('*/*/');

            }catch (\Exception $exception){
                $this->messageManager->addErrorMessage( $exception->getMessage());
                return $resultRedirect->setPath('*/*/edit',['author_id'=>$id]);
                }
        }
            $this->messageManager->addErrorMessage('We can not find author to delete');
        return $resultRedirect->setPath('*/*/');
    }
}