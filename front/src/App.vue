<template>
<div class="container">
  
  <Header @toggle-add-task="toggleAddTask" title="RD_vy" :inputValue="inputValue" :showAddTasks="showAddTasks"/>
      <router-view :showAddTasks="showAddTasks" :showResult="showResult"></router-view>
  <Footer />
  </div>
</template>




<script>

import Header from './components/Header.vue'
import Footer from './components/Footer.vue'


export default {
  name:'App',
  props:{showTheshit:String},
  components:{
    Header,
    Footer
  },

  methods:{
    toggleAddTask(){
      this.showAddTasks=!this.showAddTasks;
    },
    showTheshit(){
      console.log(this.inputValue);
    }
  },
  data() {
    return {
      tasks:[],
      showAddTasks: false,
      showResult:false,
      inputValue:''
    }
  },

}
</script>

<style lang="scss">
*{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  
}
#app {
  display: flex;
  justify-content: center;
  width:100%;
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  transition: 0.5s;
  .container{
    border: 1px solid #b91b1b ;
    border-radius: 5px;
    padding: 10px;
    min-height:450px;
    min-width:300px;
  }
  .btn{
    border-radius: 3px;
    border: 2px solid #000;
    color: white;
    padding: 4px 10px;
    cursor: pointer;
}
}

</style>
