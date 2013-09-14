<?php
namespace CommonBundle\Model\Mixin;
use LazyRecord\Schema\MixinDeclareSchema;

class FileSchema extends MixinDeclareSchema
{
    public function schema()
    {
        $this->column( 'title' )
            ->varchar(130)
            ->label('檔案標題')
            ;

        $this->column( 'mimetype' )
            ->varchar(16)
            ->label('檔案格式')
            ;

        $this->column( 'file' )
            ->varchar(130)
            ->required()
            ->label('檔案')
            ;
    }
}
