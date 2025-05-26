<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Services\Interfaces\LocationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Arr;

class LocationController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:admin', except: ['index', 'show']),
        ];
    }

    /**
     * Service to handle location-related logic 
     * and separating it from the controller
     * 
     * @var LocationServiceInterface
     */
    protected $locationService;

    /**
     * LocationController constructor
     *
     * @param LocationServiceInterface $locationService
     */
    public function __construct(LocationServiceInterface $locationService)
    {
        // Inject the LocationService to handle location-related logic
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = $this->locationService->getAll();
        return $this->successResponse('success', LocationResource::collection($locations));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        $data = $request->validated();
        $location = $this->locationService->store($data);
        return $this->successResponse('success', new LocationResource($location));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = $this->locationService->get($id);
        return $this->successResponse('success', new LocationResource($location));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, string $id)
    {
        $data = $request->validated();
        $location = $this->locationService->update($data, $id);
        return $this->successResponse('success', new LocationResource($location));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->locationService->destroy($id);
        return $this->successResponse('success');
    }
}
