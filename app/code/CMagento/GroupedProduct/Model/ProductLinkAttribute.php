<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/18/19
 * Time: 9:14 AM
 */

namespace CMagento\GroupedProduct\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class ProductLinkAttribute extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = "cmagento_product_link_attribute";

    /**
     * @var string
     */
    protected $_cacheTag = "cmagento_product_link_attribute";

    /**
     * @var string
     */
    protected $_eventPrefix = "cmagento_product_link_attribute";

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('CMagento\GroupedProduct\Model\ResourceModel\ProductLinkAttribute');
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