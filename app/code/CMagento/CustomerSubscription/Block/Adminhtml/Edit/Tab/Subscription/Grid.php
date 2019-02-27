<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/26/19
 * Time: 9:15 AM
 */

namespace CMagento\CustomerSubscription\Block\Adminhtml\Edit\Tab\Subscription;

use Magento\Customer\Controller\RegistryConstants;


class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @var \CMagento\CustomerSubscription\Model\ResourceModel\Subscription\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \CMagento\CustomerSubscription\Model\ResourceModel\Subscription\CollectionFactory $collectionFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \CMagento\CustomerSubscription\Model\ResourceModel\Subscription\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('subscriptionGrid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('desc');

        $this->setUseAjax(true);

        $this->setEmptyText(__('No Subscription Found'));
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('customer/*/subscription', ['_current' => true]);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $customerId = $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);

        /** @var $collection \CMagento\CustomerSubscription\Model\ResourceModel\Subscription\Collection */
        $collection = $this->_collectionFactory->create()->addCustomerFilter($customerId);

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'subscription_id',
            ['header' => __('Subscription ID'), 'align' => 'left', 'index' => 'subscription_id', 'width' => 10]
        );

        $this->addColumn(
            'type',
            [
                'header' => __('Subscription type'),
                'type' => 'text',
                'align' => 'center',
                'index' => 'type',
                'default' => ''
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'type' => 'text',
                'align' => 'center',
                'index' => 'status',
                'default' => ''
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created at'),
                'type' => 'datetime',
                'align' => 'center',
                'index' => 'created_at',
                'gmtoffset' => true,
                'default' => ' ---- '
            ]
        );

        return parent::_prepareColumns();
    }
}