<?php

declare(strict_types=1);

use Koality_MagentoPlugin_Model_Result as Result;

class Koality_MagentoPlugin_Model_Checks_OpenCartsCheck
{
    public function getResult(): Result
    {
        $maxExpectedCartQty = Mage::getModel('koality_magentoplugin/service_config')->getMaxExpectedOpenCarts();
        $currentOpenCartQty = $this->getCurrentOpenCartQty();
        if ($currentOpenCartQty > $maxExpectedCartQty) {
            $openCartCheckResult = new Result(Result::STATUS_FAIL, Result::KEY_CARTS_OPEN_TOO_MANY,
                'There are too many open carts at the moment.');
        } else {
            $openCartCheckResult = new Result(Result::STATUS_PASS, Result::KEY_CARTS_OPEN_TOO_MANY,
                'There are not too many open carts at the moment.');
        }
        $openCartCheckResult->setLimit($maxExpectedCartQty);
        $openCartCheckResult->setObservedValue($currentOpenCartQty);
        $openCartCheckResult->setObservedValueUnit('carts');
        $openCartCheckResult->setObservedValuePrecision(0);
        $openCartCheckResult->setLimitType(Result::LIMIT_TYPE_MAX);
        $openCartCheckResult->setType(Result::TYPE_TIME_SERIES_NUMERIC);

        return $openCartCheckResult;
    }

    private function getCurrentOpenCartQty(): int
    {
        $fromTime = date('Y-m-d H:i:s', strtotime('-1 hour'));

        return Mage::getModel('sales/quote')->getCollection()->addFieldToFilter('is_active', ['eq' => 1])
            ->addFieldToFilter('created_at', ['from' => $fromTime])->getSize();
    }
}
