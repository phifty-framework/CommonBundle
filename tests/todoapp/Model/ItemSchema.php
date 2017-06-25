<?php

namespace TodoApp\Model;

use CommonBundle\Model\Mixin\MetaSchema;
use CommonBundle\Model\Mixin\OrderingSchema;
use Maghead\Schema\DeclareSchema;

class ItemSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('title')->varchar(30);
        $this->mixin(MetaSchema::class);
        $this->mixin(OrderingSchema::class);
    }
}

