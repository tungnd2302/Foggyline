<?php 
namespace Foggyline\Office\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;

class Form extends Template
{
     protected $_pageFactory;
     protected $_eavConfig;
     protected $_collection;

     public function __construct(
          Context $context,
          PageFactory $pageFactory,
          \Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection $collection,
          \Magento\Framework\App\ResourceConnection $resourceConnection
     )
     {
        $this->_pageFactory = $pageFactory;
        $this->_collection = $collection;
        $this->_resourceConnection = $resourceConnection;

        return parent::__construct($context);
     }
 
     public function execute()
     {
          return $this->_pageFactory->create();
     }

     public function getAttribute(){
          $entity = $this->getEntityTypeId();
        $coll  = $this->_collection->addFieldToSelect('*')->addFieldToFilter(\Magento\Eav\Model\Entity\Attribute\Set::KEY_ENTITY_TYPE_ID, $entity['entity_type_id']);
          $items = $coll->load()->getItems();
          foreach($items as $contact)
          { 
              $itemData = $contact->getData();
              $this->_loadedData[$contact->getId()] = $itemData;
          }

          return $this->_loadedData;
          // $option_id = 5431;
          
     }

     public function getOptions($attribute_code){
          $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
          $eavConfig     = $objectManager->get('\Magento\Eav\Model\Config');
          $attribute     = $eavConfig->getAttribute('foggyline_office_employee', $attribute_code);
          return $attribute->getSource()->getAllOptions();
     }

     public function getEntityTypeId() 
     {
         $resource = $this->_resourceConnection->getConnection();
         $tableName  = $this->_resourceConnection->getTableName('eav_entity_type');
         $sql = "select entity_type_id from eav_entity_type where entity_type_code = 'foggyline_office_employee' LIMIT 1";
         $result = $resource->fetchAll($sql);
 
         return $result[0];
     }
}