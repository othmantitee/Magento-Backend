<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/6/19
 * Time: 11:44 AM
 */

namespace CMagento\Author\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package CMagento\Author\Setup
 */
class InstallSchema  implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(!$setup->tableExists('cmagento_author')){
            $table = $setup->getConnection()->newTable(
                $setup->getTable('cmagento_author')
            )
                ->addColumn(
                    'author_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Author ID'
                )
                ->addColumn(
                    'first_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    40,
                    ['nullable => false'],
                    'First Name'
                )
                ->addColumn(
                    'last_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    40,
                    ['nullable => false'],
                    'Last Name'
                )
                ->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    50,
                    ['nullable => false'],
                    'Author Email'
                )
                ->addColumn(
                    'phone',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    40,
                    ['nullable => false'],
                    'Author Phone'
                )
                ->setComment('Author Table');
            $setup->getConnection()->createTable($table);

        }
        $setup->endSetup();
    }
}