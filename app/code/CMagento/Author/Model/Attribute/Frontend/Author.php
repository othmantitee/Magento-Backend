<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/11/19
 * Time: 11:33 AM
 */

namespace CMagento\Author\Model\Attribute\Frontend;


use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;

class Author extends AbstractFrontend
{
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        return "<b>$value</b>";
    }
}