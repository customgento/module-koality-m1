<?php

/* @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$setup = $installer->getConnection();

$setup->insert(
    $this->getTable('core_config_data'),
    [
        'path'  => 'koality_service/koality_apikey/apikey',
        'value' => sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', random_int(0, 65535), random_int(0, 65535),
            random_int(0, 65535), random_int(16384, 20479), random_int(32768, 49151), random_int(0, 65535),
            random_int(0, 65535), random_int(0, 65535))
    ]
);

$installer->endSetup();
