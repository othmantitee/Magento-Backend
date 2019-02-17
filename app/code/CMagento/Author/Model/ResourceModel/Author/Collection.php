<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/6/19
 * Time: 2:30 PM
 */

namespace CMagento\Author\Model\ResourceModel\Author;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package CMagento\Author\Model\ResourceModel\Author
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'author_id';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('CMagento\Author\Model\Author','CMagento\Author\Model\ResourceModel\Author');
    }
}