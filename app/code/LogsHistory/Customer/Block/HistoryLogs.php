<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/29/19
 * Time: 9:47 AM
 */

namespace LogsHistory\Customer\Block;


use Magento\Framework\View\Element\Template;

/**
 * Class HistoryLogs for rendering the last login info. of customer in "customer/account" page.
 * @package LogsHistory\Customer\Block
 */
class HistoryLogs extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \LogsHistory\Logs\Model\LogEntryFactory
     */
    protected $logEntryFactory;

    /**
     * @var \LogsHistory\Logs\Model\ResourceModel\LogEntry\CollectionFactory
     */

    /**
     * @var \LogsHistory\Logs\Model\ResourceModel\LogEntry\CollectionFactory
     */
    protected $logEntryCollectionFactory;

    /**
     * HistoryLogs constructor.
     * @param Template\Context $context
     * @param array $data
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \LogsHistory\Logs\Model\LogEntryFactory $logEntryFactory
     * @param \LogsHistory\Logs\Model\ResourceModel\LogEntry\CollectionFactory $logEntryCollectionFactory
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Customer\Model\Session $customerSession,
        \LogsHistory\Logs\Model\LogEntryFactory $logEntryFactory,
        \LogsHistory\Logs\Model\ResourceModel\LogEntry\CollectionFactory $logEntryCollectionFactory)
    {
        $this->logEntryFactory =$logEntryFactory;
        $this->logEntryCollectionFactory =$logEntryCollectionFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve the last login info ('entry_date','ip_address','user_agent') of the current customer.
     *
     * @return array
     */
    public function getLastLog()
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        $collection = $this->logEntryCollectionFactory->create();
        $collection->addFieldToSelect('*')->addFieldToFilter('customer_fk_id',array('eq'=>$customerId));
        $collection = array_reverse($collection->getData());
        return isset($collection[1]) ? $collection[1] : $collection[0];
    }
}