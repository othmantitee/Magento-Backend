<?php
namespace ItgSoftware\Brands\Model\ResourceModel\Brand;

/**
 * Brand collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

	/**
	 * @var 
	 */
	protected $_idFieldName = 'brand_id';
	protected $_eventPrefix = 'itg_brands_brand_collection';
	protected $_eventObject = 'brand_collection';

	/**
     * Initialize brand collection 
     *
     * @return void
	 */
	protected function _construct()
	{
		$this->_init('ItgSoftware\Brands\Model\Brand', 'ItgSoftware\Brands\Model\ResourceModel\Brand');
	}

}
