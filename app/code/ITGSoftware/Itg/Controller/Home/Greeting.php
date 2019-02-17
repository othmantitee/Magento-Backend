<?php
/**
 * 
 */

namespace ItgSoftware\Itg\Controller\Home;

use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 *Greeting page controller 
 */
    class Greeting extends \Magento\Framework\App\Action\Action
    {
        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        protected $_pageFactory;

        /**
         * @param \Magento\Framework\App\Action\Context $context
         * @param \Magento\Framework\View\Result\PageFactory $pageFactory
         * @return \Magento\Framework\App\Action\Action
         */
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory
            ){
            $this->_pageFactory = $pageFactory;
            return parent:: __construct($context);
        }
        
        /**
         * Itg Greeting action
         */
        public function execute()
        {
            return $this->_pageFactory->create();
        }
    }