<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/20/2019
 * Time: 11:54 AM
 */

namespace ItgSoftware\Itg\Controller\Home;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use  Magento\Framework\App\Filesystem\DirectoryList;


/**
 * Class AddingBrand controller for adding brand form
 * @package ITGSoftware\Itg\Controller\Home
 */
class AddingBrand extends  Action
{
    /**
     * @var \ItgSoftware\Brands\Model\BrandFactory
     */
    protected $_brandFactory;

    /**
     * @var \ItgSoftware\Brands\Model\ResourceModel\BrandFactory
     */
    protected $_brandResourceFactory;

    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * @var \Magento\Framework\Image\AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param  \ItgSoftware\Brands\Model\BrandFactory $brandFactory
     * @param \ItgSoftware\Brands\Model\ResourceModel\BrandFactory $brandResourceFactory
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     * @param \Magento\Framework\Image\AdapterFactory $adapterFactory
     * @param \Magento\Framework\Filesystem $filesystem
     */
    public function __construct(
        Context $context,
        \ItgSoftware\Brands\Model\BrandFactory $brandFactory,
        \ItgSoftware\Brands\Model\ResourceModel\BrandFactory $brandResourceFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem)
    {
        $this->_brandFactory = $brandFactory;
        $this->_brandResourceFactory = $brandResourceFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        return parent:: __construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function execute()
    {
        if($this->isValidForm()){
            $params = (array) $this->getRequest()->getParams();
                if($this->addBrand($params)){
                    $this->messageManager->addSuccessMessage(__('A brand has been added successfully !'));
                    $resultRedirect = $this->resultRedirectFactory->create();
                    $resultRedirect->setPath('itg/home/brands');
                    return  $resultRedirect;
                }
                else {
                    $this->messageManager->addErrorMessage(__('A brand with same email is already exists!'));
                }
        }
        if(!$this->_view->isLayoutLoaded()){
            $this->_view->loadLayout();
            $this->_view->renderLayout();
        }
    }

    /**
     * Validate add brand form
     *
     * @return bool
     */
    public function isValidForm()
    {
        $data = $this->getRequest()->getParams();
        if(empty($data))
            return false;
        foreach ($data as $param) {
            if (empty($param) || $param == " ")
                return false;
        }
        return true;
    }

    /**
     * Add new brand to DB
     *
     * @param $data
     * @return bool
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function addBrand($data)
    {
        $brand = $this->_brandFactory->create();
        $brandResource = $this->_brandResourceFactory->create();

        $brandResource->load($brand,$data['brandemail'],'email');
        if($brand->getId())
            return false;
        $imagePath = $this->addBrandImage();
        $brand->setData([
            'brand_name'=> $data['brandname'],
            'brand_site_url'=> $data['siteurl'],
            'description'=>$data['decription'],
            'email' => $data['brandemail'],
            'brand_img_url' =>$imagePath
        ]);
        $brandResource->save($brand);
        return true;
    }

    /**
     * Adding the image of the brand
     *
     * @return string  image relative path to pub/media/custom-image
     */
    public  function  addBrandImage(){
        try{
            $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();

            $uploader->addValidateCallback('custom_image_upload',
                $imageAdapter,'validateUploadFile');
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('custom_image');
            $result = $uploader->save($destinationPath);
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }
             return $result['file'];

        } catch (\Exception $e) {
        }
    }
}