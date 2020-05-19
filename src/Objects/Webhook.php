<?php

namespace Ateros\Pay\Objects;

/**
 * @property  string type
 * @property  AterosPayObject object
 */

class Webhook extends AterosPayObject
{
    protected static $endpoint = '/webhooks';
}
