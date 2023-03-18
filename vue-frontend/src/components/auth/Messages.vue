<script>
import MsgModal from './MsgModal.vue';

export default{
    props: ["apartment"],
    components: { MsgModal }
}
</script>

<template>

    <div class="ms_card">

        <div class="pic">

        </div>

        <section class="ms_messagebox">
            <ul>
                <li v-for="(message,index) in apartment.messages" :key="index">
                    
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ message.mail }}
                    </button>

                    <MsgModal :message="message" />
                </li>
            </ul>
        </section>
    </div>
</template>

<style lang="scss" scoped>

    .ms_card {

        width: 250px;
        height: 300px;

        .pic {

            // immagine statica, sostituire con apartment.img
            background-image: url('../../assets/webaliser-_TPTXZd9mOo-unsplash.jpg');
            width: 100%;
            height: 50%;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 15px 15px 0 0;
        }

        .ms_messagebox {

            height: 50%;
            overflow-y: auto;
            border: 1px dashed black;
            border-radius: 0 0 15px 15px;

            ul {
                list-style-type: none;

                .date {

                    font-size: 8px;
                }

                .author {

                    font-size: 13px;
                }
            }
        }
    }
</style>