<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/12/19
 * Time: 3:40 PM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;


use CMagento\Author\Model\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use CMagento\Author\Controller\Adminhtml\Index\Author as AuthorController;
use Magento\Framework\Registry;
use Magento\Framework\Controller\ResultFactory;

class Upload extends AuthorController
{
    protected $imageUploader;

    public function __construct(
        Action\Context $context,
        Registry $coreRegistry,
        ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        try{
            $result= $this->imageUploader->saveFileToTmpDir('image');
            $result['cookie'] = [
              'name' => $this->_getSession()->getName(),
              'value' => $this->_getSession()->getSessionId(),
              'lifetime' => $this->_getSession()->getCookieLifetime(),
              'path' => $this->_getSession()->getCookiePath(),
              'domain' => $this->_getSession()->getCookieDomain()
            ];

        }catch (\Exception $e){
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('CMagento_Author');
    }
}