<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 1:40 PM
 */

namespace LogsHistory\Logs\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class LogEntry
 * @package LogsHistory\Logs\Model
 */
class LogEntry extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = "logshistory_logs_logentry";

    /**
     * @var string
     */
    protected $_cacheTag = "logshistory_logs_logentry";

    /**
     * @var string
     */
    protected $_eventPrefix = "logshistory_logs_logentry";


    protected function _construct()
    {
        $this->_init('LogsHistory\Logs\Model\ResourceModel\LogEntry');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }
}