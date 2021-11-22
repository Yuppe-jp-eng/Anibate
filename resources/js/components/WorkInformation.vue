<template>
<div>
<div v-for="work in work" v-bind:key="work.id">
  <div class="row">
    <div class="col-md-5 col-sm-12">
      <!-- <img :src="work.images.recommended_url" alt="アニメ画像" width="100%" height="auto"> -->
      <h3>{{ work.title }}</h3>
      <p>{{ work.watchers_count }}人視聴</p>
      <a :href="work.official_site_url" target="_blank" rel="noopener noreferrer" class="mb-3">公式サイト</a><br>
      <a :href="work.wikipedia_url" target="_blank" rel="noopener noreferrer">Wikipedia</a>
      <div class="d-flex mt-3">
        <a :href="'/works/create?title=' + work.title + '&season=' + work.season_name_text" class="btn btn-primary">Myアニメに登録</a>
        <a :href="'/posts/create?title=' + work.title" class="btn btn-danger">感想を投稿する！</a>
      </div>

    </div>
    <div class="col-md-7 col-sm-12 row mt-3">
      <div class="col-md-4 col-sm-4 mb-3"  v-for="episode in episodes" :key="episode.id">
        {{ episode.number_text }}<br><a v-bind:href="'/posts/create?title=' + work.title + '&episode=' + episode.number_text.replace('#', '＃') + episode.title">{{ episode.title }}</a>
      </div>
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
      episodes: null,
      staffs: null,
      works_url: 'https://api.annict.com/v1/works?access_token=' + this.token,
      episodes_url: 'https://api.annict.com/v1/episodes?access_token=' + this.token,
      staffs_url: 'https://api.annict.com/v1/staffs?access_token=' + this.token,
    }
  },
  created() {

    // 作品取得
    const queries1 = {filter_ids: this.workId, fields: "id,title,images,season_name_text,watchers_count,wikipedia_url,official_site_url"}
    axios.get(this.works_url, {params: queries1})
    .then(res => {
      this.work = res.data.works
    })
    .catch(err => {
      console.log(err.statusText)
    });
    // エピソード取得
    const queries2 = {filter_work_id: this.workId, sort_id: "desc"}
    axios.get(this.episodes_url, {params: queries2})
    .then(res => {
      this.episodes = res.data.episodes
    })
    .catch(err => {
      console.log(err.statusText)
    });
    // const queries3 = {filter_work_id: this.workId}
    // axios.get(this.staffs_url, {params: queries3})
    // .then(res => {
    //   this.staffs = res.data.staffs
    // })
    // .catch(err => {
    //   console.log(err.statusText)
    // });
  },
}
</script>