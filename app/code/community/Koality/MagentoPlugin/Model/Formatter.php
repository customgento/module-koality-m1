<?php

declare(strict_types=1);

use Koality_MagentoPlugin_Model_Result as Result;

class Koality_MagentoPlugin_Model_Formatter
{
    private $results = [];

    public function addResult(Result $result): void
    {
        $this->results[] = $result;
    }

    public function getFormattedResults(): string
    {
        $formattedResult = [];
        $checks          = [];
        $status          = Result::STATUS_PASS;
        foreach ($this->results as $result) {
            $check = [
                'status' => $result->getStatus(),
                'output' => $result->getMessage()
            ];
            if (is_numeric($result->getLimit())) {
                $check['limit'] = $result->getLimit();
            }
            if (!is_null($result->getLimitType())) {
                $check['limitType'] = $result->getLimitType();
            }
            if (!is_null($result->getObservedValue())) {
                $check['observedValue'] = $result->getObservedValue();
            }
            if (!is_null($result->getObservedValueUnit())) {
                $check['observedUnit'] = $result->getObservedValueUnit();
            }
            if (!is_null($result->getObservedValuePrecision())) {
                $check['observedValuePrecision'] = $result->getObservedValuePrecision();
            }
            if (!is_null($result->getType())) {
                $check['metricType'] = $result->getType();
            }
            $attributes = $result->getAttributes();
            if (count($attributes) > 0) {
                $check['attributes'] = $attributes;
            }
            $checks[$result->getKey()] = $check;
            if ($result->getStatus() === Result::STATUS_FAIL) {
                $status = Result::STATUS_FAIL;
            }
        }
        $formattedResult['status'] = $status;
        $formattedResult['output'] = $this->getOutput($status);
        $formattedResult['checks'] = $checks;
        $formattedResult['info']   = $this->getInfoBlock();

        return Mage::helper('core')->jsonEncode($formattedResult);
    }

    private function getOutput(string $status): string
    {
        if ($status === Result::STATUS_PASS) {
            return 'All Magento health metrics passed.';
        }

        return 'Some Magento health metrics failed: ';
    }

    private function getInfoBlock(): array
    {
        return [
            'creator'    => 'oality.io Magento 1 / OpenMage Plugin',
            'version'    => Mage::getConfig()->getModuleConfig('Koality_MagentoPlugin')->asArray()['version'],
            'plugin_url' => 'https://www.koality.io/plugins/magento'
        ];
    }
}
