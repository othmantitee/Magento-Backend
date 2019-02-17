<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/3/19
 * Time: 3:16 PM
 */

namespace LogsHistory\Customer\Plugin;

use Magento\Customer\Model\Session;

/**
 * Class CreatePost
 * @package LogsHistory\Customer\Plugin
 */
class CreatePost
{

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        Session $customerSession,
        \Magento\Framework\UrlInterface $url
    )
    {
        $this->session = $customerSession;
        $this->url = $url;
    }

    /**
     *To be executed immediately after create new customer. Redirect the customer to login page.
     *
     * @param \Magento\Customer\Controller\Account\CreatePost $subject
     * @param $resultRedirect
     * @return mixed
     */
    public function afterExecute(
        \Magento\Customer\Controller\Account\CreatePost $subject,
        $resultRedirect)
    {
        $resultRedirect->setUrl($this->url->getUrl('customer/account/login'));
        return $resultRedirect;
    }
}