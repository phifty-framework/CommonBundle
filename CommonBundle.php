<?php

namespace CommonBundle;

use Phifty\Bundle;

class CommonBundle extends Bundle
{
    public function assets() { return array(); }

    public function defaultConfig()
    {
        return [
            // By default we target meta data schema at mysql 5.5
            "Target" => "mysql5.5",
        ];
    }

    public function boot() 
    {

    }
}
