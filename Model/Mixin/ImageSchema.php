<?php
namespace CommonBundle\Model\Mixin;

use LazyRecord\Schema\MixinDeclareSchema;

class ImageSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $this->column( 'thumb' )
            ->varchar(200)
            ->contentType('ImageFile')
            ->label('縮圖')
            ->renderAs('ThumbImageFileInput');

        $this->column( 'image' )
            ->varchar(200)
            ->contentType('ImageFile')
            ->label('主圖')
            ->renderAs('ThumbImageFileInput');
    }
}

