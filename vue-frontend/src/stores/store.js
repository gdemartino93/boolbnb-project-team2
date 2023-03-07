import { reactive } from "vue";
import axios from "axios";
export const store = reactive ({

additional_services : [
    {
        id : 1,
        name : "Piscina"
    },
    {
        id:2,
        name: "Box"
    },
    {
        id:3,
        name: "Wifi"
    }
]
});
export default store