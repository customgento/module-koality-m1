<?php

declare(strict_types=1);
$installer = $this;
$setup     = $installer->getConnection();
$setup->insert(
    $this->getTable('core_config_data'),
    [
        'path'  => 'koality_service/koality_apikey/apikey',
        'value' => Mage::helper('koality_magentoplugin')->createRandomApiKey()
    ]
);
