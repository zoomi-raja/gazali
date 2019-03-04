<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/4/2019
 * Time: 2:47 PM
 */

namespace App\Http;
use Illuminate\Http\Request as BaseRequest;
use Illuminate\Support\Collection;

class Request extends  BaseRequest
{

    public $paging;
    public $filters;
    function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->paging   = new Collection();
        $this->filters  = new Collection();
        $this->paging->perPage      = 10;
        $this->paging->pageNumber   = 1;
        $this->setPagingParams();
        $this->setFilterParams();
    }

    /**
     * Description check for paging query param and set values for pagination fields
     */
    protected function setPagingParams( ){
        if(isset($_REQUEST['paging'])){
            $paging     = $_REQUEST['paging'];
            unset($_REQUEST['paging']);
            $pagingData = explode(',',$paging);
            array_walk($pagingData,function ($param){
                $pageQuery = explode(':',$param);
                if(in_array('pp',$pageQuery))
                    $this->paging->perPage = ( (int)$pageQuery[1] )??1;
                if(in_array('pn',$pageQuery))
                    $this->paging->pageNumber = ( (int)$pageQuery[1] )??1;
            });
        }
    }

    /**
     * just to make it simple to get params from query param will give flexibility to pass filter as required
     * set filters for current url
     */
    protected function setFilterParams(){
        if( isset($_REQUEST['q']) ){
            $filter     = $_REQUEST['q'];
            $filters    = [];
            unset($_REQUEST['q']);
            $filterData = explode(',',$filter);
            array_walk($filterData,function ($param) use (&$filters){
                if(strpos($param,':')!==false) {
                    list($field, $value) = explode(':', $param);
                    if ($field && $value) {
                        $filters[$field] = $value;
                    }
                }
            });
            if(!empty($filters));
                $this->filters->push($filters);
        }
    }
}