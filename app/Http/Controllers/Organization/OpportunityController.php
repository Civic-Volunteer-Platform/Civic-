<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{
    public function index()
    {
        // Show all opportunities for the logged-in organization
        $opportunities = Auth::user()->opportunities()->latest()->paginate(10);
        return view('organization.opportunities.index', compact('opportunities'));
    }

    public function create()
    {
        return view('organization.opportunities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $validated['organization_id'] = Auth::id();

        Opportunity::create($validated);

        return redirect()->route('organization.opportunities.index')->with('success', 'Opportunity created successfully.');
    }

    public function show(Opportunity $opportunity)
    {
        $this->authorizeOpportunity($opportunity);
        return view('organization.opportunities.show', compact('opportunity'));
    }

    public function edit(Opportunity $opportunity)
    {
        $this->authorizeOpportunity($opportunity);
        return view('organization.opportunities.edit', compact('opportunity'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $this->authorizeOpportunity($opportunity);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $opportunity->update($validated);

        return redirect()->route('organization.opportunities.index')->with('success', 'Opportunity updated successfully.');
    }

    public function destroy(Opportunity $opportunity)
    {
        $this->authorizeOpportunity($opportunity);

        $opportunity->delete();

        return redirect()->route('organization.opportunities.index')->with('success', 'Opportunity deleted successfully.');
    }

    // Helper to restrict access to owning organization only
    protected function authorizeOpportunity(Opportunity $opportunity)
    {
        if ($opportunity->organization_id !== Auth::id()) {
            abort(403);
        }
    }
}
