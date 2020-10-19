<?php

namespace App\Controllers;

use GuzzleHttp\Exception\BadResponseException;

class BaseController
{
    public $per_page = 6;

    protected function respondWithError($e)
    {
        if ($e instanceof BadResponseException)
            $res = json_decode($e->getResponse()->getBody()->getContents(), true);

        if (empty($res)) $res = (string)$e->getResponse()->getBody();

        json_output($res, $e->getCode());
    }

    protected function respondWithSuccess($message, $data, $status = 200)
    {
        $res = [
            'status' => true,
            'message' => $message,
        ];

        isset($data) ? $res['data'] = $data : null;
        try {
            json_output($res, $status);
        } catch (\Exception $e) {
        }
    }
}
