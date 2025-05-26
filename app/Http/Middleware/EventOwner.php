<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $eventId = $request->route('event');
        $event = Event::findOrFail($eventId);

        if ($event->organizer_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not the owner of this event'
            ], 403);
        }

        return $next($request);
    }
}
