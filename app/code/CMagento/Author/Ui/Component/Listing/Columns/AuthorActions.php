<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/11/19
 * Time: 8:33 AM
 */

namespace CMagento\Author\Ui\Component\Listing\Columns;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class AuthorActions extends Column
{
    protected $_urlBuilder;
    const URL_PATH_EDIT ='author/index/edit';
    const URL_PATH_DELETE ='author/index/delete';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        UrlInterface $urlBuilder)
    {
        $this->_urlBuilder =$urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){
            foreach ($dataSource['data']['items'] as &$item){
                $item[$this->getData('name')]=[
                  'edit'=>[
                      'href' => $this->_urlBuilder->getUrl(
                          static::URL_PATH_EDIT,
                          ['author_id' => $item['author_id']]
                      ),
                      'label' => __('Edit')
                  ],
                    'delete'=>[
                        'href' => $this->_urlBuilder->getUrl(
                            static::URL_PATH_DELETE,
                            ['author_id' => $item['author_id']]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete ${$. $data.first_name} ${$. $data.last_name} .'),
                            'message' => __('Are you sure you wan \'t to delete "${$. $data.first_name} ${$. $data.last_name}" record ?')
                        ]
                    ]
                ];
            }
        }
        return $dataSource;
    }
}