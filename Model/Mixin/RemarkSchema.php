<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinSchemaDeclare;

class RemarkSchema extends MixinSchemaDeclare
{
    public function schema()
    {
        $kernel = kernel();
        $this->column('remark')
            ->text()
            ->label( _('備註') )
            ->renderAs( 'TextareaInput', [ 'rows' => 3, 'cols' => 60 ])
            ;
    }
}
