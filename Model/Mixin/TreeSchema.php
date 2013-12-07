<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinSchemaDeclare;

// XXX: not working
class TreeSchema extends MixinSchemaDeclare
{
    public function schema()
    {
        $this->column( 'parent_id' )
            ->integer()
            ->refer( 'self' )
            ->label( _('Parent') )
            ->integer()
            ->default(0)
            ->renderAs('SelectInput',array(
                'allow_empty' => 0,
            ));
        $this->belongsTo('parent','self','id','parent_id');
    }
}



