<?php
namespace CommonBundle;
use Phifty\Plugin\Plugin;

class CommonBundle extends Plugin
{
    public function assets() { return array(); }

    public function defaultConfig() { return array(); }

    public function init() 
    {
        /*
        $this->expandRoute( '/bs/product_resource', '\\Product\\ProductResourceCRUDHandler' );
        $this->expandRoute( '/bs/product_image' ,   '\\Product\\ProductImageCRUDHandler' );
        $this->expandRoute( '/bs/product_file' ,    '\\Product\\ProductFileCRUDHandler' );

        if ( $this->config('with_agency_products') ) {
            $this->expandRoute( '/bs/agency_product', '\\Product\\AgencyProductCRUD' );
        }
        if ( $this->config('with_types') ) {
            $this->expandRoute( '/bs/product_type', '\\Product\\ProductTypeCRUDHandler' );
        }

        $this->route( '/bs/product/spec_panel', 'SpecPanelController');
        $this->route( '/bs/product/api/delete_spec/{schemaId}' , 'SpecDataController:deleteSchemaAndData' );

        // save/add spec data (item)
        // $this->route( '/bs/product/api/save_spec_data', 'SpecDataController:saveSpecData');

        $this->addCRUDAction( 'Category' , array('Create','Update','Delete','BulkDelete') );
        $this->addCRUDAction( 'Product' , array('BulkDelete') );
        $this->addCRUDAction( 'ProductType' , array('Create','Update','Delete','BulkDelete') );
        $this->addCRUDAction( 'Feature' , array('Delete') );
        $this->addCRUDAction( 'FeatureRel' , array('Create','Update','Delete') );
        $this->addCRUDAction( 'Resource' , array('Create','Update','Delete') );
        */
    }

}
