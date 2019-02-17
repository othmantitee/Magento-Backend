<?php
/**
 * 
 */
namespace ItgSoftware\Itg\Block;

/**
 * Class for dispaly brands in table
 */
    class RenderBrands extends \Magento\Framework\View\Element\Template{

        /**
         * @var \ItgSoftware\Brands\Model\BrandFactory
         */
        protected $_brandFactory;

        /** 
         * @param \ItgSoftware\Brands\Model\BrandFactory $brandFactory
         */
        public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \ItgSoftware\Brands\Model\BrandFactory $brandFactory) {

                $this->_brandFactory = $brandFactory;
                parent::__construct($context);
        }

        /**
         * Retrieve the title of the brands table
         * 
         * @return string
         */
        public function getTitle()
        {
            return __("ITG Brands");
        }

        /**
         * Retrieve all brands 
         * 
         * @return array
         */
        public function getBrands()
        {
            $brand = $this->_brandFactory->create();
            $collection = $brand->getCollection();
            return $collection;
        }
    }