<?php 
namespace Foggyline\Office\Controller\Test;

class Save extends \Foggyline\Office\Controller\Test
{
    protected $_pageFactory;
    protected $_employeeFactory;
    protected $_departmentFactory;
    protected $_employeeResourceModel;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
        \Foggyline\Office\Model\DepartmentFactory $departmentFactory,
        \Foggyline\Office\Model\ResourceModel\Employee $employeeResourceModel
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_departmentFactory = $departmentFactory;
        $this->_employeeFactory = $employeeFactory;
        $this->_employeeResourceModel = $employeeResourceModel;
          
        return parent::__construct($context);
    }

    public function execute()
    {   
        $employee = $this->_employeeFactory->create();
        $department = $this->_departmentFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        if(isset($data['form_key'])) {
            unset($data['form_key']);
        }

        if(isset($data['hideit'])) {
            unset($data['hideit']);
        }


        if(isset($data['entity_id'])) {
            $employee->load($data['entity_id']);
            $employee->setData($data);
        }else{
            $employee->addData($data);
        }

        
        $this->_employeeResourceModel->save($employee);

        return $resultRedirect->setPath('*/*/index');
    }
}