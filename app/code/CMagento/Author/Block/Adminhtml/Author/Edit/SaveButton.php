<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/7/19
 * Time: 4:36 PM
 */

namespace CMagento\Author\Block\Adminhtml\Author\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Author'),
            'data_attribute' =>[
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'class' => 'save primary',
            'sort_order' => 90
        ];
    }
}