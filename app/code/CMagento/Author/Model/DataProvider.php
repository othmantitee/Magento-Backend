<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/7/19
 * Time: 11:13 AM
 */

namespace CMagento\Author\Model;

use Magento\Backend\Model\Auth;
use Magento\Store\Model\StoreManagerInterface;


/**
 * Class DataProvider
 * @package CMagento\Author\Model
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    protected $authorFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ResourceModel\Author\CollectionFactory $authorCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ResourceModel\Author\CollectionFactory $authorCollectionFactory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\App\RequestInterface $request,
        AuthorFactory $authorFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->_request =$request;
        $this->storeManager = $storeManager;
        $this->authorFactory =$authorFactory;
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

        $this->loadedData = array();

        /**
         * for populate form data fields after errors.
         */
        $previousData = $this->_request->getParam('previousData');
        if(isset($previousData)){
            $author = $this->authorFactory->create();
            $author->setData(
                [
                    'first_name' => $previousData['first_name'],
                    'last_name'  => $previousData['last_name'],
                    'email'      => $previousData['email'],
                    'phone'      => $previousData['phone'],
                    'image'      => $previousData['image']
                ]
            );
            $this->loadedData[$author->getId()] = $author->getData();
        }
        unset($previousData);


        $items = $this->collection->getItems();
        foreach ($items as $author) {
            $this->loadedData[$author->getId()] = $author->getData();
            if ($author->getImage()) {
                $m['image'][0]['name'] = $author->getImage();
                $m['image'][0]['url'] = $this->getMediaUrl().$author->getImage();
                $fullData = $this->loadedData;
                $this->loadedData[$author->getId()] = array_merge($fullData[$author->getId()], $m);
            }
        }


        return $this->loadedData;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'author/icon/';
        return $mediaUrl;
    }
}