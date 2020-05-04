<template>
    <div>
        <div class="row">
            <vue-page-transition name="overlay-up-down">
                <router-view></router-view>
            </vue-page-transition>
        </div>
    </div>
</template>

<script>

    export default {
        name: "App",
        components:{

        }
        ,
        data(){
          return {

          };
        },
        mounted() {

        },
        methods:{

        }
    }

</script>


<style scoped>

</style>