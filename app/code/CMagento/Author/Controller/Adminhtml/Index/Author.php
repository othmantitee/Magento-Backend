<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/10/19
 * Time: 10:53 AM
 */

namespace CMagento\Author\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\Registry;

/**
 * Class Author abstract Controller for author's controllers
 *
 * @package CMagento\Author\Controller\Adminhtml\Index
 */
abstract class Author extends Action
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    const ADMIN_RESOURCE = 'CMagento_Author::author';

    /**
     * Author constructor.
     * @param Action\Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Action\Context $context,
        Registry $coreRegistry)
    {
        $this->_coreRegistry =$coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('CMagento_Author::manager')
            ->addBreadcrumb(__( 'Author' ),__( 'Author' ))
            ->addBreadcrumb(__( 'Tutorial' ),__( 'Tutorial' ));
        return $resultPage ;
    }
}