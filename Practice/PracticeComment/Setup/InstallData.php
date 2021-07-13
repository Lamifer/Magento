<?php
namespace Practice\PracticeComment\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

/**
 * Install Data
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->addDeliveryCommentAttribute($setup);
    }

    /**
     * Add the address delivery_comment attribute
     *
     * @return void
     */
    protected function addDeliveryCommentAttribute(ModuleDataSetupInterface $setup)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        if (!$customerSetup->getAttributeId('customer_address', 'delivery_comment')) {
            $customerSetup->addAttribute('customer_address', 'delivery_comment', [
                'type' => 'varchar',
                'label' => 'Delivery Comment',
                'input' => 'hidden',
                'required' => false,
                'visible' => true,
                'system' => 0,
                'visible_on_front' => false,
                'sort_order' => 101,
                'position' => 101
            ]);
        }

        if (!$customerSetup->getAttributeId('customer_address', 'delivery_date')) {
            $customerSetup->addAttribute('customer_address', 'delivery_date', [
                'type' => 'varchar',
                'label' => 'Delivery Date',
                'input' => 'hidden',
                'required' => false,
                'visible' => true,
                'system' => 0,
                'visible_on_front' => false,
                'sort_order' => 102,
                'position' => 102
            ]);
        }
    }
}