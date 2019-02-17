<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/7/19
 * Time: 4:39 PM
 */

namespace CMagento\Author\Block\Adminhtml\Author\Edit;


use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * GenericButton constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Return model id
     *
     * @return int | null
     */
    public function getModelId()
    {
        return $this->context->getRequest()->getParam('author_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route='',$params=[])
    {
        return  $this->context->getUrlBuilder()->getUrl($route,$params);
    }
}