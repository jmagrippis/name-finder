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
     * Returns an array of its serializable values
     */
    public function jsonSerialize(): array
    {
        return $this->arr_properties;
    }


}
