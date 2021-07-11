<template>
  <div class="container">
    <div class="input-group md-form form-sm form-1 pl-0">
      <div class="input-group-prepend">
        <span class="input-group-text pink lighten-3" id="basix-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
      </div>
      <input type="text" class="form-control my-0 py-1" placeholder="アニメ検索" aria-label="アニメ検索"
      v-model="keyword" v-on:keyup.enter="search">
    </div>
    <div style="text-align:right">
      <button class="btn ripe-malinka-gradient" v-on:click="getThisSeasonWorks" style="color:white">今期アニメ</button>
    </div>
    <div class="row mt-4">
    <div v-for="work in works" v-bind:key="work.id" style="display:inline-block; text-align:center" class="col-md-4 col-sm-5 offset-sm-1 mb-3">
      <img v-bind:src="work.images.recommended_url" width="200px" height="auto" style="display:inline-block">
      <br/>
      <a v-bind:href="'/works/' + work.title + '/?id=' + work.id" style="white-space:pre-wrap;word-wrap:break-word;display:inline-block; width:100%" >{{ work.title }}</a>
    </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    token: {
      type: String,
    },
  },
  data() {
    return {
      works: null,
      keyword: '',
      noworks:false,
      url: 'https://api.annict.com/v1/works?access_token=' + this.token,
    }
  },
  methods: {
    async search() {
      this.noworks = false
      const queries = {filter_title: this.keyword}
      await axios.get(this.url, {params: queries})
      .then(res => {
        this.works = res.data.works
      })
      .catch(err => {
        console.log(err.message)
      });
    },
     async getThisSeasonWorks() {
      this.works = null
      const queries = {filter_season: "2021-summer", sort_watchers_count: "desc", per_page: 50}
      await axios.get(this.url, {params: queries})
      .then(res => {
        this.works = res.data.works
      })
      .catch(err => {
        console.log(err.message)
      });
    }
  },
}
</script>