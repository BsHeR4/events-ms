<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EventController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:admin|organizer', except: ['index', 'show', 'usersEvents']),
        ];
    }

    /**
     * Service to handle event-related logic 
     * and separating it from the controller
     * 
     * @var EventServiceInterface
     */
    protected $eventService;

    /**
     * EventController constructor
     *
     * @param EventServiceInterface $eventTypeService
     */
    public function __construct(EventServiceInterface $eventService)
    {
        // Inject the eventService to handle event-related logic
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->eventService->getAll();
        return $this->successResponse('success', EventResource::collection($events));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $event = $this->eventService->store($data);
        return $this->successResponse('success', new EventResource($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = $this->eventService->get($id);

        return $this->successResponse('success', new EventResource($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $data = $request->validated();
        $event = $this->eventService->update($data, $id);
        return $this->successResponse('success', new EventResource($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->eventService->destroy($id);
        return $this->successResponse('success');
    }

    public function usersEvents()
    {
        $events = $this->eventService->usersEvents();
        return $this->successResponse('success', EventResource::collection($events));
    }
}
