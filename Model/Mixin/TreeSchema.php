<?php

namespace CommonBundle\Model\Mixin;

use Maghead\Schema\MixinDeclareSchema;

// XXX: not working
class TreeSchema extends MixinDeclareSchema
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



