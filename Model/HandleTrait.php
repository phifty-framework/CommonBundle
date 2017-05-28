<?php
namespace CommonBundle\Model;

trait HandleTrait
{
    static public function loadByHandle($handle, $lang = NULL)
    {
        return static::load($lang ? [ 'handle' => $handle, 'lang' => $lang ] : [ 'handle' => $handle ]);
    }
}

