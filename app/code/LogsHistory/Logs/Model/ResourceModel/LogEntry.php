<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 1:41 PM
 */

namespace LogsHistory\Logs\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class LogEntry
 * @package LogsHistory\Logs\Model\ResourceModel
 */
class LogEntry extends AbstractDb
{
    /**
     * LogEntry constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param null $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $connectionName = null)
    {
        parent::__construct($context, $connectionName);
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('logshistory_log_entries','entry_id');
    }
}