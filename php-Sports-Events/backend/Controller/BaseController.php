<?php

namespace Palmo\Controller;

use Palmo\Database\Db;

abstract class BaseController
{
    protected Db $db;
    abstract public function handleRequest();
}
