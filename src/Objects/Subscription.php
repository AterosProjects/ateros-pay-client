<?php

namespace Ateros\Pay\Objects;

/**
 * @property  int amount
 * @property  string customer
 * @property  string currency
 * @property  string identifier
 * @property  string descriptor
 * @property  string processor
 * @property  string created_at
 * @property  string updated_at
 * @property  string redirect_url
 * @property  string status
 * @property  string period
 */

class Subscription extends AterosPayObject
{
    protected static $endpoint = '/subscriptions';
}
