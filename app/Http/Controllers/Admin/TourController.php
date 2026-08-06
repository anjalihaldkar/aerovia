<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::all();
        return view('admin.dashboard', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-tour');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_sharing' => 'required|integer|min:0',
            'price_single' => 'nullable|integer|min:0',
            'inst_deposit' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tours', 'public');
        }
        
        // Reformat itinerary array to be a proper JSON object list
        $itinerary = [];
        if (isset($data['itinerary']) && is_array($data['itinerary'])) {
            $titles = $data['itinerary']['title'] ?? [];
            $banners = $data['itinerary']['banner'] ?? [];
            $descriptions = $data['itinerary']['description'] ?? [];
            
            for ($i = 0; $i < count($titles); $i++) {
                $itinerary[] = [
                    'title' => $titles[$i] ?? '',
                    'banner' => $banners[$i] ?? '',
                    'description' => $descriptions[$i] ?? ''
                ];
            }
        }
        $data['itinerary'] = $itinerary;

        Tour::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Tour created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        return view('admin.add-tour', compact('tour'));
    }

    public function update(Request $request, Tour $tour)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_sharing' => 'required|integer|min:0',
            'price_single' => 'nullable|integer|min:0',
            'inst_deposit' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tours', 'public');
        }
        
        // Reformat itinerary array to be a proper JSON object list
        $itinerary = [];
        if (isset($data['itinerary']) && is_array($data['itinerary'])) {
            $titles = $data['itinerary']['title'] ?? [];
            $banners = $data['itinerary']['banner'] ?? [];
            $descriptions = $data['itinerary']['description'] ?? [];
            
            for ($i = 0; $i < count($titles); $i++) {
                $itinerary[] = [
                    'title' => $titles[$i] ?? '',
                    'banner' => $banners[$i] ?? '',
                    'description' => $descriptions[$i] ?? ''
                ];
            }
        }
        $data['itinerary'] = $itinerary;

        $tour->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Tour updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Tour deleted successfully.');
    }
}
