<template>
<div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="card-text">
          <form @submit.prevent="post_comment">
            <div class="form-group">
              <textarea name="body" required rows="5" placeholder="感想へコメントしよう" 
              class="form-control" v-model="comment"></textarea>
            </div>
            <div style="text-align:right">
              <button type="submit" class="btn ripe-malinka-gradient ml-auto" style="color: aliceblue">送信</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div v-for="comment in current_comments" v-bind:key="comment.id">
      <div class="card mt-3">
        <div class="card-body d-flex flew-row ">
          <a :href="'/users/' + comment.user.name" class="text-dark" style="display: inline">
            <img :src="comment.user.profile_image " alt="画像" width="30px" height="30px" style="border-radius: 50%">
            <p>{{ comment.user.name }}</p>
          </a>
          <div class="d-flex ml-3" style="align-items:center">
            <p style="white-space:pre-wrap; word-wrap:break-word;">{{ comment.body }}</p>
          </div>
          <div style="text-align:right;margin-left:auto" v-if="user_check(comment.user_id)">
            <a @click="delete_comment(comment.id)"><i class="fas fa-trash"></i></a>
          </div>

        </div>
      </div>

    </div>
</div>

</template>

<script>
export default {
  props: {
    comments: {
      type: Array,
    },
    endpoint: {
      type: String
    },
    authId: {
      type: Number
    }
  },
  data() {
    return {
      current_comments: this.comments,
      post_url: this.endpoint,
      comment:'',
      auth_id: String(this.authId)
    }
  },
  methods: {
    async post_comment() {
      await axios.post(this.post_url, {
        body: this.comment
      })
      .then(res => {
        this.current_comments = res.data
        this.comment = null
      })
      .catch(err => {
        console.log(err.statusText)
      })
    },
    async delete_comment(comment_id) {
      if (confirm('本当に削除していいですか？')) {
        await axios.delete(this.endpoint + '/' + comment_id)
        .then(res => {
          this.current_comments = res.data
        })
    }

  },
  user_check(user_id) {
    if (this.auth_id == user_id) {
      return true
    }
    else
    return false
  },
},
}
</script>