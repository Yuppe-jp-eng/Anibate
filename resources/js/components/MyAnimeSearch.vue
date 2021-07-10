<template>
  <div class="container mt-3">
    <h5>視聴済みアニメ検索</h5>
    <div>
      <label for="wathed_year" class="form-label">視聴完了時期</label><br>
      <input type="text"  name="year" id="watched_year" 
      placeholder="例:2015" v-model="keyword1">年
      <select name="season" id="season" v-model="keyword2" v-on:keyup.enter="search">
        <option value="春">春</option>
        <option value="夏">夏</option>
        <option value="秋">秋</option>
        <option value="冬">冬</option>
      </select>
      <input type="button" value="検索"  v-on:click="search" class="ml-3">
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">タイトル</th>
          <th scope="col">放送時期</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody v-for="work in works" v-bind:key="work.id">
        <tr>
          <td><p>{{ work.title }}</p></td>
          <td>{{ work.broadcast_season }}</td>
          <td>
            <div class="ml-auto card-text" v-if="work.memo !== null">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-align-justify"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="width:100%;word-wrap:break-word">
                  <p style="white-space:pre-wrap; word-wrap:break-word;">{{ work.memo }}</p>
                </div>
              </div>
            </div>
          </td>
          <td><a><i class="fas fa-trash" v-on:click="delete_anime(work.id)"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
export default {
  props: {
    search_endpoint: {
      type: String,
    }
  },
  data() {
    return {
      works: null,
      keyword1: '',
      keyword2: '',
    }
  },
  methods: {
    async search() {
      this.works = null
      await axios.get(this.search_endpoint, {
        params: {
          year: this.keyword1,
          season: this.keyword2,
        }
      })
      .then(res => {
        this.works = res.data
      })
    },
    async delete_anime(work_id) {
      if (confirm('本当に削除していいですか？')) {
        await axios.delete('/users/' + work_id)
        .then(res => {
          this.works = res.data
        })

      }

    },
  },
}
</script>