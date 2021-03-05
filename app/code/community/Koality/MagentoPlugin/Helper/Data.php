<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function createRandomApiKey(): string
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', random_int(0, 65535), random_int(0, 65535),
            random_int(0, 65535), random_int(16384, 20479), random_int(32768, 49151), random_int(0, 65535),
            random_int(0, 65535), random_int(0, 65535));
    }
}
