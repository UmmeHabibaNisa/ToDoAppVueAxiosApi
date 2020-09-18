<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="margin-top:70px;">
                    <form>
                        <div class="form-group">
                            <label  for="exampleInputName1">Full Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" v-model="name" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@example.com" v-model="email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
                        </div>
                        <button type="button" class="btn btn-primary" @click="register">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Registration",
        data(){
            return{
                name : '',
                email:'',
                password:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            register(){
                axios.post('/api/registration', {
                    name : this.name,
                    email : this.email,
                    password : this.password
                })
                    .then(function (response) {
                        alert ('you have successfully done registration');
                        window.location.href = '/';
                        // this.$router.push ('/');
                        console.log(response);
                    })
                    .catch(function (error) {
                        alert ('Duplicate entry');
                        console.log(error);
                    });

            }
        }
    }
</script>

<style scoped>

</style>
