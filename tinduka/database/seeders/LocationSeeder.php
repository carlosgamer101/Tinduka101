<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $places = [
            'Amboseli' => 'amboseli.jpg',
            'Diani Beach' => 'diani-beach.jpg',
            'Hells Gate' => 'hells-gate.jpg',
            'Lake Nakuru' => 'lake-nakuru.jpg',
            'Lamu' => 'lamu.jpg',
            'Maasai Mara' => 'maasai-mara.jpg',
            'Mount Kenya' => 'mount-kenya.jpg',
            'Nairobi Park' => 'nairobi-park.jpg',
            'Samburu' => 'samburu.jpg',
            'Tsavo' => 'tsavo.jpg',
        ];

        foreach ($places as $name => $image) {
            Location::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "Explore the breathtaking beauty of {$name}, one of Kenya's most iconic destinations. Perfect for adventure and relaxation.",
                'image' => "locations/{$image}",
            ]);
        }
    }
}