<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/6/19
 * Time: 8:52 AM
 */

namespace LogsHistory\Logs\Ui\Component\Listing\Columns;


use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class CustomerAction extends  Column
{
    private $urlBuilder;

    const CUSTOMER_URL_PATH_EDIT ='customer/index/edit';

    protected $customerRepository;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        UrlInterface $urlBuilder,
        CustomerRepository $customerRepository)
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->customerRepository = $customerRepository;
    }

    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){
            foreach ($dataSource['data']['items'] as &$item){
                $name = $this->getData('name');
                if(isset($item['customer_fk_id'])){
                    $customer= $this->customerRepository->getById($item['customer_fk_id']);
                    $customerName = $customer->getLastname().", ".$customer->getFirstname();
                    $customerUrl =$this->urlBuilder->getUrl(self::CUSTOMER_URL_PATH_EDIT,['id'=>$item['customer_fk_id']]);
                    $item[$name] = html_entity_decode('<a href="'.$customerUrl.'">'.$customerName.'</a>');
                }
            }
        }
        return $dataSource;
    }
}