<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Model_Service_Config
{
    public const KOALITY_API_KEY = 'koality_service/koality_apikey/apikey';
    public const RUSHHOUR_BEGIN = 'koality_service/orders_per_hour/rush_hour_begin';
    public const RUSHHOUR_END = 'koality_service/orders_per_hour/rush_hour_end';
    public const MIN_EXPECTED_ORDERS_PER_RUSHHOUR = 'koality_service/orders_per_hour/min_orders_per_hour_rush_hour';
    public const RUSHHOUR_INCLUDES_WEEKENDS = 'koality_service/orders_per_hour/include_weekends';
    public const MIN_EXPECTED_ORDERS_PER_HOUR_NORMAL = 'koality_service/orders_per_hour/min_orders_per_normal_hour';
    public const MAX_EXPECTED_OPEN_CARTS = 'koality_service/open_carts/max_open_carts';
    public const MIN_EXPECTED_ACTIVE_PRODUCTS = 'koality_service/active_products/min_active_products';

    public function getApiKey(): string
    {
        return Mage::getStoreConfig(self::KOALITY_API_KEY);
    }

    public function getRushhourBegin(): string
    {
        return Mage::getStoreConfig(self::RUSHHOUR_BEGIN) ?: '';
    }

    public function getRushhourEnd(): string
    {
        return Mage::getStoreConfig(self::RUSHHOUR_END) ?: '';
    }

    public function getMinExpectedOrdersPerRushhour(): int
    {
        return (int)Mage::getStoreConfig(self::MIN_EXPECTED_ORDERS_PER_RUSHHOUR);
    }

    public function getDoesRushhourIncludeWeekends(): bool
    {
        return Mage::getStoreConfigFlag(self::RUSHHOUR_INCLUDES_WEEKENDS);
    }

    public function getMinExpectedOrdersPerNormalHour(): int
    {
        return (int)Mage::getStoreConfig(self::MIN_EXPECTED_ORDERS_PER_HOUR_NORMAL);
    }

    public function getMaxExpectedOpenCarts(): int
    {
        return (int)Mage::getStoreConfig(self::MAX_EXPECTED_OPEN_CARTS);
    }

    public function getMinExpectedActiveProducts(): int
    {
        return (int)Mage::getStoreConfig(self::MIN_EXPECTED_ACTIVE_PRODUCTS);
    }
}
