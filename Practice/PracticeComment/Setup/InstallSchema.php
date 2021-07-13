<?php
namespace Practice\PracticeComment\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Add the new column
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $this->addDeliveryCommentColumn($setup);

        $installer->endSetup();
    }

    /**
     * Add the column named delivery_comment
     *
     * @param SchemaSetupInterface $setup
     *
     * @return void
     */
    private function addDeliveryCommentColumn(SchemaSetupInterface $setup)
    {
        $deliveryComment = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'default' => NULL,
            'nullable' => true,
            'comment' => 'Delivery Comment'
        ];

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),
            'delivery_comment',
            $deliveryComment
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('quote_address'),
            'delivery_comment',
            $deliveryComment
        );

        $deliveryDate = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            'default' => NULL,
            'nullable' => true,
            'comment' => 'Delivery Date'
        ];

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),
            'delivery_date',
            $deliveryDate
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('quote_address'),
            'delivery_date',
            $deliveryDate
        );

    }
}