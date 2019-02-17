<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/6/19
 * Time: 2:15 PM
 */

namespace CMagento\Author\Model;


use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Author extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = "cmagento_author";

    /**
     * @var string
     */
    protected $_cacheTag = "cmagento_author";

    /**
     * @var string
     */
    protected $_eventPrefix = "cmagento_author";

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('CMagento\Author\Model\ResourceModel\Author');
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