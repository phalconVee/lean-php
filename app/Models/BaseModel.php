<?php

namespace App\Models;

class BaseModel
{
    use \ConnectionTrait;

    protected $db;

    public function __construct()
    {
        $this->db = $this->do_connect();
    }
}
