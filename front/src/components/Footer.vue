<template>
    <footer>
        <p>
            copyrights 2021
        </p>

        <router-link to="/about">about</router-link>&nbsp; 
        <router-link to="/login">logout</router-link>
    </footer>
</template>

<script>
export default {
    methods:{
        ifLogged(){

        }
    }
}
</script>



<style scoped>
a {
    color: #333;

}
footer{
    margin-top: 30px;
    text-align: center;
}
</style>