<?php

declare(strict_types=1);

/* @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$setup = $installer->getConnection();
$setup->insert(
    $this->getTable('core_config_data'),
    [
        'path'  => 'koality_service/koality_apikey/apikey',
        'value' => Mage::helper('koality_magentoplugin')->createRandomApiKey()
    ]
);
$installer->endSetup();
