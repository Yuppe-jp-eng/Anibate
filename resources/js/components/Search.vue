<template>
  <div class="container">
    <div class="input-group md-form form-sm form-1 pl-0">
      <div class="input-group-prepend">
        <span class="input-group-text pink lighten-3" id="basix-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
      </div>
      <input type="text" class="form-control my-0 py-1" placeholder="アニメ検索" aria-label="アニメ検索"
      v-model="keyword" @keyup.enter="search">
    </div>
    <div>
      <button type="button" class="btn btn-sm" style="margin:0"
      :class="{'ripe-malinka-gradient': this.option1, 'text-white': this.option1}" @click="getLastSeasonWorks">2022冬</button>
      <button type="button" class="btn btn-sm" style="margin:0"
      :class="{'ripe-malinka-gradient': this.option2, 'text-white': this.option2}" @click="getThisSeasonWorks">2022春</button>
    </div>
      <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">タイトル</th>
          <th scope="col">エピソード数</th>
          <th scope="col">視聴者数</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody v-for="work in works" :key="work.id">
        <tr>
          <td style="width:50%;white-space:pre-wrap;word-wrap:break-word;">
            {{ work.title }}
          </td>
          <td>全{{ work.episodes_count }}話</td>
          <td>{{ work.watchers_count }}人</td>
          <td>
            <a :href="'/works/' + work.title + '/?id=' + work.id">
              <button type="button" class="btn btn-sm ripe-malinka-gradient" style="color:white;border-radius:70%">詳細</button>
            </a>
          </td>
        </tr>
      </tbody>
    </table>

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
      const queries = {filter_title: this.keyword, fields: "id,title,episodes_count,watchers_count"}
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
      const queries = {filter_season: "2022-winter", sort_watchers_count: "desc", per_page: 50, fields: "id,title,episodes_count,watchers_count"}
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
      const queries = {filter_season: "2022-spring", sort_watchers_count: "desc", per_page: 50, fields: "id,title,episodes_count,watchers_count"}
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