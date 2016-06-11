<?php

namespace NameFinder\Models;

class User implements \JsonSerializable
{
    /** @var  The properties of the model */
    protected $arr_properties;

    /** @var array the mass-assignable properties */
    protected static $arr_fillable = [
        'first_name',
        'full_name',
        'last_name'
    ];

    /**
     * User constructor.
     *
     * @param $arr_properties
     */
    public function __construct(array $arr_properties = [])
    {
        $this->arr_properties = array_intersect_key($arr_properties, array_flip(self::$arr_fillable));
    }

    /**
     * Returns the User's properties
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->arr_properties;
    }

    /**
     * Direct getter for the User's first name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return isset($this->arr_properties['first_name']) ? $this->arr_properties['first_name'] : '';
    }

    /**
     * Direct getter for the User's last name
     *
     * @return string
     */
    public function getLastName(): string
    {
        return isset($this->arr_properties['last_name']) ? $this->arr_properties['last_name'] : '';
    }

    /**
     * Direct getter for the User's full name
     *
     * @return string
     */
    public function getFullName(): string
    {
        return isset($this->arr_properties['full_name']) ? $this->arr_properties['full_name'] : '';
    }

    /**
     * Returns an array of its serializable values
     */
    public function jsonSerialize(): array
    {
        return $this->arr_properties;
    }
}
