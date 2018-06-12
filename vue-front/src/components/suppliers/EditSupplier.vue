<template>
    <div>
        <h3 class="title">Edit Supplier</h3>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'display-supplier' }" class="btn btn-success">Return to Items</router-link></div>
        </div>

        <form v-on:submit.prevent="updateSupplier">
          
          <div class="form-group">
                <label name="contact_title">Contact Title</label>
                <input type="text" class="form-control" v-model="supplier.contact_title">
            </div>
             <div class="form-group">
                <label name="first_name">First Name</label>
                <input type="text" class="form-control" v-model="supplier.first_name">
            </div>

            <div class="form-group">
                <label name="last_name">Last Name</label>
                <input type="text" class="form-control" v-model="supplier.last_name">
            </div>

             <div class="form-group">
                <label name="company">Company</label>
                <input type="text" class="form-control" v-model="supplier.company">
            </div>

             <div class="form-group">
                <label name="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" v-model="supplier.mobile_number">
            </div>

             <div class="form-group">
                <label name="work_phone">Work Phone</label>
                <input type="text" class="form-control" v-model="supplier.work_phone">
            </div>

             <div class="form-group">
                <label name="phone_code">Telephone Code</label>
                <input type="text" class="form-control" v-model="supplier.phone_code">
            </div>
             <div class="form-group">
                <label name="fax">Fax</label>
                <input type="text" class="form-control" v-model="supplier.fax">
            </div>

             <div class="form-group">
                <label name="email">E-Mail</label>
                <input type="text" class="form-control" v-model="supplier.email">
            </div>

             <div class="form-group">
                <label name="postal_address">Postal Address</label>
                <input type="text" class="form-control" v-model="supplier.postal_address">
            </div>
             <div class="form-group">
                <label name="town">Town/City</label>
                <input type="text" class="form-control" v-model="supplier.town">
            </div>

             <div class="form-group">
                <label name="zip">Postal Code</label>
                <input type="text" class="form-control" v-model="supplier.zip">
            </div>            

             <div class="form-group">
                 <button class="btn btn-success pull-right">Save Changes</button>
            </div>  

           
        </form>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                supplier:{}
            }
        },

        created: function(){
            this.getSupplier();
        },

        methods: {
            getSupplier()
            {
              let uri = `http://127.0.0.1:8000/api/suppliers/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.supplier = response.data;
                });
            },

            updateSupplier()
            {
              let uri = 'http://127.0.0.1:8000/api/suppliers/'+this.$route.params.id;
                this.axios.patch(uri, this.supplier).then((response) => {
                  this.$router.push({name: 'list-suppliers'});
                });
            }
        }
    }
</script>