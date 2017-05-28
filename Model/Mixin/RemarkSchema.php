<?php

namespace CommonBundle\Model\Mixin;

use Maghead\Schema\MixinDeclareSchema;

class RemarkSchema extends MixinDeclareSchema
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
