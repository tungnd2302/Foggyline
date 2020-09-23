<?php 
namespace Foggyline\Office\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Template
{
    protected $_pageFactory;
    protected $_eavConfig;
    protected $_employeeFactory;
    protected $_collection;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection $collection
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_employeeFactory = $employeeFactory;
        $this->_collection = $collection;

        return parent::__construct($context);
    }
 
    public function execute()
    {   
        return $this->_pageFactory->create();
    }

    public function getEmployeeData()
    {
        $items = $this->_employeeFactory->create()->getCollection()->addAttributeToSelect('*')->getItems();
        $loadedData = [];

        foreach($items as $contact) { 
            $itemData = $contact->getData();
            $loadedData[$contact->getId()] = $itemData;
        }
        
        return $loadedData;
    }

    public function getAttribute()
    {
        $coll  = $this->_collection->addFieldToSelect('*')->addFieldToFilter(\Magento\Eav\Model\Entity\Attribute\Set::KEY_ENTITY_TYPE_ID, 9);
        $items = $coll->load()->getItems();

        foreach($items as $contact) { 
            $itemData = $contact->getData();
            $loadedData[$contact->getId()] = $itemData;
        }

        return $loadedData;
   }

}