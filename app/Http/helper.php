<?php
if (! function_exists('customThrow')) {

    function customThrow($message = '', $code = 422)
    {
        throw (new \App\Exceptions\ApiCustomException())->withMessage(__($message))->withCode($code);
    }
}

if (! function_exists('customThrowIf')) {

    function customThrowIf($bolean, $message = '', $code = 422)
    {
        if($bolean) {
            customThrow($message, $code);
        }
    }
}
