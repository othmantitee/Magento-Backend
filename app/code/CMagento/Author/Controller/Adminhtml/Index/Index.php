<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/6/19
 * Time: 2:39 PM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;

use CMagento\Author\Controller\Adminhtml\Index\Author as AuthorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Serialize\Serializer\Json as JsonHelper;

/**
 * Class Index
 * @package CMagento\Author\Controller\Adminhtml\Author
 */
class Index extends AuthorController
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    protected $_jsonHelper;

    /**
     * Index constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param JsonHelper $jsonHelper
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        JsonHelper $jsonHelper)
    {
        parent::__construct($context,$coreRegistry);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_jsonHelper = $jsonHelper;
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
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('CMagento_Author::authors_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Author'));
        return $resultPage;
    }

    /**
     * Create a json response
     *
     * @param string $response
     * @return \ Magento \ Framework \ Controller \ ResultInterface
     */
    public function jsonResponse($response='')
    {
        return $this->getResponse()->representJson(
            $this->_jsonHelper->serialize($response)
        );
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('CMagento_Author');
    }
}