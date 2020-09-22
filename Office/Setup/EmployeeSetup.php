<?php 
namespace Foggyline\Office\Setup;

use Magento\Eav\Setup\EavSetup;

class EmployeeSetup extends EavSetup
{
    public function getDefaultEntities()
    {
        $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
        $entities = [
            $employeeEntity => [
                'entity_model' => 'Foggyline\Office\Model\ResourceModel\Employee',
                'table' => $employeeEntity . '_entity',
                'attributes' => [
                    'department_id' => [
                        'type'   => 'static',
                        'label'  => 'Phòng ban',
                        'input'  => 'select',
                        'source' => 'Foggyline\Office\Model\Source\Department'
                    ],
                    'email' => [
                        'type' => 'static',
                        'label' => 'Email',
                        'input' => 'text'
                    ],
                    'first_name' => [
                        'type' => 'static',
                        'label' => 'Họ',
                        'input' => 'text'
                    ],
                    'last_name' => [
                        'type' => 'static',
                        'label' => 'Tên',
                        'input' => 'text'
                    ],
                ],
            ],
        ];
        return $entities;
    }
}
