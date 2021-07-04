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
      <p>{{ comment.body }}</p>
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
    auth_id: {
      type: Number
    }
  },
  data() {
    return {
      current_comments: this.comments,
      post_url: this.endpoint,
      comment:'',
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
    }
  },
}
</script>