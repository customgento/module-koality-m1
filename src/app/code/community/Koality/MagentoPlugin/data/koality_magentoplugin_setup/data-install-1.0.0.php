<?php

declare(strict_types=1);
$installer = $this;
$setup     = $installer->getConnection();
$setup->insert(
    $this->getTable('core_config_data'),
    [
        'path'  => Koality_MagentoPlugin_Model_Service_Config::API_KEY,
        'value' => Mage::helper('koality_magentoplugin')->createRandomApiKey()
    ]
);
