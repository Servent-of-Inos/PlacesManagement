<b-dropdown  size="sm" id="ddown1" text="Shoose your location:" class="m-md-2">
	
	<b-dropdown-item v-for="place in places.data" 
					 v-on:click.prevent="getPlaces(1, place.address)"> @{{place.address}}
	</b-dropdown-item>

</b-dropdown>
