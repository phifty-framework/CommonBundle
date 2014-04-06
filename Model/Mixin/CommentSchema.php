<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinSchemaDeclare;

class CommentSchema extends MixinSchemaDeclare
{
    public function schema()
    {
        $kernel = kernel();
        $this->column('comment')
            ->text()
            ->label( _('備註') )
            ->renderAs( 'TextareaInput', [ 'rows' => 3, 'cols' => 60 ])
            ;
    }
}
