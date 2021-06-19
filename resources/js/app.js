import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike'
import Search from './components/Search'
import WorkInformation from './components/WorkInformation'

const app = new Vue({
  el:'#app',
  components: {
    PostLike,
    Search,
    WorkInformation,
  }
})

