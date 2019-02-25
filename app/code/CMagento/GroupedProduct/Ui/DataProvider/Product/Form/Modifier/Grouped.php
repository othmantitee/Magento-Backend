<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/20/19
 * Time: 2:37 PM
 */

namespace CMagento\GroupedProduct\Ui\DataProvider\Product\Form\Modifier;
use CMagento\GroupedProduct\Model\ProductLinkAttributeFactory as LinkAttributeFactory;
use CMagento\GroupedProduct\Model\ResourceModel\ProductLinkAttribute\CollectionFactory;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductLinkInterface;
use Magento\Catalog\Api\ProductLinkRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Image as ImageHelper;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Eav\Api\AttributeSetRepositoryInterface;
use Magento\Framework\Locale\CurrencyInterface;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Form;

/**
 * Class Grouped override the product link ui grid and add extra columns to it.
 * @package CMagento\GroupedProduct\Ui\DataProvider\Product\Form\Modifier
 */
class Grouped  extends \Magento\GroupedProduct\Ui\DataProvider\Product\Form\Modifier\Grouped
{
    /**
     * Integer value of color attribute id
     */
    const COLOR_ATTR_ID = 6;

    /**
     * Integer value of size attribute id
     */
    const SIZE_ATTR_ID = 7;

    /**
     * @var LinkAttributeFactory
     */
    protected $linkAttributeFactory;

    protected $linkAttributeCollectionFactory;

    /**
     * Grouped constructor.
     * @param LocatorInterface $locator
     * @param UrlInterface $urlBuilder
     * @param ProductLinkRepositoryInterface $productLinkRepository
     * @param ProductRepositoryInterface $productRepository
     * @param ImageHelper $imageHelper
     * @param Status $status
     * @param AttributeSetRepositoryInterface $attributeSetRepository
     * @param CurrencyInterface $localeCurrency
     * @param LinkAttributeFactory $linkAttributeFactory
     * @param CollectionFactory $collectionFactory
     * @param array $uiComponentsConfig
     */
    public function __construct(
        LocatorInterface $locator,
        UrlInterface $urlBuilder,
        ProductLinkRepositoryInterface $productLinkRepository,
        ProductRepositoryInterface $productRepository,
        ImageHelper $imageHelper,
        Status $status,
        AttributeSetRepositoryInterface $attributeSetRepository,
        CurrencyInterface $localeCurrency,
        LinkAttributeFactory $linkAttributeFactory,
        CollectionFactory $collectionFactory,
        array $uiComponentsConfig = [])
    {
        $this->linkAttributeFactory =$linkAttributeFactory;
        $this->linkAttributeCollectionFactory = $collectionFactory;

        parent::__construct($locator,
            $urlBuilder,
            $productLinkRepository,
            $productRepository,
            $imageHelper,
            $status,
            $attributeSetRepository,
            $localeCurrency,
            $uiComponentsConfig);
    }

    /**
     * Add extra attributes (columns) to product's link grid.
     *
     * @return array
     */
    protected function fillMeta()
   {
       $meta = parent::fillMeta();
       $additionalMeta = [
           'color' => [
               'arguments' => [
                   'data' => [
                       'config' => [
                           'dataType' => Form\Element\DataType\Text::NAME,
                           'formElement' => Form\Element\Input::NAME,
                           'componentType' => Form\Field::NAME,
                           'dataScope' => 'color',
                           'label' => __('Default Color'),
                           'fit' => true,
                           'additionalClasses' => 'admin__field-small',
                           'sortOrder' =>81
                       ],
                   ],
               ],
           ],
           'size' => [
               'arguments' => [
                   'data' => [
                       'config' => [
                           'dataType' => Form\Element\DataType\Text::NAME,
                           'formElement' => Form\Element\Input::NAME,
                           'componentType' => Form\Field::NAME,
                           'dataScope' => 'size',
                           'label' => __('Default Size'),
                           'fit' => true,
                           'additionalClasses' => 'admin__field-small',
                           'sortOrder' => 82
                       ],
                   ],
               ],
           ]
       ];

       $meta = array_merge($meta,$additionalMeta);
       return $meta;
   }

    /**
     * Initialize the additional product's link attribute, merge them with
     * original attributes and return the merged attribute as an array.
     *
     * @param ProductInterface $linkedProduct
     * @param ProductLinkInterface $linkItem
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Zend_Currency_Exception
     */
   protected function fillData(ProductInterface $linkedProduct, ProductLinkInterface $linkItem)
   {
       $linkedProductId = $linkedProduct->getId();
       $collection = $this->linkAttributeCollectionFactory->create();
       $collection->filterCustomAttribute($linkedProductId,self::COLOR_ATTR_ID);
       $color =  $collection->getFirstItem()->getValue();
       $collection->filterCustomAttribute($linkedProductId,self::SIZE_ATTR_ID);
       $size =  $collection->getFirstItem()->getValue();

       $data =  parent::fillData($linkedProduct, $linkItem);
       $additionalData = [
           'size' => $size,
           'color' => $color,
       ];
       $data = array_merge($data,$additionalData);
       return $data;
   }
}