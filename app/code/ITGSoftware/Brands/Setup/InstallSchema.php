<?php
/**
 * 
 * 
 */

namespace ItgSoftware\Brands\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class for creating itg_brands_brand table
 */
    class InstallSchema implements InstallSchemaInterface 
    {

        /**
         * @param SchemaSetupInterface $setup
         * @param ModuleContextInterface $context
         * @throws \Zend_Db_Exception
         */
        public function install(SchemaSetupInterface $setup,ModuleContextInterface $context) {
            $table = $setup->getConnection()
            ->newTable($setup->getTable('itg_brands_brand'))
            ->addColumn(
                'brand_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true , 'unsigned'=>true, 'nullable'=>false,'primary'=>true],
                'Greeting ID'
            )->addColumn(
                'brand_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable'=>false,'default'=>''],
                'Brand Name'
            )->addColumn(
                'brand_img_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable'=>false,'default'=>''],
                'Brand Image URL'
            )->addColumn(
                'brand_site_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable'=>false,'default'=>''],
                'Brand Website Link'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable'=>false,'default'=>''],
                'Brand Description'
            )->setComment('ITG Brands Table');
            $setup->getConnection()->createTable($table);

        }
    }