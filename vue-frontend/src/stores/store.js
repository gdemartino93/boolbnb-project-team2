import { reactive } from "vue";
import axios from "axios";
export const store = reactive ({

    geolocationUrl : 'https://api.tomtom.com/search/2/geocode/',
    apiKey: 'YnMfUAYY76CkHWngLQxDudDG5GdEAEs5',
    latitude: undefined,
    longitude: undefined,
    
    getCohordinates(value){

        // Metodo da spada smart per aggirare le CORS policy

        var theUrl = `${this.geolocationUrl}` + value + `.json?key=${this.apiKey}`;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", theUrl, false);
        xmlHttp.send(null);
        var json = JSON.parse(xmlHttp.responseText);

        this.latitude = json.results[0].position.lat;
        this.longitude = json.results[0].position.lon;

    }
});
export default store