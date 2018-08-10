/**
 * Load all of this project's JavaScript dependencies.
*/

require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'
import CxltToastr from 'cxlt-vue2-toastr'
import VModal from 'vue-js-modal'

Vue.use(VModal);
Vue.use(CxltToastr);
Vue.use(BootstrapVue);

Vue.component('pagination', require('laravel-vue-pagination'));

import googlemap from './components/map'
import geocoder from './components/geocoder'

/**
 * Create a fresh Vue application instance.
*/

const App = new Vue({

	el: '#target',

	created: function() {

		this.getPlaces();

	},

	data: {

		places: {},
		Kyiv: {'address': 'Kyiv', 'lat': 50.45466, 'lng': 30.5238},
		fillPlace: {'id': '', 'address': '', 'lat': '', 'lng': ''},
		addressFilter: ''

	},

	components: {
		googlemap,
		geocoder
	},
	
	methods: {

		getPlaces(page=1, place='') {

			let url = '';

			if (place == '') {

  				url = '/places?page=' + page;

			} else {

				url = '/places?page=' + page + '&place=' + place;

			}

			axios.get(url).then(response => {

				this.places = response.data;

			});

		},

		getKeysForDropDownList() {

			let url = '/places?page=' + page;

			axios.get(url).then(response => {

				this.places = response.data;

			});

		},

		deletePlace(place, page) {

			let url = 'places/' + place.id;

			axios.delete(url).then(response => { 

				this.getPlaces(page);

				this.$toast.warn({
    					title: 'Information',
    					message: place.address + ' successfully removed!'
				})
			});
		},

		showMap(place) {

			this.fillPlace.id = place.id;
			this.fillPlace.address = place.address;
			this.fillPlace.lat = place.lat;
			this.fillPlace.lng = place.lng;

			this.$modal.show('showPlace');

		},

		showCreateForm(){

			this.$modal.show('createPlace');
		},

		showEditForm(place){

			this.fillPlace.id = place.id;
			this.fillPlace.address = place.address;
			this.fillPlace.lat = place.lat;
			this.fillPlace.lng = place.lng;

			this.$modal.show('editPlace');
		}

	}

});