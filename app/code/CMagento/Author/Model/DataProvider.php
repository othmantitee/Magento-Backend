<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/7/19
 * Time: 11:13 AM
 */

namespace CMagento\Author\Model;


/**
 * Class DataProvider
 * @package CMagento\Author\Model
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ResourceModel\Author\CollectionFactory $authorCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ResourceModel\Author\CollectionFactory $authorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $authorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $author) {
            $this->loadedData[$author->getId()] = $author->getData();
        }


        return $this->loadedData;
    }
}