<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Faq;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display general settings.
     */
    public function index()
    {
        $settings = Setting::first();
        $faqs = Faq::all();
        return view('admin.settings', compact('settings', 'faqs'));
    }

    /**
     * Update settings and FAQs.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\s\-]{10,20}$/'],
            'email' => 'required|email|max:255',
            'address' => 'required|string|min:10',
            'fb' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs.*.answer|string',
            'faqs.*.answer' => 'required_with:faqs.*.question|string',
        ]);

        Setting::updateOrCreate(
            ['id' => 1],
            $request->only(['phone', 'email', 'address', 'fb', 'linkedin', 'instagram', 'whatsapp'])
        );

        Faq::truncate();

        if ($request->has('faqs')) {
            $faqsData = collect($request->input('faqs'))->filter(function ($faq) {
                return !empty($faq['question']) && !empty($faq['answer']);
            })->map(function ($faq) {
                return [
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();
            Faq::insert($faqsData);
        }

        return redirect()->route('admin.settings')->with('success', 'General settings and FAQs updated successfully!');
    }
}
