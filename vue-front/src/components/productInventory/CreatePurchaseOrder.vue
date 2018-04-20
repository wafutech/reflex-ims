<template>
  <div>
    <h3 class="title">Add  purchase</h3>
    <form v-on:submit.prevent="addPurchase">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Product Name:</label>
            <input type="text" class="form-control" v-model="purchase.product_id">
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Supplier:</label>
              <input type="text" class="form-control col-md-10" v-model="purchase.supplier_id" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity:</label>
              <input type="number" class="form-control col-md-10" v-model="purchase.quantity" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Measure:</label>
              <input type="text" class="form-control col-md-10" v-model="purchase.unit_measure_id" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Cost:</label>
              <input type="text" class="form-control col-md-10" v-model="purchase.unit_cost" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Warehouse:</label>
              <input type="number" class="form-control col-md-10" v-model="purchase.warehouse_id" />
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
          purchase:{}
        }
    },
    methods: {
      addPurchase(){
        let uri = 'http://localhost/ims/public/api/purchases';
        this.axios.post(uri, this.purchase).then((response) => {
          this.$router.push({name: 'list-purchase-orders'})
        })
    }
  }
}
</script>