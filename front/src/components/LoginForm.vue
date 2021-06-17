<template>
    <form @submit="onSubmit" class="formTask">
        
        <div class="formContent">
            <p>first_name</p>
            <input type="text" v-model="first_name">
            
        </div>
        <div class="formContent">
            <p>last_name</p>
            <input type="text" v-model="last_name">
            
        </div>
        <div class="formContent">
            <p>email</p>
            <input type="text" v-model="email">
            
        </div>
        <ButtonVue type="submit" nameBtn="register" color="white" width="100%"/>
        <br>
        <br>
    </form>
</template>

<script>
import ButtonVue from './ButtonVue'
export default {
    name:"Login",
    components:{
        ButtonVue,
    },
    data(){
        return {
            first_name: '',
            last_name: '',
            email: '',
        }
    },
    methods:{
        onSubmit(e){
            e.preventDefault()

            if(!this.first_name || !this.last_name || !this.email){
                alert('please fill out the form')
                return
            }

            const newUser = {
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
            }
            this.$emit('add-user',newUser);

            this.first_name =''
            this.last_name =''
            this.email =''
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
