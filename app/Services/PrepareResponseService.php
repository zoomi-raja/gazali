<?php
namespace App\Services;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\Handler as ExceptionHandler;
class PrepareResponseService extends JsonResponse
{
    public $exceptions;
    public $response;
    /**
     * PrepareResponseService constructor.
     * @param ExceptionHandler $exceptions
     */
    function __construct() {//ExceptionHandler $exceptions
//        $this->exceptions   = $exceptions;
        $this->response     = $this->setPayloadStructure();
    }
    /**
     * @return array
     */
    protected function setPayloadStructure(){
        return [
            'API' => [
                'VERSION'       => 1.1,
                'FORMAT'        => 'JSON',
                'LANG'          => 'EN',
                'URI'           => [
                    'SOURCE'    => $_SERVER['REQUEST_URI']
                ]
            ],
            'STATUS'    => [
            ],
            "OUTPUT" => [
            ]
        ];
    }
    /**
     * @param JsonResponse $responseData
     * @return JsonResponse
     */
    public function formatResponse(JsonResponse $responseData){
        $this->response['STATUS'] = [
            "CODE"          => $responseData->statusCode,
            "MESSAGE"       => $responseData->statusText
        ];
        $responseData->setStatusCode(200);
        $this->response['OUTPUT'] = $this->sanitizeData( $responseData );
        $responseData->setData($this->response);
        return $responseData;
    }
    /**
     * @param null $data
     * @return array
     */
    protected function sanitizeData($data = null){
        if(!$data)
            return [];
        if($data->original instanceof LengthAwarePaginator ||$data->original instanceof Paginator ){
            $paginatedData = $data->getData();
            $sanitized['DATA']       = $paginatedData->data;
            $sanitized['NAVIGATION'] = [ 'CURRENT_PAGE' => $paginatedData->current_page, 'TOTAL_PAGE' => round($paginatedData->total/$paginatedData->per_page) ];
        }else{
            $sanitized['DATA'] = $data->getData();
        }
        return $sanitized;
    }
}