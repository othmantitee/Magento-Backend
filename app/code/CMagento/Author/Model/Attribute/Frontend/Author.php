<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/11/19
 * Time: 11:33 AM
 */

namespace CMagento\Author\Model\Attribute\Frontend;


use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;

/**
 * Class Author
 * @package CMagento\Author\Model\Attribute\Frontend
 */
class Author extends AbstractFrontend
{
    /**
     * @param \Magento\Framework\DataObject $object
     * @return mixed
     */
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $attribute_code = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attribute_code);
        return nl2br(htmlspecialchars($value));
    }
}