<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinDeclareSchema;

class OrderingSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $this->column('ordering')
            ->integer()
            ->default(0)
            ->label('排序編號');
    }
}

