import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike'
import Search from './components/Search'
import WorkInformation from './components/WorkInformation'
import FollowButton from './components/FollowButton'
import MyAnimeSearch from './components/MyAnimeSearch'
import PostComment from './components/PostComment'

const app = new Vue({
  el:'#app',
  components: {
    PostLike,
    Search,
    WorkInformation,
    FollowButton,
    MyAnimeSearch,
    PostComment,
  }
})

