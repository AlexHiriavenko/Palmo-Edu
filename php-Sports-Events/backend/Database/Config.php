<?php

namespace Palmo\Database;

class Config
{
    private array $config;

    public function __construct()
    {
        $this->config = parse_ini_file('../config/config.ini');
    }

    public function get(string $name): array
    {
        if (! empty($name) && isset($this->config[$name])) {
            return $this->config[$name];
        } elseif (empty($name)) {
            return $this->config;
        }

        return [];
    }
}
