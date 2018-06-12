<template>
  <div>
  <div class="panel panel-info">
  <div class="panel-heading">
  <div class="panel-title">
      <h3 class="title">New Customer</h3>

  </div>
  </div>
  <div class="panel-body">
  <div class="alert alert-success" v-show="success_message">
   <p>Customer Added to customer record!</p>
   <button class="btn btn-default" @click="exitToCustomerList">Close</button>
   </div>
           <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Customer Name (Company):</label>
            <input type="text" name="customer_name" class="form-control" v-model="customer.customer_name" v-validate="'required|alpha_space|min:3'">
            <div class="help-block alert alert-danger" v-show="errors.has('customer_name')">
            {{errors.first('customer_name')}}
            </div>
           </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Mobile Number:</label>
              <input type="number" name="mobile_number" class="form-control" v-model="customer.mobile_number" v-validate="'required|numeric|min:10'" />
               <div class="help-block alert alert-danger" v-show="errors.has('mobile_number')">
            {{errors.first('mobile_number')}}
            </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Work Phone No.:</label>
              <input type="text" class="form-control" v-model="customer.work_phone" name="cellphone" v-validate="'required|numeric'"/>
              <div class="help-block alert alert-danger" v-show="errors.has('work_phone')">
          {{errors.first('work_phone')}}
            </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Phone Code:</label>
              <input type="text" class="form-control" v-model="customer.phone_code" name="phone_code" v-validate="'required|max:4|min:4'"/>
               <div class="help-block alert alert-danger" v-show="errors.has('phone_code')">
          {{errors.first('phone_code')}}
            </div>
            </div>
          </div>
        </div>
        <hr>

<div class="row" v-show="!additional_info">
        <div class="col-md-10">
          <div class="form-group">
          <button class="btn btn-default" @click="showMoreCustomerFields">Additional Customer Fields</button>
          </div>
          </div>
          </div>
<div v-show="additional_info">
        <h3><small>Additional Information</small></h3>
   <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Contact Title:</label>
            <input type="text" class="form-control" v-model="customer.contact_title" name="contact_title" v-validate="'alpha_space|min:3|max:30'">
             <div class="help-block alert alert-danger" v-show="errors.has('contact_title')">
          {{errors.first('contact_title')}}
            </div>
          </div>
        </div>
        </div>

    <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Contact Name:</label>
            <input type="text" class="form-control" v-model="customer.contact_name" name="contact_name" v-validate="'alpha_space|max:30'">
             <div class="help-block alert alert-danger" v-show="errors.has('contact_name')">
          {{errors.first('contact_name')}}
            </div>
          </div>
        </div>
        </div>
        
         <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Country:</label>
            <input type="text" class="form-control" v-model="customer.country" name="country" v-validate="'alpha_space'">
             <div class="help-block alert alert-danger" v-show="errors.has('country')">
          {{errors.first('country')}}
            </div>
          </div>
        </div>
        </div>
  
        

               

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Fax:</label>
              <input type="number" class="form-control" v-model="customer.fax" v-validate="'numeric'" name="fax"/>
               <div class="help-block alert alert-danger" v-show="errors.has('fax')">
          {{errors.first('fax')}}
            </div>
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>E-Mail:</label>
              <input type="email" class="form-control" v-model="customer.email" v-validate="'email'" name="email"/>
               <div class="help-block alert alert-danger" v-show="errors.has('email')">
          {{errors.first('email')}}
            </div>
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
              <input type="text" class="form-control" v-model="customer.zip" name="zip" v-validate="'numeric|min:5|max:5'" />
               <div class="help-block alert alert-danger" v-show="errors.has('zip')">
          {{errors.first('zip')}}
            </div>
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
        </div><!--End of additional information section-->
        <br>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <button class="btn btn-info pull-right" @click="addCustomer">Save</button>
            </div>
          </div>
        </div>
        <br>
  
  </div>
  </div>    
  </div>
</template>
<script>
  export default {
    data(){
        return{
          customer:{},
          additional_info:false,
          success_message:false

        }
    },
    methods: {
      addCustomer(){
        
        return this.axios.post('customers', this.customer).then((response) => {
         this.success_message=true;
      this.customer='';
        }).catch((error)=>{console.log(error)})
    },
     showMoreCustomerFields()
    {
    this.additional_info=true;
    },

     exitToCustomerList()
    {
    this.$router.push({name: 'list-customers'})
    }

  }
}
</script>