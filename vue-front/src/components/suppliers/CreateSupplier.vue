<template>
<div>
 <h3 class="title">Add  Supplier</h3>
   
    <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Supplier Name (Company):</label>
              <input type="text" class="form-control" v-model="supplier.supplier_name" name="Supplier" v-validate="'required'" />
              <div class="help-block alert alert-danger" v-show="errors.has('supplier')">
          {{errors.first('supplier')}}
            </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Mobile Number:</label>
              <input type="text" class="form-control" v-model="supplier.mobile_number" name="cellphone" v-validate="'required|numeric|min:10'"/>
              <div class="help-block alert alert-danger" v-show="errors.has('cellphone')">
          {{errors.first('cellphone')}}
            </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Work Phone No.:</label>
              <input type="text" class="form-control" v-model="supplier.work_phone" name="cellphone" v-validate="'required|numeric'"/>
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
              <input type="text" class="form-control" v-model="supplier.phone_code" name="phone_code" v-validate="'required|max:4|min:4'"/>
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
          <button class="btn btn-default" @click="showMoreSupplierFields">Add More Supplier Information</button>
          </div>
          </div>
          </div>


<div v-show="additional_info">
        <h3>Contact Person</h3>
   <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Contact Title:</label>
            <input type="text" class="form-control" v-model="supplier.contact_title" name="contact_title" v-validate="'alpha_space|min:3|max:30'">
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
            <input type="text" class="form-control" v-model="supplier.contact_name" name="contact_name" v-validate="'alpha_space|max:30'">
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
            <input type="text" class="form-control" v-model="supplier.country" name="country" v-validate="'alpha_space'">
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
              <input type="number" class="form-control" v-model="supplier.fax" v-validate="'numeric'" name="fax"/>
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
              <input type="email" class="form-control" v-model="supplier.email" v-validate="'email'" name="email"/>
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
              <input type="text" class="form-control" v-model="supplier.postal_address" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Town/City:</label>
              <input type="text" class="form-control" v-model="supplier.town" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Postal Code:</label>
              <input type="text" class="form-control" v-model="supplier.zip" name="zip" v-validate="'numeric|min:5|max:5'" />
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
              <input type="text" class="form-control" v-model="supplier.phisical_address" />
            </div>
          </div>
        </div>
        </div><!--End of additional information section-->
        <br>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <button class="btn btn-info pull-right" @click="addSupplier">Save</button>
            </div>
          </div>
        </div>
        <br>

        
    
  </div>
</div>
</template>
<script>
  export default {
    data(){
        return{
          supplier:{},
          additional_info:false
        }
    },
    methods: {
      addSupplier(){
        
        return this.axios.post('suppliers', this.supplier).then((response) => {
          this.$router.push({name: 'list-suppliers'})
        })
    },
    showMoreSupplierFields()
    {
    this.additional_info=true;
    }
  }
}
</script>