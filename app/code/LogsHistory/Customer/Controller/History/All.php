<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 9:18 AM
 */

namespace LogsHistory\Customer\Controller\History;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class All
 * @package LogsHistory\Customer\Controller\History
 */
class All extends Action
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var \Magento\Framework\View\Element\UiComponentFactory
     */
    protected $factory;

    /**
     * All constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param \Magento\Framework\View\Element\UiComponentFactory $factory
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(Context $context,
        PageFactory $pageFactory,
        \Magento\Framework\View\Element\UiComponentFactory $factory,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->pageFactory = $pageFactory;
        $this->factory = $factory;
        $this->customerSession = $customerSession;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        if ($this->customerSession->isLoggedIn()) {
            $isAjax = $this->getRequest()->isAjax();
            if ($isAjax) {
                $component = $this->factory->create($this->_request->getParam('namespace'));
                $this->prepareComponent($component);
                $this->_response->appendBody((string) $component->render());
            } else {
                $resultPage = $this->pageFactory->create();
                return $resultPage;
            }
        } else {
            $this->customerSession->authenticate();
        }
    }

    /**
     * @param UiComponentInterface $component
     */
    protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}