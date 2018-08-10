<?php

namespace App\Repositories;

use App\Place;

class PlacesRepository
{   

	public function addDistance (String $currentPlace) 
	{
		$distances = [];
		$radius = 6373;
		$i=0;

		$currentPlace = Place::Where('address', $currentPlace)
			->get()
			->toArray();

		$places = Place::All()->toArray();

		foreach ($places as &$place) {

			$lat1 = deg2rad($currentPlace[0]['lat']);
			$lat2 = deg2rad($place['lat']);
			$lng1 = deg2rad($currentPlace[0]['lng']);
			$lng2 = deg2rad($place['lng']);

			$dlng = $lng2 - $lng1;
			$dlat = $lat2 - $lat1;

			$a = (pow(sin($dlat/2), 2)) + cos($lat1) * cos($lat2) * (pow(sin($dlng/2), 2));
			$c = 2 * atan2( sqrt($a), sqrt(1-$a) ); 
			$d = $radius * $c;

			$distances[$i] = $d;
			$place+= ['distance' => $distances[$i]];
			$i++;

		}

		$places = collect($places)
			->sortBy('distance')
			->values()
			->all();

		return $places;

	}

}