<template>
<div>
 <h3 class="title">Add  Supplier</h3>
    <form v-on:submit.prevent="addSupplier">
    
    <div class="row">
        <div class="col-cm-10">
          <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" v-model="supplier.first_name">
          </div>
        </div>
        </div>
        
         <div class="row">
        <div class="col-cm-10">
          <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" v-model="supplier.last_name">
          </div>
        </div>
        </div>

      

        <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Company:</label>
              <input type="text" class="form-control" v-model="supplier.company" />
            </div>
          </div>
        </div>

         <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Mobile Number:</label>
              <input type="text" class="form-control" v-model="supplier.mobile_number" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Work Phone:</label>
              <input type="number" class="form-control" v-model="supplier.work_phone" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Phone Code:</label>
              <input type="text" class="form-control" v-model="supplier.phone_code" />
            </div>
          </div>
        </div>

          

           <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Fax:</label>
              <input type="number" class="form-control" v-model="supplier.fax" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>E-Mail:</label>
              <input type="email" class="form-control" v-model="supplier.email" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Postal Address:</label>
              <input type="text" class="form-control" v-model="supplier.postal_address" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Town/City:</label>
              <input type="text" class="form-control" v-model="supplier.town" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Postal Code:</label>
              <input type="text" class="form-control" v-model="supplier.zip" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <label>Phisical Address:</label>
              <input type="text" class="form-control" v-model="supplier.phisical_address" />
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-cm-10">
            <div class="form-group">
              <button class="btn btn-info pull-right">Add Supplier</button>
            </div>
          </div>
        </div>
        <br>

        
    </form>
  </div>
</div>
</template>
<script>
  export default {
    data(){
        return{
          supplier:{}
        }
    },
    methods: {
      addSupplier(){
        let uri = 'http://localhost/ims/public/api/suppliers';
        this.axios.post(uri, this.supplier).then((response) => {
          this.$router.push({name: 'display-supplier'})
        })
    }
  }
}
</script>