<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/11/19
 * Time: 10:25 AM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;

use CMagento\Author\Controller\Adminhtml\Index\Author as AuthorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 * @package CMagento\Author\Controller\Adminhtml\Index
 */
class MassDelete extends AuthorController
{
    /**
     * @var \CMagento\Author\Model\ResourceModel\AuthorFactory
     */
    protected $_authorResourceFactory;

    /**
     * @var \CMagento\Author\Model\ResourceModel\AuthorFactory
     */
    protected $_authorCollectionFactory;

    /**
     * @var Filter
     */
    protected $filter;

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
     * @param Context $context
     * @param Registry $coreRegistry
     * @param \CMagento\Author\Model\ResourceModel\Author\CollectionFactory $authorCollectionFactory
     * @param \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory
     * @param Filter $filter
     * @param TypeListInterface $cacheTypeList
     * @param FrontendPool $cacheFrontendPool
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        \CMagento\Author\Model\ResourceModel\Author\CollectionFactory $authorCollectionFactory,
        \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory,
        Filter $filter,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool)
    {
        $this->filter = $filter;
        $this->_authorCollectionFactory = $authorCollectionFactory;
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
     */
    public function execute()
    {



        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $resourceModel = $this->_authorResourceFactory->create();
            $selectedAuthors = $this->filter->getCollection($this->_authorCollectionFactory->create());
            $size = $selectedAuthors->getSize();

            foreach ($selectedAuthors as $author){
                $resourceModel->load($author,$author->getAuthorId(),'author_id');
                $author->delete();
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 author(s) have been deleted.', $size));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}