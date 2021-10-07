<template>
    <div class="message-list">
        <h4>Messages</h4>
        <hr />
        <div id="chat-messages" class="message-group">
            <div class="message" v-for="(chat, index) in chats" :key="index">
                <a :href="/chat/ + chat.sender_id">
                    <div class="clearfix">
                        <h4 class="message-title">{{ chat.user.name }}</h4>
                        <small class="text-muted float-right"
                            >@{{ chat.created_at }}</small
                        >
                    </div>
                    <p class="message-text">
                        {{ chat.text }}
                        <p class="text-muted float-right  alert-danger ">
                        {{ chat.notifications }}
                    </p>
                    </p>
                    
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: {
        chats: Array
    }
};
</script>

<style>
.message-list {
    margin-bottom: 15px;
    padding-right: 15px;
}
.message-group {
    height: 65vh !important;
    overflow-y: scroll;
}
.message {
    border: 1px solid lightblue;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 15px;
}
.message-title {
    font-size: 1rem;
    display: inline;
}
.message-text {
    color: gray;
    margin-bottom: 0;
}
.user-typing {
    height: 1rem;
}
</style>
