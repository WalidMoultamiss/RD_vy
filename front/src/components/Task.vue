<template>
<div :class="[[task.id ? 'reminder' : '' , 'task'],[ mine ? 'mine' : '']]">
    <div class="header">
        <div>
      <h6>creneau n°{{task.slot}}</h6>
      <h6>id n°{{task.id}}</h6>
      <div v-if="task.id">
      <h3>le {{task.date}}</h3>
      </div>
      </div>
      <div v-if="!task.id" class="btn-div">
        <!-- <i @click="onBell(task.id)"  class="fas fa-info"></i> -->
        <i @click="reserve(task)" class="fas  fa-concierge-bell btnBook">&nbsp;Book now</i>
      </div>
      <div v-if="mine" class="btn-div">
        <!-- <i @click="onBell(task.id)"  class="fas fa-info"></i> -->
        <i @click="deleteMe(task)" class="fas  fa-trash btnBook">&nbsp;cancel </i>
      </div>
    </div>
    <div v-if="task.id">
    <div style="display:flex;">
    <p>reserved by {{task.refenrence_id}}</p>
    <span v-if="mine">&nbsp;(mine)</span>
    </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'Task',
    props:{
        date:String,
        task: Object,
        mine:Boolean
    },
    data(){
        return {
            mine:false
        }
    },
    
    methods:{
        reserve(task){
            this.$emit('reserve', task)
        },
        deleteMe(task){
            this.$emit('deleteMe', task);
        },
        isMine(task){
            let user = JSON.parse(localStorage.getItem('user'))
            
            if(user.reference == task.refenrence_id){
                this.mine = true
            }
        }
    },
    created(){
        this.isMine(this.task)
    }
    }
</script>
<style scoped lang="scss">
    .reminder{
        background: rgb(206, 206, 206)!important;
    }

    .mine{
        background: rgb(0, 102, 107) !important;
    }
    .btnBook{
        color: rgb(255, 255, 255);
        min-width: 100px;
        background-color: azure;
        padding: 5px 5px;
        border-radius: 25px;
        cursor: pointer;
        text-align: center;
    }
    .task{
        min-width: 300px;
        max-width: 500px;
        padding: 5px;
        min-height: 50px;
        padding-left: 10px;
        padding-right: 72px;
        text-align: left;
        background-color: rgb(12, 119, 0);
        border-radius: 5px;
        margin-bottom: 10px;
        transition: 0.5s;
        &:hover{
            color: rgb(0, 0, 0);
            background-color: rgb(0, 160, 3);
        }
        .header{
            display: flex;
            justify-content: space-between;
            .btn-div{
            width: 35px;
            display: flex;
            justify-content: space-between;
        }
        h3{
            color: rgb(0, 0, 0);
            display: flex;
            justify-content: space-between;
            
      }
    }
  }
        
</style>