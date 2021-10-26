import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike'
import Search from './components/Search'
import WorkInformation from './components/WorkInformation'
import FollowButton from './components/FollowButton'
import MyAnimeSearch from './components/MyAnimeSearch'
import PostComment from './components/PostComment'
import AddMember from './components/AddMember'
import Chat from './components/Chat'

const app = new Vue({
  el:'#app',
  components: {
    PostLike,
    Search,
    WorkInformation,
    FollowButton,
    MyAnimeSearch,
    PostComment,
    AddMember,
    Chat
  }
})

