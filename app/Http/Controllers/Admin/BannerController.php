<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $settings = Gallery::pluck('value', 'key')->toArray();
        $sceneryList = isset($settings['scenery_images']) ? json_decode($settings['scenery_images'], true) : [];
        
        // Filter out default Unsplash images to only display custom user scenery cards
        $sceneryList = array_values(array_filter($sceneryList, function($item) {
            return isset($item['image']) && !str_starts_with($item['image'], 'https://images.unsplash.com/');
        }));

        $tours = \App\Models\Tour::all();
        return view('admin.banner-details', compact('settings', 'sceneryList', 'tours'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'home_video' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/ogg,video/webm,video/quicktime|max:20480',
            'home_poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'about_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'services_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tours_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'contact_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'scenery' => 'nullable|array',
            'scenery.*.title' => 'nullable|string|max:255',
            'scenery.*.subtitle' => 'nullable|string|max:255',
            'scenery.*.image_url' => 'nullable|string',
            'scenery.*.file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $keys = [
            'home_video', 'home_poster', 'about_banner', 
            'services_banner', 'tours_banner', 'contact_banner'
        ];

        // Handle single file uploads
        foreach ($keys as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('banners', 'public');
                
                Gallery::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
            }
        }

        // Handle scenery array
        $sceneryData = $request->input('scenery', []);
        $sceneryFiles = $request->file('scenery');
        
        $processedScenery = [];
        
        if (is_array($sceneryData)) {
            foreach ($sceneryData as $index => $item) {
                $imagePath = $item['image_url'] ?? ''; // Existing URL
                
                // If a new file was uploaded for this scenery item
                if ($request->hasFile("scenery.{$index}.file")) {
                    $file = $request->file("scenery.{$index}.file");
                    $imagePath = $file->store('banners', 'public');
                }
                
                $processedScenery[] = [
                    'title' => $item['title'] ?? '',
                    'subtitle' => $item['subtitle'] ?? '',
                    'image' => $imagePath
                ];

                // Link image path to Tour package by matching title
                $title = trim($item['title'] ?? '');
                if (!empty($title)) {
                    $tour = \App\Models\Tour::where('title', $title)->first();
                    if ($tour) {
                        $tour->update(['image' => $imagePath]);
                    }
                }
            }
            
            Gallery::updateOrCreate(
                ['key' => 'scenery_images'],
                ['value' => json_encode($processedScenery)]
            );
        }

        return redirect()->back()->with('success', 'Banners and Media updated successfully.');
    }
}
