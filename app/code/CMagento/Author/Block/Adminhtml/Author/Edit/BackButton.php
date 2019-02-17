<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/7/19
 * Time: 4:35 PM
 */

namespace CMagento\Author\Block\Adminhtml\Author\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class BackButton
 * @package CMagento\Author\Block\Adminhtml\Author\Edit
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'onclick' => sprintf("location.href='%s';",$this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get url for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}