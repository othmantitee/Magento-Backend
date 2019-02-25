<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/17/19
 * Time: 4:44 PM
 */

namespace CMagento\GroupedProduct\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * To add color and size attributes as grouped-product attributes
 *
 * @package CMagento\GroupedProduct\Setup
 */
class InstallData  implements InstallDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Install grouped product link attributes
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $data = [
            [
                'link_type_id' => \Magento\GroupedProduct\Model\ResourceModel\Product\Link::LINK_TYPE_GROUPED,
                'product_link_attribute_code' => 'color',
                'data_type' => 'varchar',
            ],
            [
                'link_type_id' => \Magento\GroupedProduct\Model\ResourceModel\Product\Link::LINK_TYPE_GROUPED,
                'product_link_attribute_code' => 'size',
                'data_type' => 'varchar',
            ],
        ];

        $setup->getConnection()->insertMultiple(
            $setup->getTable('catalog_product_link_attribute'),
            $data);

        $setup->endSetup();
    }
}