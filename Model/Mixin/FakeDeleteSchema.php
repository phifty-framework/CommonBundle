<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinDeclareSchema;

class FakeDeleteSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $this->column('is_deleted')
            ->boolean()
            ->default(false)
            ->label('已刪除')
            ->renderAs('CheckboxInput')
            ;
    }
}
