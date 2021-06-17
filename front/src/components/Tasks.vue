<template>
<div>
    <div v-for="task in tasks " :key="task">
        <Task @reserve="$emit('reserve', task)" @deleteMe="$emit('deleteMe', task)" :value="date" :task="task"/>
    </div>
</div>
</template>


<script>

import Task from './Task'

export default {
    name:'Tasks',
    components:{
        Task,
        },
    props:{
        tasks:Array,
        
    },
    emits:['reserve','deleteMe'],
    
    
}
</script>
