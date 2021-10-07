<template>
    <div class="chat">
        <h1 class="headline">Chat Box</h1>

        <main id="app">
            <section ref="chatArea" class="chat-area">
                <p
                    v-for="message in updateMessages"
                    class="message"
                    :class="
                        message.sender_id == id ? 'message-in' : 'message-out'
                    "
                >
                    {{ message.text }}
                </p>
                <form @submit.prevent="sendMessage()" id="person2-form">
                    <label for="person2-input">You</label>
                    <input
                        v-model="youMessage"
                        id="person2-input"
                        type="text"
                        class=""
                        placeholder="Type your message"
                    />
                    <button type="submit">Send</button>
                </form>
            </section>

            <section class="chat-inputs"></section>
        </main>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "Chat-Show",
    props: {
        id: String,
        messages: Array
    },
    data() {
        return {
            youMessage: "",
            updateMessages: this.messages,
            updateHight: ""
        };
    },
    methods: {
        sendMessage() {
            if (!this.youMessage) {
                return;
            } else {
                axios
                    .post("/chat", {
                        id: this.id,
                        text: this.youMessage
                    })
                    .then(response => {
                        this.updateMessages = response.data;
                    });

                this.youMessage = "";
            }
        },
        readReceipts() {
            var oldHight = this.updateHight;
            var content = this.$refs.chatArea;
            this.updateHight = content.scrollHeight;
            if (this.updateHight - oldHight) {
                console.log("gjhadgfh");
                axios.put("/chat/" + this.id, {
                    id: this.messages[0].conversation_id
                });
            }
        },

        intervalFetchData: function() {
            setInterval(() => {
                axios
                    .post("/chat", {
                        id: this.id
                    })
                    .then(response => {
                        this.updateMessages = response.data;
                    });
            }, 5000);
        }
    },
    mounted() {
        this.intervalFetchData();
        Vue.nextTick(() => {
            let messageDisplay = this.$refs.chatArea;
            messageDisplay.scrollTop = messageDisplay.scrollHeight;
        });
        this.readReceipts();
    },
    updated() {
        this.$nextTick(() => this.readReceipts());
    }
};
</script>
<style>
.chat {
    font-family: sans-serif;
    font-weight: 100;
    background: #7b4397; /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #dc2430, #7b4397);
    background: linear-gradient(to right, #dc2430, #7b4397);
}

.headline {
    text-align: center;
    font-weight: 100;
    color: white;
}
.chat-area {
    /*   border: 1px solid #ccc; */
    background: white;
    height: 50vh;
    padding: 1em;
    overflow: auto;
    max-width: 350px;
    margin: 0 auto 2em auto;
    box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.3);
}
.message {
    width: 45%;
    border-radius: 10px;
    padding: 0.5em;
    /*   margin-bottom: .5em; */
    font-size: 0.8em;
}
.message-out {
    background: #407fff;
    color: white;
    margin-left: 50%;
}
.message-in {
    background: #f1f0f0;
    color: black;
    margin-right: 50%;
}
.chat-inputs {
    display: flex;
    justify-content: space-between;
}
#person1-input {
    padding: 0.5em;
}
#person2-input {
    padding: 0.5em;
}
</style>
