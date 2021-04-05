<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SubscriptionManagementServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct(SubscriptionManagementServiceInterface $management_service) {
        $this->management_service = $management_service;
    }

    /**
     * show agregated service data.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function aggregation(Request $request) {
        $aggregation = $this->management_service->aggregation(Auth::user());

        return response()->json($aggregation);
    }

    /**
     * show registered services.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request) {
        $services = $this->management_service->list(Auth::user());

        return response()->json($services);
    }

    /**
     * add service.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        $this->management_service->add(
            Auth::user(),
            $request->input('name'),
            $request->input('price'),
            $request->input('category_id')
        );

        return response('OK', 200);
    }

    /**
     * remove service.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request) {
        $this->management_service->delete(
            (int) $request->input('id')
        );

        return response('OK', 200);
    }

    /**
     * update service.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $this->management_service->update(
            (int) $request->input('id'),
            $request->input('name'),
            $request->input('price'),
            $request->input('category_id')
        );

        return response('OK', 200);
    }
}
