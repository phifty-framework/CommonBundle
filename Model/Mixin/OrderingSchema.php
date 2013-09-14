<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinSchemaDeclare;

class OrderingSchema extends MixinSchemaDeclare
{
    public function schema()
    {
        $this->column('ordering')
            ->integer()
            ->default(0)
            ->label('排序編號');
    }
}

