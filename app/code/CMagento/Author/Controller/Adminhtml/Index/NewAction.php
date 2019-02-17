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
use Magento\Backend\Model\View\Result\ForwardFactory;


/**
 * Class NewAuthor
 * @package CMagento\Author\Controller\Adminhtml\Author
 */
class NewAction extends AuthorController
{

    /**
     * @var PageFactory
     */
    protected $_resultForwardFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context,$coreRegistry);
        $this->_resultForwardFactory = $resultForwardFactory;
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
        $resultForward = $this->_resultForwardFactory->create();
        return $resultForward->forward('edit');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('CMagento_Author');
    }
}