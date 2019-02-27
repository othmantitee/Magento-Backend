<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 1:42 PM
 */

namespace CMagento\CustomerSubscription\Model\ResourceModel\Subscription;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package CMagento\CustomerSubscription\Model\ResourceModel\Subscription
 */
class Collection extends AbstractCollection
{
    /**
     * Initializes collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_map['fields']['subscription_id'] = 'main_table.subscription_id';
        $this->_init(\CMagento\CustomerSubscription\Model\Subscription::class,
            \CMagento\CustomerSubscription\Model\ResourceModel\Subscription::class);
    }


    /**
     * Set filter for subscription by customer.
     *
     * @param int $customerId
     * @return $this
     */
    public function addCustomerFilter($customerId)
    {
        $this->getSelect()->where(
            'main_table.customer_fk_id = ?',
            $customerId
        );

        return $this;
    }


}