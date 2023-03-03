<template>
    <div>
        <h1>login</h1>
        <form class="d-flex">
            <label for="name">Nome</label>
            <input type="text" name="name" >
            <label for="surname">Cognome</label>
            <input type="text" name="surname" >
            <label for="date">Data di nascita</label>
            <input type="date" name="date" >
            <label for="email">Email</label>
            <input type="text" name="email" >
            <label for="email">Password</label>
            <input type="password" name="password" >
            <label for="email">Repeat Password</label>
            <input type="password" name="password" >
            <button type="submit" class="">Login</button>
        </form>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
.d-flex{
    display: flex;
    flex-direction: column;
    width: 500px;
    margin: 0 auto;
}
</style>