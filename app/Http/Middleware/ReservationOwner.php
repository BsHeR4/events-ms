<?php

namespace App\Http\Middleware;

use App\Models\Reservation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reservationId = $request->route('reservation');
        $reservation = Reservation::findOrFail($reservationId);

        if ($reservation->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not the owner of this reservation'
            ], 403);
        }

        return $next($request);
    }
}
