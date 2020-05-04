<template>
    <div>
        <Header v-bind:logData="loggedUser"></Header>
    <div class="row">
        <div class="col l6 offset-l3 m8 offset-m2 s12">

            <div class="collection-header blue darken-2 white-text" style="padding: 15px;margin-top: 8px"><h4>Go on . . .</h4></div>

            <ul class="collection with-header chat" v-chat-scroll>
                <li v-for="(msg, index) in chatData" class="collection-item chat-scroll" :style="{ 'background-color': chatColors[index] }" >{{ msg }}<span class="new badge" data-badge-caption="">{{ chatUsers[index] }}</span></li>

            </ul>
            <div class="input-field">
                <input required style="display: inline;width: 80%;" @keypress.enter="sendData" v-model="message" id="msg" type="text" class="validate"><button @click="sendData" style="display: inline;" class="btn waves-effect waves-light" name="action"><i class="material-icons">send</i></button>
                <label for="msg">Type Something . . .</label>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    require('../bootstrap');
    import axios from 'axios';
    import Header from './Header'
    window.Pusher = require('pusher-js');
    export default {
        name: "Chat",
        components:{
            Header
        },
        data(){
            return {
                message:'',
                chatData:[],
                chatUsers:[],
                chatColors:[],
                loggedUser:'',
                loggedUserId: '',
            };
        },
        methods:{
            sendData(){
                if(this.message != ''){
                    var vm = this;
                    axios.post('/chat-send',{
                        message:this.message,
                        socketId:Echo.socketId(),
                        userName: vm.loggedUser,
                        userId: vm.loggedUserId
                    })
                        .catch(function (error) {
                            console.log(error);
                        });
                    this.chatData.push(this.message);
                    this.chatUsers.push(this.loggedUser);
                    this.chatColors.push('lightblue');
                    this.message='';
                }else{
                    this.$toaster.error('Give some message bro !',{timeout:2000});
                }
            }
        },
        mounted() {


            if(localStorage){
                if(localStorage.getItem('chatKey') == ''){
                    this.$router.replace({path:'/'});
                    this.$toaster.error('You need to login before!',{timeout:3000});
                }else{
                    var vm = this;
                    var userKey = localStorage.getItem('chatKey');
                    axios.post('/authenticate',{
                        token: userKey
                    }).then(function (response) {
                        // console.log(response);
                        if(response.data.user.username != ''){
                            vm.loggedUser = response.data.user.username;
                            vm.loggedUserId = response.data.user.id;
                            localStorage.setItem('loggedUserName',vm.loggedUser);
                            // console.log(response.data.user.username);
                        }else{
                            vm.$router.replace({path:'/'});
                            vm.$toaster.error('You need to login before!',{timeout:3000});
                        }
                    }).catch(function (error) {
                        // console.log(error.response);
                        vm.$router.replace({path:'/'});
                        vm.$toaster.error('You need to login before!',{timeout:3000});
                    });
                }
            }

            window.Echo.channel('chatting')
                .listen('ChatSend', (e) => {
                    // console.log(e.socketId+"||"+Echo.socketId());
                    if(e.socketId != Echo.socketId()){
                        this.chatData.push(e.message);
                        this.chatUsers.push(e.userName);
                        this.chatColors.push('#fff3e0');
                    }
                });


        },
        created() {

        }

    }
</script>

<style scoped>
    .chat{
        overflow-x: hidden;
        overflow-y: scroll;
        height: 50vh;
    }
    .chat-scroll{
        margin-top: 3px;
    }
</style>