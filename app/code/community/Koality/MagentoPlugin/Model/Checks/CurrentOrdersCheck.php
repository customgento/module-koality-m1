<?php

declare(strict_types=1);

use Koality_MagentoPlugin_Model_Result as Result;

class Koality_MagentoPlugin_Model_Checks_CurrentOrdersCheck
{

    public function getResult(): Result
    {
        $expectedOrderQty = $this->getExpectedOrderQty();
        $currentOrderQty  = $this->getLastHourOrderCount();
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

    private function getExpectedOrderQty(): int
    {
        $currentWeekDay = date('w');
        $isWeekend      = ($currentWeekDay === 0 || $currentWeekDay === 6);
        $configGetter   = Mage::getModel('koality_magentoplugin/service_config');
        $useRushHour    = $configGetter->getDoesRushhourIncludeWeekends() || !$isWeekend;
        if ($useRushHour && $configGetter->getRushhourBegin() && $configGetter->getRushhourEnd()) {
            $beginHour   = $configGetter->getRushhourBegin();
            $endHour     = $configGetter->getRushhourEnd();
            $currentTime = (int)date('Hi');
            if ($currentTime < $endHour && $currentTime > $beginHour) {
                return $configGetter->getMinExpectedOrdersPerRushhour();
            }
        }

        return $configGetter->getMinExpectedOrdersPerNormalHour();
    }

    private function getLastHourOrderCount(): int
    {
        $toTime   = date("Y-m-d H:i:s");
        $fromTime = date('Y-m-d H:i:s', strtotime('- 1 hour'));

        return Mage::getModel('sales/order')->getCollection()
            ->addFieldToFilter('created_at', ['from' => $fromTime, 'to' => $toTime])->getSize();
    }
}
