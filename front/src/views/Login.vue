<template>
    <form @submit="LoginUser" class="formTask">
        <div class="formContent">
        <input type="text" placeholder="email" v-model="email">
        </div>
        <div class="formContent">
        <input type="password" placeholder="password" v-model="password">
        </div>
        <ButtonVue type="submit" nameBtn="Login" color="white" width="100%"/>
    </form>
</template>



<script>
import ButtonVue from '../components/ButtonVue'
export default{

    name:"Login",
    components:{
        ButtonVue
    },
    data(){
        return{
            
            email:this.email,
            password:this.password,
        }
    },
    beforeMount(){
      this.logout()
    },
    methods:{
      logout(){
        localStorage.removeItem('user')
        localStorage.removeItem('token')
      },

    async LoginUser(e){
        e.preventDefault();
        const res = await fetch('http://localhost/RD_vy/user/login',{
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                email: this.email,
                password: this.password,
                })
            })
            const result = await res.json()
            const token = result.Token;
            
            let user = JSON.stringify(result.User);
            localStorage.setItem('token', token);
            localStorage.setItem('user', user);
            if(res.status == 200){
              window.location.replace('/')
            }
            // console.log(JSON.parse(localStorage.getItem('user')));

            return result
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
        margin-bottom: 5px;
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