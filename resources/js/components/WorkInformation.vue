<template>
<div>
<div v-for="work in work" v-bind:key="work.id">
  <div class="card">
    <img v-bind:src="work.images.recommended_url" alt="アニメ画像" width="50%" height="auto">
    <div class="card-body">
      <h4 class="card-title">{{ work.title }}</h4>
      <p class="card-text">{{ work.watchers_count }}人視聴</p>
      <a href="#" class="btn btn-primary">お気に入りに登録</a>
    </div>
  </div>
  </div>

</div>


</template>

<script>
export default {
  props: {
    workId: {
      type: String,
    },
    token: {
      type: String,
    }
  },
  data() {
    return {
      work: null,
      url: 'https://api.annict.com/v1/works?access_token=' + this.token,
    }
  },
  created() {
    const queries = {filter_ids: this.workId, fields: "id,title,images,season_name_text,watchers_count"}
    axios.get(this.url, {params: queries})
    .then(res => {
      this.work = res.data.works
    })
    .catch(err => {
      console.log(err.statusText)
    });
  },
}
</script>