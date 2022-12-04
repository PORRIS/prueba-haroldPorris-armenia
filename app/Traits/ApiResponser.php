<?php
namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 * Trait ApiResponser
 * @package App\Traits
 */
trait ApiResponser
{
    protected function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['message' => $message, 'code' => $code, "status" => false], 200);
    }

    protected function showData( $data, $code = 200, $message = '',$status = true)
    {
        return $this->successResponse(['data'=>$data,'code' => $code,"status" => $status,'message' => $message], 200);
    }
    protected function showDataEspecific( $data, $code = 200)
    {
        return $this->successResponse($data, $code);
    }


}
