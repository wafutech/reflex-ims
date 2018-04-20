<template>
    <div>
        <div class="alert alert-danger" v-if="error && !success">
            <p>There was an error, unable to complete registration.</p>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Registration completed. You can now <router-link :to="{name:'login'}">sign in.</router-link></p>
        </div>
        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" v-model="user.name" required>
                <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="user.email" required>
                <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="user.password" required>
                <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.confirm_password }">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="password" class="form-control" v-model="user.confirm_password" required>
                <span class="help-block" v-if="error && errors.password">{{ errors.confirm_password }}</span>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</template>
<script> 
import axios from 'axios';
    export default {
        data(){
            return {
               
                user:{},
                error: false,
                errors: {},
                success: false
            };
        },
       

        methods: {
      register(){
        let uri = 'http://127.0.0.1:8000/api/register';
        axios.post(uri, this.user).then((response) => {
          this.$router.push({name: 'home'})
        })
    },
                        success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                 redirect: null   

  }
    }
</script>