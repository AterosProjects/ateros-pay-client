<?php

namespace Ateros\Pay\Objects;

use Ateros\Pay\Http\Client;

/**
 * @property  string id
 **/
class AterosPayObject
{
    protected static $endpoint = '/';

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function all()
    {
        return array_map(function ($object) {
            return new static($object);
        }, self::client()->get(static::$endpoint)['data']);
    }

    public static function get($id)
    {
        return self::make(self::client()->get(static::$endpoint . '/' . $id));
    }

    public static function create(array $data = [])
    {
        return self::make(self::client()->post(static::$endpoint, $data));
    }

    public static function make(array $data = [])
    {
        return new static($data);
    }

    protected static function client(): Client
    {
        return (new Client())->setApiKey($_ENV['ATEROS_PAY_KEY']);
    }
}
