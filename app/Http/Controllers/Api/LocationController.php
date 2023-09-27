<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\County;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Repo\ApiResponseTrait;

class LocationController extends Controller
{
    use ApiResponseTrait;
    //
    public function counties(): JsonResponse
    {
        return $this->success(County::all(),'counties');
    }
    public function county($id,Request $request): JsonResponse    
    {
        return $this->success(County::findOrFail($id),"county");
    }
}
