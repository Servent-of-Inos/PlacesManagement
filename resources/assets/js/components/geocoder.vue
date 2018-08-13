<template>

  <div id="googleGeocoder">

    <input v-if="isupdate=='create'" id="address" type="textbox" value="Kyiv">
    <input v-else id="address" type="textbox" placeholder="enter new place:">


    <input id="submit" type="button" value="Look" v-on:click.prevent="geocodeAddress()">

    <input v-if="(newPlace.address !== '')&&(newPlace.lat !== '')&&(newPlace.lng !== '')&&(isupdate=='create')" id="submit" type="button" value="Save" v-on:click.prevent="createPlace()">
    <input v-if="(newPlace.address !== '')&&(newPlace.lat !== '')&&(newPlace.lng !== '')&&(isupdate=='update')" type="button" value="Edit" v-on:click.prevent="updatePlace()">

    <div id="googleGeocoderMap"></div>

  </div>
    
</template>

<script>

  import CxltToastr from 'cxlt-vue2-toastr'

  export default {
    
    name: 'GoogleGeocoder',

    props: {
      place: {
        type: Object,
        required: true
      },
      isupdate: {
        type: String,
        required: true
      }
    },

    data: function () {

      return {

        map: {},
        geocoder: {},
        marker: {},
        newPlace: {'address': '', 'lat': '', 'lng': ''},
        errors: []

      }

    },

    mounted: function() {

      this.map = new google.maps.Map(document.getElementById('googleGeocoderMap'), {

        center: {
          lat: this.place.lat, 
          lng: this.place.lng
        },
        scrollwheel: false,
        zoom: 10

      });

      this.marker = new google.maps.Marker({position: {
        lat: this.place.lat, 
        lng: this.place.lng
      }, map: this.map});

      this.geocoder = new google.maps.Geocoder();

    },

    methods: {

      geocodeAddress () {

        let address = document.getElementById('address').value;

        this.geocoder.geocode({'address': address}, (results, status) => {

          if (status === 'OK') {

            this.newPlace.address = results[0].formatted_address;
            this.newPlace.lat = results[0].geometry.location.lat();
            this.newPlace.lng = results[0].geometry.location.lng();

            this.map.setCenter(results[0].geometry.location);

            this.marker = new google.maps.Marker({
              map: this.map,
              position: results[0].geometry.location
            });

          } else {

            alert('Geocode was not successful for the following reason: ' + status);

          }

        });
      },

      createPlace() {

      let url = 'places';

      axios({
          method: 'post',
          url: url,
          data: {
            address: this.newPlace.address,
            lat: this.newPlace.lat,
            lng: this.newPlace.lng
          }
        }).then(response => {

          this.$toast.success({
            title: 'Information',
            message:  this.newPlace.address + 'successfully added to list!'
          });

          this.newPlace = {'address': '', 'lat': '', 'lng': ''};
          this.errors = [];

        }).catch(error => {
          this.errors = error.response.data
        });
    },

    updatePlace() {

      let url = 'places/' + this.place.id;

      axios.put(url, this.newPlace).then(response => {

        this.$toast.success({
            title: 'Information',
            message:  this.newPlace.address + 'successfully changed!'
        });

        this.newPlace = {'id': '', 'address': '', 'lat': '', 'lng': ''};
        this.errors = [];

        this.$modal.hide('editPlace');

      }).catch(error => {
        this.errors = error.response.data
      });
    }

    }

  }

</script>

<style scoped>

  #googleGeocoderMap {
    height:300px;
    width: 100%;
  }

</style>