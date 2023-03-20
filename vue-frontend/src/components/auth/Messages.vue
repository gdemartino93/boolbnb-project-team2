<script>
export default{
    props: ['apartment']
}
</script>

<template>

    <div class="ms_card">

        <div class="pic">

        </div>

        <section class="ms_messagebox">

            <!-- Button trigger modal -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" v-for="message in apartment.messages">
                
                <font-awesome-icon icon="fa-solid fa-envelope" class="letterIcon"/>
                {{ message.mail }}
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" v-for="message in apartment.messages">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Il tuo messaggio da 
                        <span style="color: #ff3d00">

                            {{ message.name }}
                        </span>
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{message.text}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary">Rispondi</button>
                </div>
                </div>
            </div>
            </div>

        </section>
    </div>
</template>

<style lang="scss" scoped>

    .ms_card {

        width: 200px;
        height: 300px;

        .pic {

            // immagine statica, sostituire con apartment.img
            background-image: url('../../assets/webaliser-_TPTXZd9mOo-unsplash.jpg');
            width: 100%;
            height: 50%;
            background-size: contain;
            background-repeat: no-repeat;
            border-radius: 15px 15px 0 0;
        }

        .ms_messagebox {

            height: max-content;
            overflow-y: auto;

            .btn {
                
                background-image: linear-gradient(to right, #ff3d00, #FF5F00);
                color: #fff;

                .letterIcon {

                    font-size: 13px;
                }
            }
        }
    }
</style>