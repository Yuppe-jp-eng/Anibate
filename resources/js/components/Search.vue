<template>
  <div class="container">
    <div class="input-group md-form form-sm form-1 pl-0">
      <div class="input-group-prepend">
        <span class="input-group-text pink lighten-3" id="basix-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
      </div>
      <input type="text" class="form-control my-0 py-1" placeholder="アニメ検索" aria-label="アニメ検索"
      v-model="keyword" v-on:keyup.enter="search">
    </div>
    <div>
      <button type="button" class="btn btn-sm" style="margin:0"
      :class="{'ripe-malinka-gradient': this.option1, 'text-white': this.option1}" v-on:click="getLastSeasonWorks">2021春</button>
      <button type="button" class="btn btn-sm" style="margin:0"
      :class="{'ripe-malinka-gradient': this.option2, 'text-white': this.option2}" v-on:click="getThisSeasonWorks">2021夏</button>
    </div>
    <div class="row mt-4">
    <div v-for="work in works" v-bind:key="work.id" style="display:inline-block; text-align:center" class="col-md-4 col-sm-5 offset-sm-1 mb-3">
      <br/>
      <a v-bind:href="'/works/' + work.title + '/?id=' + work.id" style="white-space:pre-wrap;word-wrap:break-word;display:inline-block; width:100%" >
      <img v-bind:src="work.images.recommended_url" width="200px" height="auto" style="display:inline-block">
      {{ work.title }}</a>
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
      // 前期アニメ
      option1: false,
      // 今季アニメ
      option2: false,
      // 登録済みアニメ
      option3: false,
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
      this.option1 = this.option2 = this.option3 = false
    },
    async getLastSeasonWorks() {
      const queries = {filter_season: "2021-spring", sort_watchers_count: "desc", per_page: 50}
      await axios.get(this.url, {params: queries})
      .then(res => {
        this.works = res.data.works
      })
      .catch(err => {
        console.log(err.message)
      });
      this.option1 = true
      this.option2 = this.option3 = false
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
      this.option2 = true
      this.option1 = this.option3 = false

    },

  },
}
</script>