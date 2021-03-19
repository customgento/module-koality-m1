<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Model_CheckCollector
{
    public function generateResponse(): string
    {
        $checkClasses = [
            'activeProductsCheck',
            'currentOrdersCheck',
            'openCartsCheck'
        ];
        $formatter    = Mage::getModel('koality_magentoplugin/formatter');
        foreach ($checkClasses as $checkClass) {
            $formatter->addResult(Mage::getModel('koality_magentoplugin/checks_' . $checkClass)->getResult());
        }

        return $formatter->getFormattedResults();
    }
}
