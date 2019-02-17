<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/5/19
 * Time: 10:11 AM
 */

namespace LogsHistory\Logs\Controller\Adminhtml\Customer;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use phpDocumentor\Reflection\Types\This;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class CustomerLogs
 * @package LogsHistory\Logs\Controller\Adminhtml
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('LogsHistory_Logs::manager');
        $resultPage->getConfig()->getTitle()->append(__('Logs History'));
        return $resultPage;
    }

    /**
     * Check Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('LogsHistory_Logs');
    }
}