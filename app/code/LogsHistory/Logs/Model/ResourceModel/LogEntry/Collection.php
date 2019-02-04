<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 1:42 PM
 */

namespace LogsHistory\Logs\Model\ResourceModel\LogEntry;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package LogsHistory\Logs\Model\ResourceModel\LogEntry
 */
class Collection extends AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('LogsHistory\Logs\Model\LogEntry','LogsHistory\Logs\Model\ResourceModel\LogEntry');
    }
}