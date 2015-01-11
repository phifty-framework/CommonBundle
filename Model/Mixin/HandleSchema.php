<?php
namespace CommonBundle\Model\Mixin;

use LazyRecord\Schema\MixinSchemaDeclare;

class HandleSchema extends MixinSchemaDeclare
{
    public function schema()
    {
        $this->column('handle')
            ->varchar(32)
            ->label('程式用標記')
            ->unique()
            ->hint('程式操作用，勿修改')
            ;
    }
}

