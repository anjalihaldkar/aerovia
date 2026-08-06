<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Gallery;
use App\Models\Tour;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $gallery = Gallery::where('key', 'scenery_images')->first();
        if ($gallery) {
            $sceneryList = json_decode($gallery->value, true);
            if (is_array($sceneryList)) {
                foreach ($sceneryList as $item) {
                    $title = trim($item['title'] ?? '');
                    $image = $item['image'] ?? '';
                    if (!empty($title) && !empty($image)) {
                        $tour = Tour::where('title', $title)->first();
                        if ($tour) {
                            $tour->update(['image' => $image]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
