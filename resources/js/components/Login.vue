<template>
    <div>
    <Header></Header>
    <div class="row" style="margin-top: 5px">
        <div class="login-box col l4 offset-l4 m6 offset-m3 s12 card-panel" style="padding:20px;">
            <div class="card-panel blue darken-2 white-text">
                <h4 style="display: inline; margin: 0;padding: 0;">Login Here... </h4><br><p>to Begin Anonymous Chatting Fun ;)</p>
            </div>
            <div class="">
                <div class="input-field">
                    <input v-model="username" id="username" type="text" name="username" class="validate">
                    <label for="username">Your Username</label>
                </div>
                <div class="input-field">
                    <input v-model="password" id="password" type="password" name="password" class="validate">
                    <label for="password">Your Password</label>
                </div>
                <button @click="login" class="blue darken-2 waves-effect waves-light btn-large">Let's Go <i class="material-icons right">send</i></button>
                <p><b>Want to join? </b><i><router-link to="/register">Click Here.</router-link></i></p>
                <div v-if="loaderActive" class="progress">
                    <div class="indeterminate"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import Header from './Header'
    export default {
        name: "Login",
        components:{
            Header
        },
        data(){
            return {
                username:'',
                password:'',
                loaderActive: false
            };
        },
        methods:{
            login(){
                var vm = this;
                if(this.username != '' || this.password != ''){
                    this.loaderActive = true;
                    axios.post('/login',{
                        username: this.username,
                        password: this.password
                    }).then(function (response) {
                        // console.log(response);
                        if(response.data.message == 'success'){
                            if(localStorage){
                                localStorage.setItem('chatKey',response.data.token.token);
                                // console.log(localStorage.getItem('chatKey'));
                                vm.$router.replace({path:'/chat'});
                                vm.$toaster.success('Login Success :)',{timeout:3000});

                            }else {
                                vm.$toaster.info('Error in your Local Device',{timeout:3000});
                            }
                        }else {
                            vm.$toaster.info('something went wrong',{timeout:3000});
                        }
                        vm.loaderActive = false;
                    }).catch(function (error) {
                        if(error.response.data.error != ''){
                            vm.$toaster.error(error.response.data.error,{timeout:3000});
                        }
                        vm.loaderActive = false;

                    });
                }else{
                    this.$toaster.error('Fields Can not be Empty!!');
                }
            }
        },

        mounted() {

        }
    }
</script>

<style scoped>

</style>