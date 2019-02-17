<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/13/19
 * Time: 11:10 AM
 */

namespace CMagento\Author\Model\ResourceModel;


use CMagento\Author\Model\ImageUploader;
use Magento\Framework\ObjectManagerInterface;

class ImageUploaderPool
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var array
     */
    protected $uploaders;

    /**
     * ImageUploaderPool constructor.
     * @param ObjectManagerInterface $objectManager
     * @param array $uploaders
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        array $uploaders = []
    )
    {
        $this->objectManager = $objectManager;
        $this->uploaders = $uploaders;
    }

    /**
     * @return array
     */
    public function getUploader($type)
    {
        if(!isset($this->uploaders[$type])){
            throw new \Exception("Uploader not found for type: ".$type);
        }
        if(!is_object($this->uploaders[$type])){
            $this->uploaders[$type] = $this->objectManager->create($this->uploaders[$type]);
        }
        $uploader = $this->uploaders[$type];
        if(!($uploader instanceof ImageUploader)){
            
        }

        return $this->uploaders;
    }
}