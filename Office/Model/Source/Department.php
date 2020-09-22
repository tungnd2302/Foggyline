<?php

namespace Foggyline\Office\Model\Source;

class Department extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var array
     */
    protected $_departmentFactory;
    protected $_loadedData;

    /**
     * @param array $options
     * @codeCoverageIgnore
     */
    public function __construct(\Foggyline\Office\Model\DepartmentFactory $departmentFactory)
    {
        $this->_departmentFactory = $departmentFactory;
    }

    /**
     * Retrieve all options for the source from configuration
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return array
     */
    public function getAllOptions()
    {
        $department = $this->_departmentFactory->create();
        $departmentItems = $department->getCollection();
        $this->_loadedData = array();
        
        foreach($departmentItems as $item) {
			array_push($this->_loadedData,$item->getData());
		}

        return $this->_loadedData;
        // echo '<pre>';
        // print_r($this->_loadedData);
        // die;
    }
}
