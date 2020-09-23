<?php 
namespace Foggyline\Office\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $departmentFactory;
    protected $employeeFactory;
    private $employeeSetupFactory;

    public function __construct(
        \Foggyline\Office\Model\DepartmentFactory $departmentFactory,
        \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
        \Foggyline\Office\Setup\EmployeeSetupFactory $employeeSetupFactory
    )
    {
        $this->departmentFactory = $departmentFactory;
        $this->employeeFactory = $employeeFactory;
        $this->employeeSetupFactory = $employeeSetupFactory;
    }

    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        if (version_compare($context->getVersion(), '1.1.0', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();
            $employeeSetup->addAttribute(
                $employeeEntity, 'certificate', ['type' => 'text']
            );
            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.1.2', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();
            $employeeSetup->addAttribute(
                $employeeEntity, 'Language', ['type' => 'text','label' => 'Ngôn ngữ']
            );
            $setup->endSetup();
        }


        if (version_compare($context->getVersion(), '1.1.6', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();
            $employeeSetup->removeAttribute($employeeEntity, 'service_years');
            $employeeSetup->addAttribute(
                $employeeEntity, 'service_years', ['type' => 'int','label' => 'Kinh nghiệm làm việc']
            );
            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.1.8', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();

            $employeeSetup->removeAttribute($employeeEntity, 'dob');
            $employeeSetup->addAttribute(
                $employeeEntity, 'dob', ['type' => 'datetime','label' => 'Ngày sinh']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'salary');
            $employeeSetup->addAttribute(
                $employeeEntity, 'salary', ['type' => 'decimal','label' => 'Lương']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'vat_number');
            $employeeSetup->addAttribute(
                $employeeEntity, 'vat_number', ['type' => 'varchar','label' => 'Số  VAT']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'note');
            $employeeSetup->addAttribute(
                $employeeEntity, 'note', ['type' => 'text','label' => 'Ghi chú']
            );
            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.1.9', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();

            $employeeSetup->removeAttribute($employeeEntity, 'department_id');
            $employeeSetup->addAttribute(
                $employeeEntity, 'department_id', ['type' => 'text','label' => 'Phòng ban']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'email');
            $employeeSetup->addAttribute(
                $employeeEntity, 'email', ['type' => 'text','label' => 'Email']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'first_name');
            $employeeSetup->addAttribute(
                $employeeEntity, 'first_name', ['type' => 'varchar','label' => 'Tên']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'last_name');
            $employeeSetup->addAttribute(
                $employeeEntity, 'last_name', ['type' => 'varchar','label' => 'Họ']
            );
            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.2.1', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();

            $employeeSetup->removeAttribute($employeeEntity, 'department_id');
            $employeeSetup->addAttribute(
                $employeeEntity, 'department_id', [
                    'type' => 'int',
                    'input' => 'select',
                    'label' => 'Phòng ban',
                    'source' => 'Foggyline\Office\Model\Source\Department',
                ]
            );
        }

        if (version_compare($context->getVersion(), '1.2.3', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();

            $employeeSetup->removeAttribute($employeeEntity, 'vat_number');
            $employeeSetup->removeAttribute($employeeEntity, 'note');
            $employeeSetup->removeAttribute($employeeEntity, 'salary');
            $employeeSetup->removeAttribute($employeeEntity, 'dob');
            $employeeSetup->removeAttribute($employeeEntity, 'service_years');
        }

        if (version_compare($context->getVersion(), '1.2.4', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();

            $employeeSetup->removeAttribute($employeeEntity, 'department_id');
            $employeeSetup->addAttribute(
                $employeeEntity, 'department_id', [
                    'type' => 'int',
                    'input' => 'select',
                    'label' => 'Phòng ban',
                    'source' => 'Foggyline\Office\Model\Source\Department',
                ]
            );

            $employeeSetup->removeAttribute($employeeEntity, 'email');
            $employeeSetup->addAttribute(
                $employeeEntity, 'email', ['type' => 'text','label' => 'Email']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'first_name');
            $employeeSetup->addAttribute(
                $employeeEntity, 'first_name', ['type' => 'varchar','label' => 'Tên']
            );

            $employeeSetup->removeAttribute($employeeEntity, 'last_name');
            $employeeSetup->addAttribute(
                $employeeEntity, 'last_name', ['type' => 'varchar','label' => 'Họ']
            );
            $setup->endSetup();
        }


        if (version_compare($context->getVersion(), '1.2.9', '<=')) {
            $setup->startSetup();
            $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
            $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
            $employeeSetup->installEntities();

            $employeeSetup->removeAttribute($employeeEntity, 'Language');
            $employeeSetup->addAttribute(
                $employeeEntity, 'language', [
                    'type' => 'text',
                    'label' => 'Ngôn ngữ',
                    'input' => 'text'
                ]
            );
            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.3.1', '<=')) {
            $setup->startSetup();
            $data = [
                ['name' => 'Kinh doanh'],
                ['name' => 'Công nghệ'],
                ['name' => 'Dịch vụ'],
                ['name' => 'CSKH'],
            ];
            foreach ($data as $bind) {
                $setup->getConnection()
                  ->insertForce($setup->getTable('foggyline_office_department'), $bind);
            }
            $setup->endSetup();
        }



    }
}