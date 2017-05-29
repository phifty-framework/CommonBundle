<?php

namespace CommonBundle\Model\Mixin;

use Maghead\Schema\MixinDeclareSchema;

class OrderingSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $this->column('ordering')
            ->integer()
            ->default(0)
            ->renderAs('HiddenInput')
            ->label('排序編號');
    }
}

