<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/18/19
 * Time: 9:16 AM
 */

namespace CMagento\GroupedProduct\Model\ResourceModel\ProductLinkAttribute;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'value_id';

    /**
     * Name of  query main table
     *
     * @var  string
     */
    private $product_link_attribute_table;

    /**
     * Name of table to be joined
     *
     * @var string
     */
    private $product_link_table;

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('CMagento\GroupedProduct\Model\ProductLinkAttribute', 'CMagento\GroupedProduct\Model\ResourceModel\ProductLinkAttribute');
    }

    /**
     * Set collection filter to get product link attribute
     *
     * @param $linkedProductId
     * @param $productLinkAttributeId
     */
    public function filterCustomAttribute($linkedProductId,$productLinkAttributeId)
    {
        $this->product_link_attribute_table = "main_table";
        $this->product_link_table = $this->getTable("catalog_product_link");
        $this->getSelect()
            ->joinInner(array('attribute' => $this->product_link_table),
                $this->product_link_attribute_table.'.link_id = attribute.link_id
                AND attribute.linked_product_id='.$linkedProductId);
        $this->getSelect()->where("product_link_attribute_id=".$productLinkAttributeId);
    }
}