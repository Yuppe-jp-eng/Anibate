import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike'
import Search from './components/Search'

const app = new Vue({
  el:'#app',
  components: {
    PostLike,
    Search,
  }
})

