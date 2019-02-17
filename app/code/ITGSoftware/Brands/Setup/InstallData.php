<?php
/**
 * 
 * 
 */

namespace ItgSoftware\Brands\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class for adding data to itg_brands_brand table
 */
    class InstallData implements InstallDataInterface {        

        /**
         * @param Magento\Framework\Setup\ModuleDataSetupInterface $setup
         * @param Magento\Framework\Setup\ModuleContextInterface $context
         */
        public function install(ModuleDataSetupInterface $setup,ModuleContextInterface $context) {
           $data = [
               ['brand_name'=> 'Photoshop',
               'brand_img_url'=>'Itg_Brands::images/photoshop.png',
               'brand_site_url'=>'https://www.photoshop.com/',
               'description'=>'Pro image editor'],

               ['brand_name'=> 'iCalender',
               'brand_img_url'=>'Itg_Brands::images/icalender.png',
               'brand_site_url'=>'https://www.itgsoftware.com/itg-icalendar',
               'description'=>'good App'],

               ['brand_name'=> 'Awesome Scanner App',
               'brand_img_url'=>'Itg_Brands::images/asa.png',
               'brand_site_url'=>'https://www.itgsoftware.com/itg-awesome-scanner',
               'description'=>'Scanner App'],

               ['brand_name'=> 'Xpress',
               'brand_img_url'=>'Itg_Brands::images/xpress.png',
               'brand_site_url'=>'https://www.express.com/',
               'description'=>'Fashion website'],
           ];

           foreach($data as $bind){
                $setup->getConnection()
                ->insertForce($setup->getTable('itg_brands_brand'), $bind);
            }
        }
    }