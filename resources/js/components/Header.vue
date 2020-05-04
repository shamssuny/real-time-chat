<template>
    <div>

        <nav>
            <div class="nav-wrapper indigo">
                <router-link to="/" class="brand-logo left">Blind Chat</router-link>
                <ul v-if="logData==null" class="right">
                    <li><router-link to="/">Login</router-link></li>
                    <li><router-link to="/register">Register</router-link></li>
                </ul>
                <ul v-else class="right">
                    <li>Welcome( {{ logData }} )</li>
                    <li class="c_btn"><i class="material-icons" @click="logout">exit_to_app</i></li>
                </ul>
            </div>
        </nav>



    </div>
</template>

<script>
    export default {
        name: "Header",
        props:['logData'],
        data(){
            return {
                lastData:''
            };
        },
        created() {
            // if(localStorage){
            //     if(localStorage.getItem('loggedUserName')){
            //         this.lastData = localStorage.getItem('loggedUserName');
            //     }
            // }
        },
        methods:{
            logout(){
                if(localStorage){
                    localStorage.removeItem('chatKey');
                    localStorage.removeItem('loggedUserName');
                    this.$router.replace({path:'/'});
                    this.$toaster.info('Logged Out!',{timeout:3000});
                }
            }
        }
    }
</script>

<style scoped>
    .c_btn{
        padding-left: 10px;
        padding-right: 10px;
    }
.c_btn:hover{
    cursor: pointer;
}
</style>