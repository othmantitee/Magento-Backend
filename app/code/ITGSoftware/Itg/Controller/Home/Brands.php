<?php
/**
 * 
 */
namespace ItgSoftware\Itg\Controller\Home;

use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Brands page controller
 */
    class Brands extends \Magento\Framework\App\Action\Action
    {
        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        protected $_pageFactory;

        /**
         * @param \Magento\Framework\App\Action\Context $contex
         * @param \Magento\Framework\View\Result\PageFactory $pageFactory
         */
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory
        ){
            $this->_pageFactory = $pageFactory;
            return parent:: __construct($context);
        }
        
        /**
         * Itg dispaly brands action
         */
        public function execute()
        {
           return $this->_pageFactory->create();
        }
    }