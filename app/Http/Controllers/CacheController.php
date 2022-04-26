<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clearAll() :JsonResponse
    {
        $this->clearCache();
        $this->clearViewCache();
        $this->clearConfigCache();
        $this->clearRouteCache();
        $this->optimize();
        return response()->json("clear all successfully");
    }

    public function clearCache() :JsonResponse
    {
        Artisan::call("cache:clear");
        return response()->json("cache clear successfully");
    }
    public function clearViewCache() :JsonResponse
    {
        Artisan::call("view:clear");
        return response()->json("view clear successfully");
    }
    public function clearConfigCache() :JsonResponse
    {
        Artisan::call("config:clear");
        return response()->json("config clear successfully");
    }
    public function clearRouteCache() :JsonResponse
    {
        Artisan::call("route:clear");
        return response()->json("route clear successfully");
    }
    public function optimize() :JsonResponse
    {
        Artisan::call("optimize");
        return response()->json("optimize successfully");
    }

    public function custom(Request $request) :bool
    {
        $command = $request->input("command");
        return Artisan::call($command);
    }
}
