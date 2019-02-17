<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/20/2019
 * Time: 11:41 AM
 */

namespace ITGSoftware\Itg\Block;


use Magento\Framework\View\Element\Template;

/**
 * Class AddingBrand
 * @package ITGSoftware\Itg\Block
 */
class AddingBrand extends Template
{
    /**
     * AddingBrand constructor.
     *
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }


    /**
     * Retrieve previous values of form's inputs.
     *
     * @return array
     */
    public  function getFieldsValue()
    {
        $data = $this->getRequest()->getParams();
        return $data;
    }

}