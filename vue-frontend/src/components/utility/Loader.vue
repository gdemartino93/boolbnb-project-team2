<template>
    <div class="loader">
        <PulseLoader />
    </div>
</template>

<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

    export default {
        components : {
            PulseLoader
        }
    }
</script>

<style lang="scss" scoped>
.loader{
    width: 100vw;
    height: 90vh;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
</style>