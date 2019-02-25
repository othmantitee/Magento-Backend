<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/6/19
 * Time: 2:26 PM
 */

namespace CMagento\Author\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Author
 * @package CMagento\Author\ModelResourceModel
 */
class Author extends AbstractDb
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
        $this->_init('cmagento_author','author_id');
    }
}