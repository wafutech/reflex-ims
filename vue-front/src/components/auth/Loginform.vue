<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="signIn">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
    name: 'Login',
        data(){
            return {
                email: '',
                password: '',
                error: false
            }
        },

        

        methods: {
            signIn(){
            var _this = this;
            var data = {

            client_id:2,
            client_secret:'loFwtOfespD2Tk3ZwoQkr0ZFCuGHAW3Wy3sBv65Q',
            grant_type:'password',
            username:this.email,
            password:this.password
            }
    

     let uri = 'http://127.0.0.1:8000/oauth/token';
        axios.post(uri, data).then(response => {
        console.log(response.data)
          this.$router.push({name: 'dashboard'})
        })

                
            }
        }
    }   
</script>
