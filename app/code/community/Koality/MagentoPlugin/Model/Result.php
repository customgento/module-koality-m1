<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Model_Result
{
    public const KEY_NEWSLETTER_TOO_FEW = 'newsletter.too_few';
    public const KEY_ORDERS_TOO_FEW = 'orders.too_few';
    public const KEY_CARTS_OPEN_TOO_MANY = 'carts.open.too_many';
    public const KEY_PRODUCTS_ACTIVE = 'products.active';
    public const KEY_PLUGINS_UPDATABLE = 'plugins.updatable';

    /** The allowed result statuses */
    public const STATUS_PASS = 'pass';
    public const STATUS_FAIL = 'fail';

    public const LIMIT_TYPE_MIN = 'min';
    public const LIMIT_TYPE_MAX = 'max';

    public const TYPE_TIME_SERIES_NUMERIC = 'time_series_numeric';
    public const TYPE_TIME_SERIES_PERCENT = 'time_series_percent';

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

    /**
     * Result constructor.
     *
     * @param string $status
     * @param string $key
     * @param string $message
     */
    public function __construct(string $status, string $key, string $message)
    {
        $this->status  = $status;
        $this->message = $message;
        $this->key     = $key;
    }

    /**
     * Return the results status. Can be fail or pass.
     *
     * Use the class constants for checking the status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Return the results message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Return the results unique key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the limit of the metric that was checked.
     *
     * This field is optional.
     *
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the limit of the metric that was checked.
     *
     * @param int $limit
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * Get the current value of the checked metric.
     *
     * This field is optional.
     *
     * @return mixed
     */
    public function getObservedValue()
    {
        return $this->observedValue;
    }

    /**
     * Set the current value if the metric that is checked.
     *
     * @param mixed $observedValue
     */
    public function setObservedValue($observedValue)
    {
        $this->observedValue = $observedValue;
    }

    /**
     * Return the unit of the observed value.
     *
     * @return string
     */
    public function getObservedValueUnit()
    {
        return $this->observedValueUnit;
    }

    /**
     * Set the unit of the observed value.
     *
     * @param string $observedValueUnit
     */
    public function setObservedValueUnit(string $observedValueUnit)
    {
        $this->observedValueUnit = $observedValueUnit;
    }

    /**
     * Add a new attribute to the result.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Return a list of attribute
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function getLimitType()
    {
        return $this->limitType;
    }

    /**
     * @param string $limitType
     */
    public function setLimitType(string $limitType)
    {
        $this->limitType = $limitType;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getObservedValuePrecision()
    {
        return $this->observedValuePrecision;
    }

    /**
     * @param int $observedValuePrecision
     */
    public function setObservedValuePrecision($observedValuePrecision)
    {
        $this->observedValuePrecision = $observedValuePrecision;
    }
}
