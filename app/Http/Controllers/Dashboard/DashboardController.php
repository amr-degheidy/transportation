<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        return $this->success([
        ],'success');
    }
}
