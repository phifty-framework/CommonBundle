<?php

namespace CommonBundle\Model\Mixin;

use CommonBundle\CommonBundle;
use Maghead\Schema\MixinDeclareSchema;
use Magsql\Raw;

class MetaSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $bundle = CommonBundle::getInstance();

        $this->column('updated_on')
            ->timestamp()
            ->notNull()
            ->isa('DateTime')
            ->default(new Raw('CURRENT_TIMESTAMP'))
            ->onUpdate(new Raw('CURRENT_TIMESTAMP'))
            ->label(_('更新時間'))
            ->renderAs('DateTimeInput')
            ;

        $targetVersion = strtolower($bundle->config('Target'));

        if (preg_match('/^mysql/', $targetVersion)) {
            if (version_compare($targetVersion, "mysql5.5") <= 0) {

                // For mysql 5.5
                $this->column('created_on')
                    ->timestamp()
                    ->null()
                    ->default(function() { return new \DateTime; })
                    ->label( _('建立時間') )
                    ->renderAs('DateTimeInput')
                    ;

            } else {

                // for mysql > 5.6 and newer
                $this->column('created_on')
                    ->timestamp()
                    ->null()
                    ->default(new Raw('CURRENT_TIMESTAMP'))
                    ->label( _('建立時間') )
                    ->renderAs('DateTimeInput')
                    ;

            }

        } else {

            // For postgresql or sqlite
            $this->column('created_on')
                ->timestamp()
                ->null()
                ->default(new Raw('CURRENT_TIMESTAMP'))
                ->label( _('建立時間') )
                ->renderAs('DateTimeInput')
                ;

        }



        // XXX: inject value to beforeUpdate
        $kernel = kernel();
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
