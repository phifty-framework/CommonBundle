<?php

namespace CommonBundle\Model\Mixin;

use Maghead\Schema\MixinDeclareSchema;
use SQLBuilder\Raw;

class MetaSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $kernel = kernel();

        $this->column('created_on')
            ->timestamp()
            ->isa('DateTime')
            ->null()
            ->renderAs('DateTimeInput')
            ->label( _('建立時間') )
            ->default(function() {
                return new \DateTime;
            })
            ;

        $this->column('updated_on')
            ->timestamp()
            ->null()
            ->isa('DateTime')
            ->renderAs('DateTimeInput')
            ->default(new Raw('CURRENT_TIMESTAMP'))
            ->onUpdate(new Raw('CURRENT_TIMESTAMP'))
            ->label(_('更新時間'))
            ;

        $this->column('created_by')
            ->refer($kernel->currentUser->getModelClass())
            ->integer()
            ->unsigned()
            ->default(function() {
                if (isset($_SESSION)) {
                    return kernel()->currentUser->id;
                }
            })
            ->renderAs('SelectInput')
            ->label('建立者')
            ;

        // XXX: inject value to beforeUpdate
        $this->column('updated_by')
            ->refer($kernel->currentUser->getModelClass())
            ->integer()
            ->unsigned()
            ->default(function() {
                if ( isset($_SESSION) ) {
                    return kernel()->currentUser->id;
                }
            })
            ->renderAs('SelectInput')
            ->label('更新者')
            ;

        // XXX: here override the default column value, we should be able to convert the object for formkit widgets.
        $this->belongsTo('created_by' , $kernel->currentUser->getModelClass() . 'Schema')
            ->by('created_by')
            ->usingIndex(false)
            ;

        $this->belongsTo('updated_by' , $kernel->currentUser->getModelClass() . 'Schema')
            ->by('updated_by')
            ->usingIndex(false)
            ;
    }
}
