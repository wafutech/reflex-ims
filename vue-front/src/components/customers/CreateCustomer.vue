<template>
  <div>
    <h3 class="title">Customers</h3>
    <form v-on:submit.prevent="addCustomer">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" v-model="customer.first_name">
           </div>
        </div>
        </div>
        
         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Last Name:</label>
              <input type="text" class="form-control" v-model="customer.last_name" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Company:</label>
              <input type="text" class="form-control" v-model="customer.company" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Mobile Number:</label>
              <input type="number" class="form-control" v-model="customer.mobile_number" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Work Phone:</label>
              <input type="text" class="form-control" v-model="customer.work_phone" />
            </div>
          </div>
        </div>

          

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Phone Code:</label>
              <input type="text" class="form-control" v-model="customer.phone_code" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>E-Mail:</label>
              <input type="text" class="form-control" v-model="customer.email" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Fax:</label>
              <input type="number" class="form-control" v-model="customer.fax" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Postal Address:</label>
              <input type="text" class="form-control" v-model="customer.postal_address" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Town/City:</label>
              <input type="text" class="form-control" v-model="customer.town" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Postal Code:</label>
              <input type="text" class="form-control" v-model="customer.zip" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Phisical Address:</label>
              <input type="text" class="form-control" v-model="customer.phisical_address" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
            <button class="btn btn-info pull-right">Save</button>>
            </div>
          </div>
        </div>
            

      
    </form>
  </div>
</template>
<script>
  export default {
    data(){
        return{
          customer:{}
        }
    },
    methods: {
      addCustomer(){
        let uri = 'http://127.0.0.1:8000/api/customers';
        this.axios.post(uri, this.customer).then((response) => {
          this.$router.push({name: 'list-customers'})
        })
    }
  }
}
</script>