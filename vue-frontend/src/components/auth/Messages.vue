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
            <ul>
                <li v-for="message in apartment.messages">
                    
                    <p class="author">

                        {{ message.mail }}
                    </p>
                    <p class="date">

                        {{ message.created_at }}
                    </p>
                </li>
            </ul>
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