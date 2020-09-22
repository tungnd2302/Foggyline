<?php 
namespace Foggyline\Office\Controller\Test;

class Form extends \Foggyline\Office\Controller\Test
{
    protected $_pageFactory;
    protected $_departmentFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
        // \Foggyline\Office\Model\DepartmentFactory $departmentFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        // $this->_departmentFactory = $departmentFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}