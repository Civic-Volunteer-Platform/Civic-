<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Opportunity;
use App\Models\Application;
use Carbon\Carbon;
use DB;

class VolunteerController extends Controller
{
    /**
     * Display the volunteer dashboard with opportunities and a monthly application chart.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $opportunities = Opportunity::latest()->get();

        $appliedIds = Application::where('user_id', $user->id)
            ->pluck('opportunity_id')
            ->toArray();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $applications = Application::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $chartLabels = [];
        $chartData = [];

        $daysInMonth = $startOfMonth->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $startOfMonth->copy()->day($day)->toDateString();
            $chartLabels[] = Carbon::parse($date)->format('M j');

            $count = $applications->firstWhere('date', $date)?->count ?? 0;
            $chartData[] = $count;
        }

        return view('volunteer.dashboard', compact(
            'opportunities', 'appliedIds', 'chartLabels', 'chartData'
        ));
    }

    /**
     * Show all available volunteering events.
     */
    public function events()
    {
        $user = Auth::user();

        $opportunities  = Opportunity::latest()->get(); // changed to $events

        $applied = Application::where('user_id', $user->id)
            ->pluck('opportunity_id')
            ->toArray();

        return view('volunteer.events', compact('events', 'applied'));
    }

    /**
     * Show the authenticated user's applications.
     */
    public function applications()
    {
        $user = Auth::user();

        $applications = Application::with('opportunity')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('volunteer.applications', compact('applications'));
    }

    /**
     * Apply to a specific volunteering opportunity.
     */
    public function apply($id)
    {
        $user = Auth::user();

        $opportunity = Opportunity::findOrFail($id);

        Application::firstOrCreate([
            'user_id' => $user->id,
            'opportunity_id' => $opportunity->id,
        ]);

        return redirect()->route('volunteer.applications')->with('success', 'Application submitted.');
    }

    /**
     * Show the volunteer's profile.
     */
    public function profile()
    {
        return view('volunteer.profile');
    }

    /**
     * Update the volunteer's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('volunteer.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show messages received by the volunteer (placeholder).
     */
    public function messages()
    {
        // You could pass actual messages from a DB table later.
        return view('volunteer.messages');
    }

    /**
     * Show volunteer settings.
     */
    public function settings()
    {
        return view('volunteer.settings');
    }

    /**
     * Get unread messages count (for notification bell - mock).
     * Extend this to fetch from DB.
     */
    public function getMessageCount()
    {
        return 0; // or fetch from messages table
    }
}
