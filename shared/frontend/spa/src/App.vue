<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link>
      <span> | </span>
      <router-link to="/users">Users</router-link>
    </div>
    <img alt="Vue logo" src="./assets/logo.png">
    <router-view/>


    <!--
      <HelloWorld msg="Welcome to Your Vue.js App"/>
      <Users />
      <Table />
    -->

  </div>
</template>

<script>
//import HelloWorld from './components/HelloWorld.vue'
//import Table from './components/Table.vue'
//import Users from './components/users/Users.vue'

export default {
  name: 'app',
  mounted() {
    window.console.log("mounted App component");
  },
  components: {
//    HelloWorld,
//    Users,
//    Table
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
