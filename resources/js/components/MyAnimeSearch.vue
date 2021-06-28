<template>
  <div class="container mt-3">
      <h5>視聴済みアニメ検索</h5>
    <div>
      <label for="wathed_year" class="form-label">視聴完了時期</label><br>
      <input type="text"  name="year" id="watched_year" 
      placeholder="例:2015" v-model="keyword1">年
      <select name="season" id="season" v-model="keyword2">
        <option value="春">春</option>
        <option value="夏">夏</option>
        <option value="秋">秋</option>
        <option value="冬">冬</option>
      </select>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">タイトル</th>
          <th scope="col">放送時期</th>
          <th scope="col">メモ</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
export default {
  props: {
    endpoint: {
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
    search() {
      response = axios.get(this.endpoint, {
        params: {
          year: this.keyword1,
          season: this.keyword2,
        }
      })
    }
  },
}
</script>