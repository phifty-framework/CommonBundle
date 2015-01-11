<?php
namespace CommonBundle\Model;

trait HandleTrait
{
    static public function loadByHandle($handle, $lang = NULL) 
    {
        $record = new static;
        $record->load($lang ? array( 'handle' => $handle, 'lang' => $lang ) : array( 'handle' => $handle ));
        return $record;
    }
}

