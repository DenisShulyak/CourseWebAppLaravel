<?php

namespace App\Http\Controllers;

use App\Http\Resources\MasterClassResourceCollection;
use App\Models\Course;

class ApiController extends Controller
{
    public function list()
    {
        return new MasterClassResourceCollection(Course::all());
    }

    public function byId($id){
        return new MasterClassResourceCollection(Course::whereId($id));
    }
}
