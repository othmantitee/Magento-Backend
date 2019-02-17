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
 * Class DeleteButtonextends
 * @package CMagento\Author\Block\Adminhtml\Author\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if($this->getModelId()){
            $data = [
                'label' => __('Delete Author'),
                'on_click' => 'deleteConfirm(\''
                    .__('Are you sure you want to do this?').'\',\''.
                    $this->getDeleteUrl().'\')',
                'class' => 'delete',
                'sort_order' =>20
            ];
        }
        return $data;
    }

    /**
     * Get url for delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete',['author_id' => $this->getModelId()]);
    }
}