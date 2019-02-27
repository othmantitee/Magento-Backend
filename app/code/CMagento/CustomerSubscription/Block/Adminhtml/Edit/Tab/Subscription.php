<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/26/19
 * Time: 9:14 AM
 */

namespace CMagento\CustomerSubscription\Block\Adminhtml\Edit\Tab;


use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;

class Subscription extends \Magento\Backend\Block\Widget\Form\Generic implements TabInterface
{

    /**
     * @var string
     */
    protected $_template = 'CMagento_CustomerSubscription::tab/subscription.phtml';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }


    /**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Customer Subscriptions');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Customer Subscriptions');
    }

    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return '';
    }

    /**
     * Initialize the form.
     *
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function initForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }
        /**@var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('_newsletter');

        $form->addFieldset('base_fieldset', ['legend' => __('Subscriptions Information')]);

        $this->setForm($form);
        return $this;
    }

        /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        if($this->getCustomerId()){
            return false;
        }
        return true;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm();
            return parent::_toHtml();
        } else {
            return '';
        }
    }

}