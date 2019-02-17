<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/3/19
 * Time: 10:20 AM
 */

namespace LogsHistory\Customer\Model;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Reporting;

/**
 * Class DataProvider
 * @package LogsHistory\Customer\Model
 */
class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @param \Magento\Customer\Model\Session $customerSession
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Reporting $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        $name,
        $primaryFieldName,
        $requestFieldName,
        Reporting $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        array $meta = [],
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
    }

    /**
     * To choose only one customer depends on customer_fk_id
     *  for LogsHistory/Customer/view/frontend/ui_component/logshistory_logs_logentry_listing.xml layout dataProvider
     */
    protected function prepareUpdateUrl()
    {
        $this->data['config']['filter_url_params']['customer_fk_id'] = $this->customerSession->getCustomer()->getId();
        parent::prepareUpdateUrl();
    }
}