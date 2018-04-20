<template>
    <div>
        <h1>Edit Customer</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-customers' }" class="btn btn-success">Return to customers</router-link></div>
        </div>

        <form v-on:submit.prevent="updateCustomer">
            <div class="form-group">
                <label name="first_name">First Name</label>
                <input type="text" class="form-control" v-model="customer.first_name">
            </div>

            <div class="form-group">
                <label name="last_name">Last Name</label>
                <input type="text" class="form-control" v-model="customer.last_name">
            </div>

             <div class="form-group">
                <label name="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" v-model="customer.mobile_number">
            </div>

             

             <div class="form-group">
                <label name="work_phone">Work Phone</label>
                <input type="text" class="form-control" v-model="customer.work_phone">
            </div>

             <div class="form-group">
                <label name="phone_code">Phone Code</label>
                <input type="text" class="form-control" v-model="customer.phone_code">
            </div>

             <div class="form-group">
                <label name="fax">Fax</label>
                <input type="text" class="form-control" v-model="customer.fax">
            </div>
            <div class="form-group">
                <label name="email">E-Mail</label>
                <input type="text" class="form-control" v-model="customer.email">
            </div>

             <div class="form-group">
                <label name="posta_address">Postal Address</label>
                <input type="text" class="form-control" v-model="customer.postal_address">
            </div>
             <div class="form-group">
                <label name="town">Town/City</label>
                <input type="text" class="form-control" v-model="customer.town">
            </div>
             

             <div class="form-group">
                <label name="phisical_address">Phisical Address</label>
                <input type="text" class="form-control" v-model="customer.phisical_address">
            </div>

             <div class="form-group">
                <label name="company">Company</label>
                <input type="text" class="form-control" v-model="customer.company">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                customer:{}
            }
        },

        created: function(){
            this.getCustomer();
        },

        methods: {
            getCustomer()
            {
              let uri = `http://127.0.0.1:8000/api/customers/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.customer = response.data;
                });
            },

            updateCustomer()
            {
              let uri = 'http://127.0.0.1:8000/api/customers/'+this.$route.params.id;
                this.axios.patch(uri, this.customer).then((response) => {
                  this.$router.push({name: 'list-customers'});
                });
            }
        }
    }
</script>