<?php
namespace CommonBundle\Model\Mixin;

use LazyRecord\Schema\MixinSchemaDeclare;

class ImageSchema extends MixinSchemaDeclare
{
    public function schema()
    {
        $this->column( 'thumb' )
            ->varchar(200)
            ->label('縮圖')
            ->renderAs('ThumbImageFileInput');

        $this->column( 'image' )
            ->varchar(200)
            ->label('主圖')
            ->renderAs('ThumbImageFileInput');
    }
}

