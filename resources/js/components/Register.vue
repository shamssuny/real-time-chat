<template>
    <div>
        <Header></Header>
    <div class="row" style="margin-top: 5px">
        <div class="login-box col l4 offset-l4 m6 offset-m3 s12 card-panel" style="padding:20px;">
            <div class="card-panel blue darken-2 white-text">
                <h4 style="display: inline; margin: 0;padding: 0;">Register Here... </h4>
                <p>Choose your quick and cute nickname and join :D</p>
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
                <button @click="register" class="blue darken-2 waves-effect waves-light btn-large">Register <i class="material-icons right">send</i></button>
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
        name: "Register",
        components:{
            Header
        },
        data(){
            return {
                username:'',
                password:'',
                loaderActive:false
            };
        },
        methods:{
            register(){
                if(this.username!='' || this.password != ''){
                    var vm = this;
                    this.loaderActive = true;
                    axios.post('/register',{
                        username:this.username,
                        password:this.password
                    }).then(function(response){
                        if(response.data.message == 'success'){
                            vm.$toaster.success('Register Success. Login to Continue!!',{timeout:5000});
                            vm.$router.replace({path:'/'});
                        }
                        // console.log(response);
                        vm.loaderActive = false;
                    }).catch(function(error){
                        if(error.response.data.errors.username !=''){
                            vm.$toaster.warning('Username Already Taken!!',{timeout:3000});
                        }
                        vm.loaderActive = false;
                        // M.toast({html: 'Something Went Wrong', classes: 'rounded'});
                    });

                }else{
                    this.$toaster.error('Fields Can not be Empty!!');
                }
            }
        }
    }
</script>

<style scoped>

</style>