<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/10/19
 * Time: 1:45 PM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;

use CMagento\Author\Controller\Adminhtml\Index\Author as AuthorController;
use CMagento\Author\Model\ImageUploaderPool;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Class Save
 * @package CMagento\Author\Controller\Adminhtml\Index
 */
class Save extends AuthorController
{
    /**
     * @var \CMagento\Author\Model\AuthorFactory
     */
    protected $_authorFactory;

    /**
     * @var \CMagento\Author\Model\ResourceModel\AuthorFactory
     */
    protected $_authorResourceFactory;

    /**
     * @var TypeListInterface
     */
    protected $_cacheTypeList;

    /**
     * @var FrontendPool
     */
    protected $_cacheFrontendPool;

    /**
     * @var DateTime
     */
    protected $_dateTime;

    protected $imageUploaderPool;

    /**
     * Save constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param \CMagento\Author\Model\AuthorFactory $authorFactory
     * @param \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory
     * @param TypeListInterface $cacheTypeList
     * @param FrontendPool $cacheFrontendPool
     * @param ImageUploaderPool $imageUploaderPool
     * @param DateTime $dateTime
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        \CMagento\Author\Model\AuthorFactory $authorFactory,
        \CMagento\Author\Model\ResourceModel\AuthorFactory $authorResourceFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool,
        ImageUploaderPool $imageUploaderPool,
        DateTime $dateTime)
    {
        $this->_authorFactory = $authorFactory;
        $this->_authorResourceFactory =$authorResourceFactory;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->imageUploaderPool =$imageUploaderPool;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_dateTime = $dateTime;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Exception
     */
    public function execute()
    {
        $resultRedirect  = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if($data['first_name']){
            $id= $this->getRequest()->getParam('author_id');
            $model = $this->_authorFactory->create();
            $modelResource = $this->_authorResourceFactory->create();
            $edit = false;
            if($id){
                $modelResource->load($model,$id,'author_id');
                $edit= true;

            }else{
                $modelResource->load($model,$data['email'],'email');
                if($model->getAuthorId()){
                    $this->messageManager->addErrorMessage('An author with same email is already exists.');
//                    return $resultRedirect->setPath('*/*/edit');
                    return $this->_forward('edit',null,null,['previousData'=>$data]);
                }
            }
            $uploader = $this->imageUploaderPool->getUploader('image');
            $image = $uploader->uploadFileAndGetName('image',$data);

            $authorData = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'image' => $image
            );
            $model->addData($authorData);

            try{
               $modelResource->save($model);

               $edit ? $this->messageManager->addSuccessMessage(__('Successfully edited the author.')):
                   $this->messageManager->addSuccessMessage(__('Successfully saved new author.'));
               $this->_cacheTypeList->cleanType('config');
               foreach ($this->_cacheFrontendPool as $cacheFrontend){
                   $cacheFrontend->getBackend()->clean();
               }

               if($this->getRequest()->getParam('back')){
                   return $resultRedirect->setPath('*/*/edit',['author_id'=> $model->getId()]);
               }
               return $resultRedirect->setPath('*/*/');

            }catch (\Exception $exception){
                $this->messageManager->addExceptionMessage( $exception,__('Something went wrong while saving author.'));
            }
            return $resultRedirect->setPath('*/*/edit',['author_id'=>$this->getRequest()->getParam('author_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}