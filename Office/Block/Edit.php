<?php 
namespace Foggyline\Office\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Template
{
    protected $_pageFactory;
    protected $_eavConfig;
    protected $_collection;
    protected $_coreRegistry;
    protected $_employeeFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection $collection,
        \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_collection = $collection;
        $this->_coreRegistry = $coreRegistry;
        $this->_employeeFactory = $employeeFactory;
        
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

    public function getAttribute()
    {
        $coll  = $this->_collection->addFieldToSelect('*')->addFieldToFilter(\Magento\Eav\Model\Entity\Attribute\Set::KEY_ENTITY_TYPE_ID, 9);
        $items = $coll->load()->getItems();
        foreach($items as $contact)
        { 
            $itemData = $contact->getData();
            $this->_loadedData[$contact->getId()] = $itemData;
        }

        return $this->_loadedData;
        // $option_id = 5431;
        
    }

    public function getOptions($attribute_code)
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $eavConfig     = $objectManager->get('\Magento\Eav\Model\Config');
        $attribute     = $eavConfig->getAttribute('foggyline_office_employee', $attribute_code);
        return $attribute->getSource()->getAllOptions();
    }

    public function getEmployeeData()
    {
        $id = $this->_coreRegistry->registry('editRecordId');
        $items = $this->_employeeFactory->create()->load($id);
        foreach($items as $contact) { 
            $data = $contact;
        }
        
        return $data;
    }
}