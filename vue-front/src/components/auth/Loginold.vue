<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="user.email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="user.password" required>
            </div>
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user:{},
                errors: {},
                response:''              
             
            }
        },

        mounted(){
        },

        methods: {
            login(){
                 let uri = 'http://localhost/ims/public/api/auth/login';
        this.axios.post(uri, this.user).then((response))},

                            
                    success: function () {},
                    error: function (resp) {
                        alert(resp.data.msg)
                    },
                    rememberMe: true,
                    redirect: '/dashboard',
                    fetchUser: true,
                }             
            
        
    }   
</script>
