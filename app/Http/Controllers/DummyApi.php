<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyApi extends Controller
{
    //
    function getData()
    {
return ["name"=>"Demo","email"=>"demo@demo.com","phone"=>"0987654321"];
    }
}
