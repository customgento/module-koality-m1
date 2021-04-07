<?php

declare(strict_types=1);

use Koality_MagentoPlugin_Model_Result as Result;

class Koality_MagentoPlugin_Model_Checks_CurrentOrdersCheck
{
    public function getResult(): Result
    {
        $configGetter = Mage::getModel('koality_magentoplugin/service_config');
        $isRushHour   = Mage::getModel('koality_magentoplugin/rushHourHandler')->isRushHour();
        if ($isRushHour) {
            $expectedOrderQty = $configGetter->getMinExpectedOrdersPerRushhour();
        } else {
            $expectedOrderQty = $configGetter->getMinExpectedOrdersPerNormalHour();
        }
        $currentOrderQty = $this->getLastHourOrderCount();
        if ($currentOrderQty < $expectedOrderQty) {
            $currentOrdersCheckResult = new Result(Result::STATUS_FAIL, Result::KEY_ORDERS_TOO_FEW,
                'There were too few orders within the last hour.');
        } else {
            $currentOrdersCheckResult = new Result(Result::STATUS_PASS, Result::KEY_ORDERS_TOO_FEW,
                'There were enough orders within the last hour.');
        }
        $currentOrdersCheckResult->setLimit($expectedOrderQty);
        $currentOrdersCheckResult->setObservedValue($currentOrderQty);
        $currentOrdersCheckResult->setObservedValuePrecision(2);
        $currentOrdersCheckResult->setObservedValueUnit('orders');
        $currentOrdersCheckResult->setLimitType(Result::LIMIT_TYPE_MIN);
        $currentOrdersCheckResult->setType(Result::TYPE_TIME_SERIES_NUMERIC);

        return $currentOrdersCheckResult;
    }

    private function getLastHourOrderCount(): int
    {
        $fromTime = date('Y-m-d H:i:s', strtotime('- 1 hour'));

        return Mage::getModel('sales/order')->getCollection()->addFieldToFilter('created_at', ['from' => $fromTime])
            ->getSize();
    }
}
