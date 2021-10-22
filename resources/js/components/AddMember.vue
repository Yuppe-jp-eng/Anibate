<template>
  <div class="mt-5">
    <h5>メンバー候補</h5>
    <div class="added-user d-flex flex-row">
      <div class="selected-users pr-3" v-for="s_user in selectedUsers" :key="s_user.id" style="text-align:center">
        <img :src="s_user.profile_image" width="40px" height="40px" style="border-radius: 50%">
        <p>{{ s_user.name }}</p>
      </div>
    </div>
    <div class="followings mb-4">
      <h5>フォロー中</h5>
      <div class="user-card d-flex flex-row" v-for="user in followings" :key="user.id">
        <a :href="'/users/' + user.name" class="text-dark pr-3" style="display: inline">
          <img :src="user.profile_image" width="60px" height="60px" style="border-radius: 50%">
        </a>
        <p>{{ user.name }}</p>
        <div class="ml-auto">
          <input type="checkbox" :id="user.name" style="display:inline-block;"
          name="'user_id[]'" :value="user.id" v-model="checkedUserIds"
          @click="clickMember(user)"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    userList: {
      type: Array,
    }
  },
  data() {
    return {
      followings: this.userList,
      checkedUserIds: [],
      selectedUsers: []
    }
  },
  methods: {
    clickMember(user) {
      // クリックしたユーザーが既に選択されているか
      if (this.checkedUserIds.includes(user.id)) {
        //該当ユーザーを選択メンバーから削除
        this.selectedUsers.forEach((s_user, i) => {
          if (user.id == s_user.id) {
            this.selectedUsers.splice(i, 1)
          }
        });
      } else {
        //該当ユーザーを選択メンバーへ追加
        this.selectedUsers.push(user)
        this.checkedUserIds.push(user.id)
      }
    }
  },
}
</script>