<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Model_Result
{
    public const KEY_NEWSLETTER_TOO_FEW = 'newsletter.too_few';
    public const KEY_ORDERS_TOO_FEW = 'orders.too_few';
    public const KEY_CARTS_OPEN_TOO_MANY = 'carts.open.too_many';
    public const KEY_PRODUCTS_ACTIVE = 'products.active';

    public const STATUS_PASS = 'pass';
    public const STATUS_FAIL = 'fail';

    public const LIMIT_TYPE_MIN = 'min';
    public const LIMIT_TYPE_MAX = 'max';

    public const TYPE_TIME_SERIES_NUMERIC = 'time_series_numeric';

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $key;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var float|int
     */
    private $observedValue;

    /**
     * @var int
     */
    private $observedValuePrecision;

    /**
     * @var string
     */
    private $observedValueUnit;

    /**
     * @var string
     */
    private $limitType;

    /**
     * @var string
     */
    private $type;

    private $attributes = [];

    public function __construct(string $status, string $key, string $message)
    {
        $this->status  = $status;
        $this->message = $message;
        $this->key     = $key;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getObservedValue()
    {
        return $this->observedValue;
    }

    public function setObservedValue($observedValue): void
    {
        $this->observedValue = $observedValue;
    }

    public function getObservedValueUnit(): string
    {
        return $this->observedValueUnit;
    }

    public function setObservedValueUnit(string $observedValueUnit): void
    {
        $this->observedValueUnit = $observedValueUnit;
    }

    public function addAttribute($key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getLimitType(): string
    {
        return $this->limitType;
    }

    public function setLimitType(string $limitType): void
    {
        $this->limitType = $limitType;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getObservedValuePrecision(): ?int
    {
        return $this->observedValuePrecision;
    }

    public function setObservedValuePrecision(int $observedValuePrecision): void
    {
        $this->observedValuePrecision = $observedValuePrecision;
    }
}
