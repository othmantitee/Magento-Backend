<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/11/19
 * Time: 11:32 AM
 */

namespace CMagento\Author\Model\Attribute\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Author extends AbstractSource
{

    private $_authorCollectionFactory;
    private $_authorResourceFactory;
    private $_authorFactory;
    public function __construct(
        \CMagento\Author\Model\ResourceModel\Author\CollectionFactory $authorCollectionFactory,
        \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory,
        \CMagento\Author\Model\AuthorFactory $authorFactory

    )
    {
        $this->_authorCollectionFactory = $authorCollectionFactory;
        $this->_authorResourceFactory =$authorResourceFactory;
        $this->_authorFactory = $authorFactory;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $collection = $this->_authorCollectionFactory->create();
        $resourceModel = $this->_authorResourceFactory->create();
        $author = $this->_authorFactory->create();
        $author->getIdentities();
        $ids = $collection->getAllIds();
        $opptions = [];

        foreach ($ids as $authorId){
            $resourceModel->load($author,$authorId,'author_id');
            $name = $author->getFirstName().' '. $author->getLastName();
            $opptions[] = ['label' => $name, 'value' => $authorId];
        }


        if (!$this->_options) {
            $this->_options = $opptions;
        }
        return $this->_options;
    }
}