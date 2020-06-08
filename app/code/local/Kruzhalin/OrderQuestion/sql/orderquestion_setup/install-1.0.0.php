<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();
$table      = $installer->getTable('orderquestion/question');

$newTable = $connection
    ->newTable($table)
    ->addColumn(
        'question_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        array(
            'identity' => true,
            'nullable' => false,
            'primary'  => true,
        ), 'Question ID'
    )
    ->addColumn(
        'order_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        array(
            'nullable' => false,
        ), 'Order ID'
    )
    ->addColumn(
        'question',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        null,
        array(
            'nullable' => true
        ), 'Question'
    )
    ->addColumn(
        'store_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        array(
            'nullable' => false,
        ), 'Store ID'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Creation Time'
    )
    ->addColumn(
        'sent_to_manager',
        Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        1,
        array(
            'default' => 0,
        ), 'Sent to Manager Flag'
    )
    ->addForeignKey(
        $connection->getForeignKeyName(
            $table,
            'store_id',
            $installer->getTable('core/store'),
            'store_id'
        ),
        'store_id',
        $installer->getTable('core/store'),
        'store_id'
    )
    ->addForeignKey(
        $connection->getForeignKeyName(
            $table,
            'order_id',
            $installer->getTable('sales/order'),
            'entity_id'
        ),
        'order_id',
        $installer->getTable('sales/order'),
        'entity_id',
        Varien_Db_Adapter_Interface::FK_ACTION_CASCADE,
        Varien_Db_Adapter_Interface::FK_ACTION_CASCADE
    );

$connection->createTable($newTable);

$installer->endSetup();
