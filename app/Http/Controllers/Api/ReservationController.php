<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\ReservationServiceInterface;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReservationController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('reservation.owner', except: ['index', 'show', 'store']),
        ];
    }

    /**
     * Service to handle reservations-related logic 
     * and separating it from the controller
     * 
     * @var ReservationServiceInterface
     */
    protected $reservationService;

    /**
     * ReservationService constructor
     *
     * @param ReservationServiceInterface $reservationService
     */
    public function __construct(ReservationServiceInterface $reservationService)
    {
        // Inject the reservationService to handle reservation-related logic
        $this->reservationService = $reservationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = $this->reservationService->getAll();
        return $this->successResponse('success', ReservationResource::collection($reservations));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $reservation = $this->reservationService->store($data);
        return $this->successResponse('success', new ReservationResource($reservation));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation =  $this->reservationService->get($id);
        return $this->successResponse('success', new ReservationResource($reservation));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->reservationService->destroy($id);
        return $this->successResponse('success');
    }
}
