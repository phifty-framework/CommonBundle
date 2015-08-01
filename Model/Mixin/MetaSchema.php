<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinDeclareSchema;

class MetaSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $kernel = kernel();

        $this->column( 'created_on' )
            ->timestamp()
            ->null()
            ->isa('DateTime')
            ->renderAs('DateTimeInput')
            // ->default(array('current_timestamp'))
            ->label( _('建立時間') )
            ->default(function() {
                return date('c');
            })
            ;

        $this->column( 'updated_on' )
            ->timestamp()
            ->null()
            ->renderAs('DateTimeInput')
            ->isa('DateTime')
            ->default(function() {
                return date('c');
            })
            ->label( _('更新時間') )
            ;

        $this->column( 'created_by' )
            ->integer()
            ->refer( $kernel->currentUser->userModelClass )
            ->default(function() {
                if ( isset($_SESSION) ) {
                    return kernel()->currentUser->id;
                }
            })
            ->renderAs('SelectInput')
            ->label('建立者')
            ;

        // XXX: inject value to beforeUpdate
        $this->column( 'updated_by' )
            ->integer()
            ->refer( $kernel->currentUser->userModelClass )
            ->default(function() {
                if ( isset($_SESSION) ) {
                    return kernel()->currentUser->id;
                }
            })
            ->renderAs('SelectInput')
            ->label('更新者')
            ;

        // XXX: here override the default column value, we should be able to convert the object for formkit widgets.
        $this->belongsTo( 'created_by' , $kernel->currentUser->userModelClass . 'Schema' , 'id' , 'created_by' );
        $this->belongsTo( 'updated_by' , $kernel->currentUser->userModelClass . 'Schema' , 'id' , 'updated_by' );
    }
}
