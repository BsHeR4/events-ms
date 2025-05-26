<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\ReservationServiceInterface;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Service to handle reservations-related logic 
     * and separating it from the controller
     * 
     * @var ReservationsServiceInterface
     */
    protected $reservationsService;

    /**
     * ReservationsService constructor
     *
     * @param ReservationsServiceInterface $locationService
     */
    public function __construct(ReservationServiceInterface $reservationsService)
    {
        // Inject the reservationsService to handle location-related logic
        $this->reservationsService = $reservationsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $reservation = $this->reservationsService->store($data);
        return $this->successResponse('success', new ReservationResource($reservation));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
