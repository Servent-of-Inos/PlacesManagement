<template>

    <div id="googleMap"></div>
    
</template>

<script>
  export default {
    
    name: 'GoogleMap',

    props: {
      place: Object
    },

    mounted: function() {

      let map = new google.maps.Map(document.getElementById('googleMap'), {

        center: {
          lat: this.place.lat, 
          lng: this.place.lng
        },
        scrollwheel: false,
        zoom: 10

      });

      let marker = new google.maps.Marker({position: {
        lat: this.place.lat, 
        lng: this.place.lng
      }, map: map});

    }

  }
</script>

<style scoped>

  #googleMap {
    height:300px;
    width: 100%;
   }

</style>