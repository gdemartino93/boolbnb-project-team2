<template>
    <div class="" style="top: 250px;">
        <div id="map" style='width: 100%; height: 300px; border-radius: 10px;'></div>
    </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
export default {
    name: "Map",
    data() {
        return {
            map: null,
            markers: [],
        };
    },
    props: {
        center: Object,
        flats: Array,
    },
    watch: {
        center(newValue) {
            this.map.flyTo({ center: newValue, zoom: 10 });
        },
        flats(newValue) {
            for (let marker of this.markers) {
                marker.remove();
            }
            if (newValue) {
                for (let flat of newValue) {
                    this.markers.push(
                        new tt.Marker()
                            .setLngLat({ lon: flat.lon, lat: flat.lat })
                            .addTo(this.map)
                    );
                }
            }
        },
    },
    mounted() {
        this.startMap();
    },
    methods: {
        startMap() {
            this.map = tt.map({
                key: "BkGWT9JoOHyfQlGCvB9M8qbY5ZoUdNZo",
                container: "map",
                center: this.center,
                zoom: 18,
                minZoom: 10,
                // maxBounds: [
                //     [1.7499552751, 1.619987291],
                //     [19.4802470232, 48.1153931748],
                // ],
            });
        },
    },
};
</script>

<style>
</style>