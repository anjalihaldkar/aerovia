<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tour::create([
            'title' => 'Poland & Czechia',
            'subtitle' => 'Warsaw, Krakow, Czestochowa, Wadowice, Salt Mine, Zakopane & Prague. Direct flights, 4★/5★ hotels & meals included.',
            'duration' => '10D/11N',
            'accommodation' => '4 & 5 ★ Luxury Hotels',
            'start_date' => '2026-10-15',
            'end_date' => '2026-10-25',
            'price_sharing' => '349999',
            'price_single' => '42000',
            'discount_returning' => '19999 OFF',
            'discount_early' => '9999 OFF (Before July 20th)',
            'inst_deposit' => '50000',
            'inst_1' => '90000 due Aug 3',
            'inst_2' => '90000 due Sep 5',
            'inst_final' => '69999 due Oct 5',
            'inclusions' => "Return economy airfares\nEurope eSIM data\n4★ & 5★ hotel accommodations\nPrivate fjord cruises\nGuided sightseeing tours\nAll breakfast & dinner meals",
            'exclusions' => "Personal laundry shopping\nStandard hotel early check-in fees\nItinerary modifications due to weather\nTravel insurance coverage",
            'director' => 'Mr. Dale Mogose',
            'director_phone' => '+91 62890 06014',
            'flights' => [
                ['route' => 'Kolkata to Delhi', 'code' => 'IndiGo 6E5190', 'baggage' => '15 kg', 'cabin' => '7 kg'],
                ['route' => 'Delhi to Warsaw', 'code' => 'Polish Airlines LOT LO72', 'baggage' => '23 kg', 'cabin' => '8 kg'],
                ['route' => 'Prague to Delhi', 'code' => 'Air Arabia (via Sharjah)', 'baggage' => '23 kg', 'cabin' => '7 kg']
            ],
            'itinerary' => [
                [
                    'title' => 'Flight Departure',
                    'banner' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Meet at Kolkata Airport for flight to Delhi. Layover at Delhi Airport overnight before the international departure.'
                ],
                [
                    'title' => 'Warsaw Arrival',
                    'banner' => 'https://images.unsplash.com/photo-1473951574080-01fe45ec8643?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Board LO72 to Warsaw. Arrive in afternoon, check-in, and rest at hotel.'
                ],
                [
                    'title' => 'Krakow Castle Exploration',
                    'banner' => 'https://images.unsplash.com/photo-1589923188900-85dae443942b?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Explore the majestic Wawel Royal Castle and the beautiful Old Town square in Krakow.'
                ],
                [
                    'title' => 'Auschwitz-Birkenau Memorial',
                    'banner' => 'https://images.unsplash.com/photo-1549693578-d683be217e58?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Pay respects at the historic Auschwitz-Birkenau memorial site with a licensed local guide.'
                ],
                [
                    'title' => 'Zakopane Resort Town',
                    'banner' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Travel to Zakopane, Poland\'s winter capital, and enjoy cable car views of the Tatra Mountains.'
                ],
                [
                    'title' => 'Wieliczka Salt Mine',
                    'banner' => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Walk through the underground salt-carved chapels and chambers at the Wieliczka Salt Mine.'
                ],
                [
                    'title' => 'Prague Old Town Square',
                    'banner' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Travel to Prague and experience the Astronomical Clock and Charles Bridge during sunset.'
                ]
            ]
        ]);

        Tour::create([
            'title' => 'Bali Sunset & Temple Retreat',
            'subtitle' => 'Cliffside ocean sanctuaries, Kecak dance performances, and luxury beach resort stays in Bali.',
            'duration' => '6D/5N',
            'accommodation' => '4★ & 5★ Beachfront Resorts',
            'start_date' => '2026-11-10',
            'end_date' => '2026-11-16',
            'price_sharing' => '115000',
            'price_single' => '25000',
            'discount_returning' => '10000 OFF',
            'discount_early' => '5000 OFF (Before Aug 15th)',
            'inst_deposit' => '20000',
            'inst_1' => '40000 due Sep 1',
            'inst_2' => '40000 due Oct 1',
            'inst_final' => '15000 due Nov 1',
            'inclusions' => "Return flights\n5 nights resort lodging\nDaily buffet breakfasts\nPrivate guided transfers",
            'exclusions' => "Personal beverages & shopping\nStandard early check-in fees",
            'director' => 'Mr. Ketut Wijaya',
            'director_phone' => '+62 812 3456 7890',
            'flights' => [
                ['route' => 'Kolkata to Bali', 'code' => 'AirAsia AK632', 'baggage' => '20 kg', 'cabin' => '7 kg']
            ],
            'itinerary' => [
                [
                    'title' => 'Arrive in Bali',
                    'banner' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Welcome to Bali! Meet your guide and transfer to your beachfront resort in Nusa Dua.'
                ],
                [
                    'title' => 'Uluwatu Sunset Temple',
                    'banner' => 'https://images.unsplash.com/photo-1604999333679-b86d54738315?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Visit the iconic Uluwatu Cliff Temple and witness the magical Kecak Fire Dance at sunset.'
                ]
            ]
        ]);

        Tour::create([
            'title' => 'Norway Fjord & Aurora Odyssey',
            'subtitle' => 'Private fjord cruises, Northern Lights chases in Tromsø, and scenic Flåm mountain railway journeys.',
            'duration' => '9D/8N',
            'accommodation' => 'Boutique Fjord Hotels',
            'start_date' => '2026-12-05',
            'end_date' => '2026-12-14',
            'price_sharing' => '285000',
            'price_single' => '55000',
            'discount_returning' => '15000 OFF',
            'discount_early' => '8000 OFF',
            'inst_deposit' => '40000',
            'inst_1' => '100000 due Oct 1',
            'inst_2' => '100000 due Nov 1',
            'inst_final' => '45000 due Dec 1',
            'inclusions' => "All airport connections\nFjord cruises\nNorthern Lights tour\nDaily hot breakfast",
            'exclusions' => "Optional winter activity rentals\nTravel insurance",
            'director' => 'Ms. Astrid Solberg',
            'director_phone' => '+47 912 34 567',
            'flights' => [
                ['route' => 'Kolkata to Oslo', 'code' => 'Qatar Airways QR244', 'baggage' => '30 kg', 'cabin' => '7 kg']
            ],
            'itinerary' => [
                [
                    'title' => 'Oslo Arrival',
                    'banner' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Arrive in Oslo, checking into your boutique hotel. Enjoy an evening walk in the capital.'
                ],
                [
                    'title' => 'Tromsø Aurora Chase',
                    'banner' => 'https://images.unsplash.com/photo-1524312411649-62325ec2d174?auto=format&fm=webp&fit=crop&w=800&q=80',
                    'description' => 'Fly to Tromsø inside the Arctic Circle and embark on your first evening Northern Lights chase.'
                ]
            ]
        ]);
    }
}
