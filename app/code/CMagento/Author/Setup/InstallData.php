<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/11/19
 * Time: 11:28 AM
 */

namespace CMagento\Author\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
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
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
//        $eavSetup->removeAttribute(
//            \Magento\Catalog\Model\Product::ENTITY,
//            'author');


        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'author',
            [
                'type' => 'varchar',
                'source' => 'CMagento\Author\Model\Attribute\Source\Author',
                'frontend' => 'CMagento\Author\Model\Attribute\Frontend\Author',
                'backend' => '',
                'label' => 'Product Authors',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'input' => 'multiselect',
                'class' => '',
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'sort_order' => 50,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => false,
                'is_html_allowed_on_front' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
    }
}