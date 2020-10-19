<?php


namespace App\Controllers;

use App\Controllers\BaseController;

class ErrorController extends BaseController
{
    public function notFound()
    {
        echo 'Page/Route Not Found';
    }
}
