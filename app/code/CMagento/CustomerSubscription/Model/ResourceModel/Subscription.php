<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/26/19
 * Time: 10:17 AM
 */

namespace CMagento\CustomerSubscription\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Subscription extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customer_subscriptions','subscription_id');
    }
}