<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/26/19
 * Time: 10:09 AM
 */

namespace CMagento\CustomerSubscription\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Subscription extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = "customer_subscription";


    protected function _construct()
    {
        $this->_init(\CMagento\CustomerSubscription\Model\ResourceModel\Subscription::class);
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