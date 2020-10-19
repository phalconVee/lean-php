<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use http\Exception\InvalidArgumentException;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
//use App\Traits\ConnectionTrait;

class ExampleController extends BaseController
{
    //use \ConnectionTrait;

    public function show()
    {
        try {

            $resp = [
                'status' => true,
                'message' => 'Id ey here o'
            ];
            json_output($resp, Status::HTTP_OK);

        } catch (\Exception $e) {
            throw new InvalidArgumentException('Error!');
        }
    }
}
