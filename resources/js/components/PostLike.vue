<template>
  <div>
    <button type="button" class="btn m-0 p-1 shadow-none">
      <i class="fas fa-heart mr-1"
      :class="{'red-text':this.isLikedBy, 'animated bounce' :this.gotLike}"
      @click="clickLike"
      />
    </button>
    {{ countLikes }}
  </div>
</template>

<script>
export default {
  props: {
    initialIsLikedBy: {
      type: Boolean,
      default: false,
    },
    initialCountLikes: {
      type: Number,
      default: 0,
    },
    authorized: {
      type: Boolean,
      default: false,
    },
    endpoint: {
      type: String,
    },
  },
  data(){
    return {
      isLikedBy: this.initialIsLikedBy,
      countLikes: this.initialCountLikes,
      gotLike: false,
    }
  },
  methods: {
    clickLike() {
      if(!this.authorized) {
        alert('いいねはログイン中のユーザーしかできません。')
        return
      }
      this.isLikedBy
      ? this.unlike()
      : this.like()
    },
    async like() {
      const response = await axios.put(this.endpoint)
      this.isLikedBy = true
      this.gotLike = true
      this.countLikes = response.data.countLikes
      },
    async unlike() {
      const response = await axios.delete(this.endpoint)
      this.isLikedBy = false
      this.gotLike =false
      this.countLikes = response.data.countLikes
    },
  },
}
</script>