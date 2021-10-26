<template>
  <div>
    <div style="height:400px;overflow-y: scroll;">
      <div v-for="message in this.messages" :key="message.index">
          <div class="balloon-chat right" v-if="user_check(message.user.id)">
            <figure class="icon-img"><img :src="message.user.profile_image" width="40px" height="40px">
              <figcaption class="icon-name">{{ message.user.name }}</figcaption>
            </figure>
            <div class="chatting">
              <p class="chat-text">{{ message.content }}</p>
            </div>
          </div>
          <div class="balloon-chat left" v-else>
            <figure class="icon-img"><img :src="message.user.profile_image" width="40px" height="40px">
              <figcaption class="icon-name">{{ message.user.name }}</figcaption>
            </figure>
            <div class="chatting">
              <p class="chat-text">{{ message.content }}</p>
            </div>
          </div>
      </div>
    </div>
          <form @submit.prevent="send" class="mt-auto">
      <div class="input-group">
        <input type="text" class="form-control"
          aria-describedby="button-addon2"
          required
          v-model="message">
        <div class="input-group-append">
          <button type="submit" class="btn btn-md btn-outline-default m-0 px-3 py-2 z-depth-0 waves-effect" id="button-addon2">送信</button>
        </div>
      </div>
    </form>
  </div>

</template>
<style scoped>
.balloon-chat {
display: flex;
flex-wrap: wrap;
}
/* 左の吹き出し */
.balloon-chat.left { 
flex-direction: row; /* 左から右に並べる */
}
/* 右の吹き出し */
.balloon-chat.right { 
flex-direction: row-reverse; /* 右から左に並べる */
}
/* 吹き出しの入力部分の作成 */
.chatting {
position: relative;
display: inline-block; /* 吹き出しが文字幅に合わせます */
margin: 10px 20px;
padding: 5px 20px;
background: #ccffcc; /*吹き出しのカラーはここで変更*/
text-align: left; /*テキストの位置はここで変更*/
border-radius: 12px; /*吹き出しの丸み具合を変更*/
max-width: 70%;
}
/* 吹き出しの三角部分の作成 */
.chatting::after {
content: "";
border: 15px solid transparent;
border-top-color: #ccffcc; /*カラーはここで変更（吹き出し部分と合わせる）*/
position: absolute;
top: 10px; /*三角部分の高さを変更*/
}
.left .chatting::after {
left: -15px; /*左側の三角部分の位置を変更*/
}
.right .chatting::after {
right: -15px; /*右側の三角部分の位置を変更*/
} 
/* アイコンの作成 */
.balloon-chat figure img {
border-radius: 50%; /*丸の設定*/
border: 2px solid #333300; /*アイコンの枠のカラーと太さはここで変更*/
margin: 0;
}
/* アイコンの大きさ */
.icon-img {
width: 80px;
height: 80px;
}
/* アイコンの名前の設定 */
.icon-name {
width: 40px; /* アイコンの大きさと合わせる */
font-size: 12px;
text-align: center;
}
</style>
<script>
export default {
  props: {
    authId: String,
    chatMessages: Array,
    roomId: String
  },
  data() {
    return {
      message:'',
      messages: this.chatMessages,
      auth_id: this.authId,
      room_id: this.roomId
    }
  },
  methods: {
    async send(){
      await axios.post('/chats', {
        content: this.message,
        user_id: this.auth_id,
        room_id: this.room_id
      })
      .then(res => {
        this.messages = res.data
        this.message = ''
      })
      .catch(err => {
        console.log(err.statusText)
      })
    },
    user_check(user_id) {
      if (this.auth_id == user_id) {
        return true
      }
      else
        return false
      }
  }

}
</script>