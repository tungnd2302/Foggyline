<?php 
namespace Foggyline\Office\Controller\Test;

class Delete extends \Foggyline\Office\Controller\Test
{
    protected $_employeeFactory;
    protected $_request;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
        \Magento\Framework\App\Request\Http $request
    )
    {
        $this->_employeeFactory = $employeeFactory;
        $this->_request = $request;
          
        return parent::__construct($context);
    }

    public function execute()
    {   
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->_request->getParam('id');
        // echo $id;
        // die;
        $employee = $this->_employeeFactory->create();
        $employee->setId($id)->delete();

        return $resultRedirect->setPath('*/*/index');
    }
}