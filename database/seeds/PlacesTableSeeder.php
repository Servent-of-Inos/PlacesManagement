<?php

use Illuminate\Database\Seeder;
use App\Place;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vault = require 'areas.php';
		$keys = array_keys($vault);
        $places = [];

		for($i = 0; $i < count($keys); $i++) {

			$places[$i] = [

        		'address' => (string) $keys[$i],
         		'lat' => (float) $vault[$keys[$i]]['lat'],
         		'lng' => (float) $vault[$keys[$i]]['long']

     		];

            Place::create($places[$i]);

		}
    }
}
