<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Model_Service_Config
{
    public const API_KEY = 'koality/api/key';
    public const RUSHHOUR_BEGIN = 'koality/rush_hour/begin';
    public const RUSHHOUR_END = 'koality/rush_hour/end';
    public const RUSHHOUR_INCLUDES_WEEKENDS = 'koality/rush_hour/include_weekends';
    public const MIN_EXPECTED_ORDERS_PER_HOUR_NORMAL = 'koality/orders_per_hour/min_orders_per_normal_hour';
    public const MIN_EXPECTED_ORDERS_PER_RUSHHOUR = 'koality/orders_per_hour/min_orders_per_rush_hour';
    public const MAX_EXPECTED_OPEN_CARTS_PER_HOUR_NORMAL = 'koality/open_carts/max_open_carts_per_normal_hour';
    public const MAX_EXPECTED_OPEN_CARTS_PER_RUSH_HOUR = 'koality/open_carts/max_open_carts_per_rush_hour';
    public const MIN_EXPECTED_ACTIVE_PRODUCTS = 'koality/active_products/min_active_products';

    public function getApiKey(): string
    {
        return Mage::getStoreConfig(self::API_KEY)?: '';
    }

    public function getRushhourBegin(): string
    {
        return Mage::getStoreConfig(self::RUSHHOUR_BEGIN) ?: '';
    }

    public function getRushhourEnd(): string
    {
        return Mage::getStoreConfig(self::RUSHHOUR_END) ?: '';
    }

    public function getDoesRushhourIncludeWeekends(): bool
    {
        return Mage::getStoreConfigFlag(self::RUSHHOUR_INCLUDES_WEEKENDS);
    }

    public function getMinExpectedOrdersPerNormalHour(): int
    {
        return (int)Mage::getStoreConfig(self::MIN_EXPECTED_ORDERS_PER_HOUR_NORMAL);
    }

    public function getMinExpectedOrdersPerRushhour(): int
    {
        return (int)Mage::getStoreConfig(self::MIN_EXPECTED_ORDERS_PER_RUSHHOUR);
    }

    public function getMaxExpectedOpenCartsPerNormalHour(): int
    {
        return (int)Mage::getStoreConfig(self::MAX_EXPECTED_OPEN_CARTS_PER_HOUR_NORMAL);
    }

    public function getMaxExpectedOpenCartsPerRushHour(): int
    {
        return (int)Mage::getStoreConfig(self::MAX_EXPECTED_OPEN_CARTS_PER_RUSH_HOUR);
    }

    public function getMinExpectedActiveProducts(): int
    {
        return (int)Mage::getStoreConfig(self::MIN_EXPECTED_ACTIVE_PRODUCTS);
    }
}
