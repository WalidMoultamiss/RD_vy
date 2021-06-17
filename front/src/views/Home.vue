<template><div>
    <div v-show="showAddTasks">
    <AddTask @add-task="addTask" />
    </div>
    <div>
      <input class="dateInput" type="date" v-model="val" >
      &nbsp;&nbsp;
      <ButtonVue @click="showResult=true; fetchTasks()" :nameBtn="'search'" :color="'blue'" :border="'5px'" />
    </div>
    <br>
    <div v-if="showResult" class="result">
      <Tasks  @reserve="reserve" @date="date" @deleteMe="deleteMe" :tasks="tasks" />
    </div>
  </div>
</template>



<script>

import Tasks from '../components/Tasks'
import AddTask from '../components/AddTask'
import ButtonVue from '../components/ButtonVue';



export default{
    name:'Home',
    props:{
        showAddTasks: Boolean,
        showResult:Boolean,
        val:String
    },
    components:{
    Tasks,
    AddTask,
    ButtonVue
    },
    data(){
        return{
            tasks:[],
            logged:"",
            reloadMe:0
        }
    },
    beforeMount(){
      this.ifLogged()
    },
  methods:{
    value() {
        return this.val;
      },

    ifLogged(){
      let role = JSON.parse(localStorage.getItem('user'))
      if(!role){
        window.location.replace('login')
      }
      return role
    },
    async reserve(task){
      const dateInput = this.value()
      const slot = task.slot
      let token = localStorage.getItem('token')
      let bearer = 'bearer '+token
      let user = JSON.parse(localStorage.getItem('user'))
      let reference = user.reference
      if(confirm('are you sure the appointment is on?')){
        const res = await fetch('http://localhost/RD_vy/RDV/add',{
            method: 'POST',
            
            headers:{
              'Authorization': bearer,
              'Accept': 'application/json',
              'Content-Type': 'application/x-www-form-urlencoded'
        },
            body: JSON.stringify({
                      date:dateInput,
                      slot:task.slot,
                      reference:reference
                })
            })
            const result = await res.json()
            if(res.status == 200){
              await this.fetchTasks()
              this.reloadMe++
              console.log(task.slot);
            }

      }
},
    async deleteMe(task){
      console.log('clean');
      let token = localStorage.getItem('token')
      let bearer = 'bearer '+token
      if(confirm('are you sure the of deleting this appointment ?')){
        const res = await fetch('http://localhost/RD_vy/RDV/delete',{
            method: 'POST',
            
            headers:{
              'Authorization': bearer,
              'Accept': 'application/json',
              'Content-Type': 'application/x-www-form-urlencoded'
        },
            body: JSON.stringify({
                      id:task.id,
                })
            })
            const result = await res.json()
              console.log(result);
              await this.fetchTasks()
              this.reloadMe++
            

      }
},
    async bellOn(id){
      const taskToggle = await this.fetchTask(id.id)
      const updTask = {...taskToggle, reminder:!taskToggle.reminder}

      const res = await fetch(`api/tasks/${id.id}`,{
        method: 'PUT',
        headers: {
          'Content-type': 'application/json',
        }
        ,body: JSON.stringify(updTask)
      })
      const data = await res.json()
      
      this.tasks = this.tasks.map((task) => task.id === id.id ? { ...task, reminder: data.reminder} : task)
      

    }
    ,

    async addTask(task){
      const res = await fetch('api/tasks', {
        method:'POST',
        headers:{
          'Content-type':'application/json',
        },
        body: JSON.stringify(task)
      })

      const data = await res.json()
      this.tasks = [...this.tasks, data]
      },

  getDate(){
    console.log(this.value = this.value2)
  },

    // fetch
    async fetchTasks(){
      
      let dateInput = this.value(); 
      let token = localStorage.getItem('token')
     const res = await fetch(`http://localhost/RD_vy/RDV/RDVs/${dateInput}`, {
          method: 'post',
          headers: new Headers({
          'Authorization': 'bearer '+btoa(token),
          'Content-Type': 'application/x-www-form-urlencoded'
        }),
     });
      const data = await res.json()
      let arr = [1, 2, 3, 4].map((e, i) => data[i] || { slot: e - 1 });
      let result = arr.sort((a, b) => (a?.slot > b?.slot) ? 1 : -1).map((e,i)=>({...e,slot:i+1}))
      
      this.tasks= await result
      return result
    },

    async fetchTask(id){
      const res = await fetch(`api/tasks/${id}`)
      const data = await res.json()
    return data
    }


  },
  // async created(){
  //   this.tasks= await this.fetchTasks()
  // }
}


</script>

<style scoped lang="scss">
.result{
  min-height:260px;
}
  .dateInput{
    height: 28px;
    border-radius: 5px;
    border: 2px solid #fff;
    width: 65%;
    padding-left: 5px;
  }
</style>