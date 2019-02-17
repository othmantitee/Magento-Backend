<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/7/19
 * Time: 4:36 PM
 */

namespace CMagento\Author\Block\Adminhtml\Author\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinueButton
 * @package CMagento\Author\Block\Adminhtml\Author\Edit
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'data_attribute' =>[
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ]
            ],
            'class' => 'save',
            'sort_order' => 80
        ];
    }
}