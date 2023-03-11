<template>
    
  <h1>Vue 3 TomTom Maps Demo</h1>
  <div id='map' ref="mapRef"></div>
</template>

<script>
import { onMounted,  ref } from 'vue'
export default {
name: 'Map',
setup() {
  const mapRef = ref(null);
  onMounted(() => {
    
          const tt = window.tt;
          var map = tt.map({
          key: 'BkGWT9JoOHyfQlGCvB9M8qbY5ZoUdNZo',
          container: mapRef.value,
          style: 'tomtom://vector/1/basic-main',
      });
      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl()); 
      addMarker(map);
  })
  function addMarker(map){
     const tt = window.tt;
      var location = [-121.91595, 37.36729];
      var popupOffsets = {
top: [0, 0],
bottom: [0, -30],
'bottom-right': [0, -30],
'bottom-left': [0, -30],
left: [25, -35],
right: [-25, -35]
}
      var marker = new tt.Marker().setLngLat(location).addTo(map);
      var popup = new tt.Popup({offset: popupOffsets}).setHTML("Your address!");
marker.setPopup(popup).togglePopup();
  }
  return {
    mapRef,
  }
  
}

}
</script>
<style>
#map {
  height: 50vh;
  width: 50vw;
}
</style>