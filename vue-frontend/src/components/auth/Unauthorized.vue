<script>
export default {

}
</script>

<section class="autenticato" v-else>
    <h1 class="text-danger"> Non Autenticato </h1>
    <h2>Effettua il Login</h2>
</section>

<style lang="scss" scoped>
.autenticato {
    width: 50%;
    text-align: center;
    margin: 100px auto 0 auto;
    position: relative;
    animation-name: animation;
    animation-duration: 0.5s;

    @keyframes animation {
        0% {
            // background-color: red;
            top: 10px;
        }

        50% {
            // background-color: red;
            top: 0px;
        }

        75% {

            top: 10px;
        }

        100% {

            top: 0px;
        }
    }
}
</style>