<modal name="showPlace" weight="auto" height="auto" :scrollable="true">

	<ul>
		<li>Id: @{{ fillPlace.id }}</li>
		<li>Place: @{{ fillPlace.address }}</li>
		<li>Latitude: @{{ fillPlace.lat }}</li>
		<li>Longitude: @{{ fillPlace.lng }}</li>
	</ul>

	<googlemap :place="fillPlace"></googlemap>

</modal>

				
				
	