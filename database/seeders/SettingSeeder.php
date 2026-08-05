<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed default settings
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'phone' => '+91 62890 06014',
                'email' => 'traletravelsinc@gmail.com',
                'address' => '127A Park Street, Kolkata - 700016, West Bengal, India',
                'fb' => 'https://www.facebook.com/aeroviaexpeditions',
                'linkedin' => 'https://www.linkedin.com/company/aeroviaexpeditions',
                'instagram' => 'https://www.instagram.com/aeroviaexpeditions',
                'whatsapp' => '916289006014'
            ]
        );

        // Seed default FAQs
        $defaultFaqs = [
            [ 'question' => "What is included in an Aerovia tour package?", 'answer' => "Our packages include luxury accommodations, private airport transfers, curated guided tours, entry tickets, daily breakfast, and 24/7 concierge assistance." ],
            [ 'question' => "Can I customize a pre-designed itinerary?", 'answer' => "Absolutely! Every tour package can be tailored to match your specific dates, preferred pace, dietary needs, and hotel upgrades." ],
            [ 'question' => "How does the 'Pay Now' online payment system work?", 'answer' => "Our secure checkout allows instant credit/debit card, Apple Pay, and wire transfer payments with immediate digital confirmation and itinerary delivery." ],
            [ 'question' => "What is Aerovia's trip cancellation & refund policy?", 'answer' => "Full refunds are issued for cancellations made 30 days prior to departure. Flexible rescheduling options are available for unforeseen events." ],
            [ 'question' => "Do you assist with international travel visas?", 'answer' => "Yes, our dedicated visa concierges assist with e-visa applications, invitation letters, document preparation, and embassy appointments worldwide." ],
            [ 'question' => "Are flights included in the package cost?", 'answer' => "We offer both land-only packages and full flight-inclusive options through our airline partner network at competitive rates." ],
            [ 'question' => "What size are your group tours?", 'answer' => "We specialize in small-group expeditions (maximum 12–16 travelers) and 100% private tours to guarantee an intimate, premium experience." ],
            [ 'question' => "Is travel insurance required for booking?", 'answer' => "While optional, we strongly recommend comprehensive travel insurance. We partner with leading global insurers to provide instant coverage." ],
            [ 'question' => "What support is available during our trip?", 'answer' => "You will have a dedicated local travel manager and a 24/7 WhatsApp concierge helpline for immediate assistance on the ground." ],
            [ 'question' => "Do you offer corporate or family group discounts?", 'answer' => "Yes, we offer tailored rates and customized perks for corporate groups, custom family gatherings, and groups booking 8 or more guests." ]
        ];

        foreach ($defaultFaqs as $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                ['answer' => $faq['answer']]
            );
        }
    }
}
