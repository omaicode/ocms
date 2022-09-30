<?php
namespace Omaicode\TableBuilder\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

trait RequestTrait
{
    protected function handleRequest(Request $request)
    {
        if($request->handle == 'table-builder') {
            throw new HttpResponseException(apiResponse(
                true,
                json_decode($this->getJsonTable(), true)
            ));
        }
    }
}