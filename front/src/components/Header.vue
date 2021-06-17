<template>
    <header>
        <h1>{{name}}</h1>
        &nbsp;&nbsp;&nbsp;
        <!-- <ButtonVue @toggle-add-task="$emit('toggle-add-task')" :nameBtn="showAddTasks ? '❌' : '➕ Add task'" :color="showAddTasks ? 'black' : 'green'" :border="showAddTasks ? '25px' : '5px'"/> -->
        
        
        <router-link to="/login"><ButtonVue  :nameBtn="'Login'" :color="'black'" :border="'5px'" /></router-link>
        &nbsp;&nbsp;&nbsp;
        
        <router-link to="/register"><ButtonVue :nameBtn="'Register'" :color="'red'" :border="'5px'" /></router-link>
        
    </header>
</template>

<script>

import ButtonVue from './ButtonVue';

export default {
    name: 'header',
    props:{
        name:String,
        showAddTasks:Boolean,
    },
    components:{
        ButtonVue,
    }
}
</script>


<style scoped>
header {
    display:flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

</style>
