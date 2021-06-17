<template>
    <form @submit="onSubmit" class="formTask">
        
        
        <div class="formContent">
            <p>Task</p>
            <input type="text" v-model="text">
            
        </div>
        <div class="formContent">
            <p>day & time</p>
            <input type="text" v-model="day">
        </div>
        <div class="">
            <input type="checkbox" v-model="reminder">&nbsp;
            <span>Set reminder</span>
            
        </div>
        <ButtonVue type="submit" nameBtn="save task" color="white" width="100%"/>
        <br>
        <br>
    </form>
</template>

<script>
import ButtonVue from './ButtonVue'
export default {
    name:"task default",
    components:{
        ButtonVue,
    },
    data(){
        return {
            text: 'task default'+(Math.floor(Math.random()*100)),
            day: '',
            reminder: false,
        }
    },
    methods:{
        onSubmit(e){
            e.preventDefault()

            if(!this.text){
                alert('the task is empty')
                return
            }

            const newTask = {
                id: Math.floor(Math.random() * 100000),
                text: this.text,
                day: this.day,
                reminder: this.reminder ? this.reminder!='' : false,
                status: 'viewed',
            }
            this.$emit('add-task',newTask);

            this.text =''
            this.day =''
            this.reminder =''
        }
    }
}

</script>

<style scoped lang="scss">

.formTask{
    max-width: 450px;
    background-color: rgb(39, 0, 0);
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 5px;
    .formContent{
        text-align: left;
        text-justify: center;
        input{
            width: 100%;
            background: rgb(112, 112, 112);
            border: none;
            border-radius: 5px;
            outline: none;
            padding-left: 10px;
            height: 25px;
        }
    }
}

</style>
