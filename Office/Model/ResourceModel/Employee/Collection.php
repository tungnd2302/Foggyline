<?php 
namespace Foggyline\Office\Model\ResourceModel\Employee;

class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Foggyline\Office\Model\Employee','Foggyline\Office\Model\ResourceModel\Employee');
    }

    // protected function _initSelect()
    // {
    //     $this->getSelect()
    //         ->from(['main_table' => 'foggyline_office_employee_entity'])
    //         ->joinLeft('foggyline_office_department',
    //         'main_table.department_id = foggyline_office_department.entity_id',
    //         [
    //             'name'
    //         ]);          
    //     $this->addFilterToMap('entity_id', 'main_table.entity_id');
    //     // echo $this->getSelect()->__toString();
    //     // die;
    //     return $this;
    // }

}