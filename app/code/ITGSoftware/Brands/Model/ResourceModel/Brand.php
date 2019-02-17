<?php
/**
 * 
 * 
 */
namespace ItgSoftware\Brands\Model\ResourceModel;

/**
 * Brand resource model
 */
class Brand extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	/**
	 * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
	 */
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	/**
     * Initialize brand resource model
     *
     * @return void
     */
	protected function _construct()
	{
		$this->_init('itg_brands_brand', 'brand_id');
	}
	
}