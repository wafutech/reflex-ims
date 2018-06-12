<template>
  <div>
    <h3 class="title">Add  purchase</h3>
    <form v-on:submit.prevent="addPurchase">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Product Name:</label>
            <select v-model="purchase.product_id" name="product_id" v-validate="product_id" class="form-control" style="height:40px;">
            <option value="" >Select Product</option>
            <option v-for="product in products" v-bind:value="product.id">{{product.product_name}}</option> 
          </select> 
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Supplier:</label>
              <select v-model="purchase.supplier_id" name="supplier_id" v-validate="supplier_id" class="form-control" style="height:40px;">
            <option value="" >Select Supplier</option>
            <option v-for="supplier in suppliers" v-bind:value="supplier.id">{{supplier.company}}</option> 
          </select> 
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity:</label>
              <input type="number" class="form-control" v-model="purchase.quantity" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Measure:</label>
              <select v-model="purchase.unit_measure_id" name="unit_measure_id" v-validate="unit_measure_id" class="form-control" style="height:40px;">
            <option value="" >Select Measure</option>
            <option v-for="u in units" v-bind:value="u.id">{{u.unit_description}}</option> 
          </select> 
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Cost:</label>
              <input type="text" class="form-control" v-model="purchase.unit_cost" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Warehouse:</label>
              <input type="number" class="form-control" v-model="purchase.warehouse_id" />
            </div>
          </div>
        </div>
          <br><br>
                 
<div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <button class="btn btn-info pull-right">Place Purchase Order</button>
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
          purchase:{},
          products:{},
          suppliers:{},
          units:{}
        }
    },

    Mounted: function()
        {
            this.getSuppliers();
            this.getProducts();
            this.getUnitMeasures();
            
   


        },
    methods: {
      addPurchase(){
        let uri = 'http://localhost/ims/public/api/purchases';
        this.axios.post(uri, this.purchase).then((response) => {
          this.$router.push({name: 'list-purchase-orders'})
        })
    },

    getProducts(){
        let uri = 'http://127.0.0.1:8000/api/products';
              this.axios.get(uri).then((response) => {
                  this.products = response.data;
              });
    },

    getSuppliers(){
        let uri = 'http://127.0.0.1:8000/api/suppliers';
              this.axios.get(uri).then((response) => {
                  this.suppliers = response.data;
              });
    },

    getUnitMeasures(){
        let uri = 'http://127.0.0.1:8000/api/lists/unit-of-measures';
              this.axios.get(uri).then((response) => {
                  this.units = response.data;
                  console.log(this.units);
              });
    },


     formatCurrency(value)
    {
     let val = (value/1).toFixed(2).replace('.',',');
     return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
    }



  }
}
</script>