<?php
/**
 * 
 * 
 */
namespace ItgSoftware\Brands\Model;

/**
 * Brand model
 *
 */
class Brand extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	/**
	 * Brand cache tag
	 */
	const CACHE_TAG = 'itg_brands_brand';

	/**
	 * Model cache tag
	 * 
	 * @var string
	 */
	protected $_cacheTag = 'itg_brands_brand';

	/**
	 * Model event prefix
	 * 
	 * @var string
	 */
	protected $_eventPrefix = 'itg_brands_brand';

	/**
     * Initialize brand model
     *
     * @return void
     */
	protected function _construct()
	{
		$this->_init('ItgSoftware\Brands\Model\ResourceModel\Brand');
	}

	/**
	 * Retrieve brand ID
	 * 
	 * @return string
	 */
	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
}
