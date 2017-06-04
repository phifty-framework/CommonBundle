<?php
namespace CommonBundle\Controller;
use Phifty\Routing\Controller;

/**
 * Default AutoCompleteController for jQuery
 */
class AutoCompleteController extends Controller
{
    public $collectionClass;

    public $termField = 'term';

    public $labelField;
    public $valueField;

    public $searchFields = array(
        /*
         'name' => 'contains',
         'code' => 'is',
        */
    );

    public $limit = 20;

    public function getCollection() {
        $class = $this->collectionClass;
        return new $class;
    }

    public function getTerm() {
        return $this->request->param( $this->termField );
    }

    public function applySearch() {
        $collection = $this->getCollection();

        if ($term = $this->getTerm() ) {
            $where = $collection->where();
            $qi = 0;
            foreach( $this->searchFields as $n => $type ) {
                if ( $qi > 0 ) {
                    $where = $where->or();
                }
                if ( $type == 'contains' ) {
                    $where->like($n, '%' . $term . '%');
                } else if ( $type == 'starts_with' ) {
                    $where->like($n, $term . '%');
                } else if ( $type == 'ends_with' ) {
                    $where->like($n, '%' . $term);
                } else if ( $type == 'is' ) {
                    $where->equal($n, $term);
                } else {
                    throw new Exception("unsupported query type $type");
                }
                $qi++;
            }
        }
        if ( $this->limit ) {
            $collection->limit($this->limit);
        }
        return $collection;
    }

    public function exportCollection($collection) 
    {
        $items = [];
        if ( $this->labelField && $this->valueField ) {
            foreach ( $collection as $item ) {
                $items[] = [
                    'label' => $item->get($this->labelField),
                    'value' => $item->get($this->valueField),
                ];
            }
        } else if ( $this->labelField ) {
            foreach ( $collection as $item ) {
                $items[] = $item->get($this->labelField);
            }
        } else if ( $this->valueField ) {
            foreach ( $collection as $item ) {
                $items[] = [
                    'label' => $item->dataLabel(),
                    'value' => $item->get($this->valueField),
                ];
            }
        } else {
            return;
        }
        return $items;
    }

    public function indexAction() {
        $collection = $this->applySearch();
        if ( $items = $this->exportCollection($collection) ) {
            return $this->toJson($items);
        }
        return $collection->toJson();
    }
}
