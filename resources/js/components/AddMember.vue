<template>
  <div>
    <div class="added-user"></div>
    <div class="follow-users">
      <h4>フォロー中</h4>

    </div>
  </div>
</template>

<script>
export default {
  props: {
    userList: {
      type: Array,
    }
  }
}
</script>