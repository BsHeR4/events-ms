<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventTypeRequest;
use App\Http\Resources\EventTypeResource;
use App\Services\Interfaces\EventTypeServiceInterface;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{

    /**
     * Service to handle eventType-related logic 
     * and separating it from the controller
     * 
     * @var EventTypeServiceInterface
     */
    protected $eventTypeService;

    /**
     * LocationController constructor
     *
     * @param EventTypeServiceInterface $eventTypeService
     */
    public function __construct(EventTypeServiceInterface $eventTypeService)
    {
        // Inject the eventTypeService to handle location-related logic
        $this->eventTypeService = $eventTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventTypes = $this->eventTypeService->getAll();
        return $this->successResponse('success', EventTypeResource::collection($eventTypes));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventTypeRequest $request)
    {
        $data = $request->validated();
        $eventType = $this->eventTypeService->store($data);
        return $this->successResponse('success', new EventTypeResource($eventType));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eventType = $this->eventTypeService->get($id);
        return $this->successResponse('success', new EventTypeResource($eventType));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $eventType = $this->eventTypeService->update($data, $id);
        return $this->successResponse('success', new EventTypeResource($eventType));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->eventTypeService->destroy($id);
    }
}
