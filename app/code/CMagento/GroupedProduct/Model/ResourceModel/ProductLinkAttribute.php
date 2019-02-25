<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/18/19
 * Time: 9:15 AM
 */

namespace CMagento\GroupedProduct\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductLinkAttribute extends AbstractDb
{
    /**
     * Author constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param string|null $connectionName
     */
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, ?string $connectionName = null)
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
        $this->_init('catalog_product_link_attribute_varchar','value_id');
    }
}