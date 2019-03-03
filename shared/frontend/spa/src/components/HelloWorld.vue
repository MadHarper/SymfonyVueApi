<template>
  <div class="hello">
    <h1>{{ status }}</h1>
    <p>
      For a guide and recipes on how to configure / customize this project,<br>
      check out the
      <a href="https://cli.vuejs.org" target="_blank" rel="noopener">vue-cli documentation</a>.
    </p>
    <h3>Installed CLI Plugins</h3>
    <ul>
      <li><a href="https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-babel" target="_blank" rel="noopener">babel</a></li>
      <li><a href="https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-eslint" target="_blank" rel="noopener">eslint</a></li>
    </ul>
    <h3>Essential Links</h3>
    <div class="alert alert-primary" role="alert">
      A simple primary alert—check it out!
    </div>
    <ul>
      <li><a href="https://forum.vuejs.org" target="_blank" rel="noopener">Forum</a></li>
      <li><a href="https://chat.vuejs.org" target="_blank" rel="noopener">Community Chat</a></li>
      <li><a href="https://twitter.com/vuejs" target="_blank" rel="noopener">Twitter</a></li>
      <li><a href="https://news.vuejs.org" target="_blank" rel="noopener">News</a></li>
    </ul>
    <h3>Ecosystem</h3>
    <ul>
      <li v-for="item in items" :key="item.id" :id="item.id" @click="clickItem(`${item.id}`)">
        <a href="#">{{ item.name }}</a>
        <p>Birth day: {{ convertBD(item.bithday) }}</p>
      </li>
    </ul>

    <select v-model="selected">
      <option disabled value="">Выберите один из вариантов</option>
      <option>А</option>
      <option>Б</option>
      <option>В</option>
    </select>
    <span>Выбрано: {{ selected }}</span>
  </div>

</template>

<script>
//import axios from 'axios';
// используем предварительно настроенный axios
//import {HTTP} from '../helpers/http'

export default {
  name: 'HelloWorld',
  props: {
    propA: Number,
    msg: String
  },
  data() {
      return {
          status: null,
          someId: 36,
          items: [
              {id: 5, name: "John", bithday: 100},
              {id: 12, name: "Mary", bithday: 300},
              {id: 28, name: "Sancho", bithday: 500},
              {id: 3, name: "Marcus", bithday: 400}
          ],
          selected: null
      };
  },
  mounted(){
          this.init();
  },
  methods: {
      init() {
          this.$axios.get('spa')
          //.then(res => console.log(res));
          .then(res => (this.status = res.data.status))
          .catch(err => console.log("Поймал ошибку", err))

      },
      clickItem(id) {
          console.log("Click Item id - ", id);
      },
      convertBD(date) {
          return date + 1;
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
