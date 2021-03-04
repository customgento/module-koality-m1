<?php

declare(strict_types=1);

use Koality_MagentoPlugin_Model_Result as Result;

class Koality_MagentoPlugin_Model_Checks_ActiveProductsCheck
{
    public function getResult(): Result
    {
        $expectedActiveProductsQty = Mage::getModel('koality_magentoplugin/service_config')->getMinExpectedActiveProducts()
            ?? 0;
        $activeProductsQty         = $this->getActiveProductsQty();

        if ($activeProductsQty < $expectedActiveProductsQty) {
            $activeProductsCheckResult = new Result(Result::STATUS_FAIL, Result::KEY_PRODUCTS_ACTIVE,
                'There are too few active products in your shop.');
        } else {
            $activeProductsCheckResult = new Result(Result::STATUS_PASS, Result::KEY_PRODUCTS_ACTIVE,
                'There are enough active products in your shop.');
        }
        $activeProductsCheckResult->setLimit($expectedActiveProductsQty);
        $activeProductsCheckResult->setObservedValue($activeProductsQty);
        $activeProductsCheckResult->setObservedValueUnit('products');
        $activeProductsCheckResult->setObservedValuePrecision(0);
        $activeProductsCheckResult->setLimitType(Result::LIMIT_TYPE_MIN);
        $activeProductsCheckResult->setType(Result::TYPE_TIME_SERIES_NUMERIC);

        return $activeProductsCheckResult;
    }

    private function getActiveProductsQty(): int
    {
        return Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter('status',
            ['in' => Mage::getSingleton('catalog/product_status')->getSaleableStatusIds()])->getSize();
    }
}
