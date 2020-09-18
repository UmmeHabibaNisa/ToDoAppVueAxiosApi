<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group">
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <label style="margin-top:70px;" for="exampleDropdownFormEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com" v-model="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleFormPassword1" placeholder="Password" v-model="password">
                        </div>
                        <button type="button" class="btn btn-primary"  @click="login">Log in</button><br><br>
                        <a href="/registration">New around here? Sign up</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        data(){
            return{
                email:'',
                password:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            login(){

                axios.post('/api/login', {

                    email : this.email,
                    password : this.password
                })
                    .then(function (response) {
                        alert ('you have signed in');
                        window.location.href = '/home';
                        // this.$router.push ('/');
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

        }
    }
</script>

<style scoped>

</style>
