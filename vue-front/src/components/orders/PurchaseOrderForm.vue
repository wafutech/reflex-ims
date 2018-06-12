<template>
  <div>
    <h3 class="title">Purchase Order Form</h3>
    <div class="purchase-items" v-show="showitems">
    <table class="table table-striped">
    <thead>
    <tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Unit Cost</th>
    <th>Amount</th>
    <th>Supplier</th>
    <th>Expected Date</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(item,index) in purchaseditems">
    <td>{{item.product_name}}</td>
   <td>{{item.quantity}}{{item.units}}</td>
    <td>{{formatCurrency(item.unit_cost)}}</td>
    <td>{{formatCurrency(item.unit_cost*item.quantity)}}</td>
    <td>{{item.supplier}}</td>
    <td>{{item.expected_date}}</td>


    </tr>
    <tr><td colspan="5"><strong>Total</strong></td><td><strong>{{formatCurrency(total)}}</strong></td></tr>
    </tbody>
    </table>
    </div>
    <div class="row">
    <div class="col-md-6">
   <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Product Name:</label>
            <select v-model="purchase.product_id" name="product_id"  v-validate="'required'" class="form-control" style="height:40px;">
            <option value="null" selected>Select Product</option>
            <option v-for="p in products" v-bind:value="p.id">{{p.product_name}}</option> 
          </select> 
           <div class="help-block alert alert-danger" v-show="errors.has('product_id')">

          {{errors.first('product-id')}}
            </div>
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Supplier:</label>
              <select v-model="purchase.supplier_id" name="supplier" v-validate="'required'" class="form-control" style="height:40px;">
            <option value="" >Select Supplier</option>
            <option v-for="supplier in suppliers" v-bind:value="supplier.id">{{supplier.supplier_name}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('supplier')">

          {{errors.first('supplier')}}
            </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity:</label>
              <input type="number" class="form-control" v-model="purchase.quantity" name="quantity" v-validate="'required|min:1'"/>
              <div class="help-block alert alert-danger" v-show="errors.has('quantity')">

          {{errors.first('quantity')}}
            </div>

            </div>
          </div>
        </div>
    </div><!--end of left column-->

    <div class="col-md-6">
   <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Measure:</label>
              <select v-model="purchase.unit_measure_id" name="unit_measure" v-validate="'required'" class="form-control" style="height:40px;">
            <option value="" disabled>Select Measure</option>
            <option v-for="(u,index) in units" v-bind:value="u.id">{{u.unit_description}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('unit_measure')">

          {{errors.first('unit_measure')}}
            </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Cost:</label>
              <input type="text" name="unit_cost" class="form-control" v-model="purchase.unit_cost" v-validate="'required|numeric'"/>
              <div class="help-block alert alert-danger" v-show="errors.has('unit_cost')">

          {{errors.first('unit_cost')}}
            </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
             <label>Expected Date:</label>
             <input type="date" name="expected_date" class="form-control date-picker" v-model="purchase.expected_date" v-validate="'required'"/>
              <div class="help-block alert alert-danger" v-show="errors.has('expected_date')">
          {{errors.first('expected_date')}}
            </div>
            </div>
            </div>
            </div>

            <div class="row">
          <div class="col-md-10">
            <div class="form-group">
             <label>Amount:</label>
             <input type="number" name="amount" class="form-control disabled" v-model="purchase.amount" disabled/>
              </div>
            </div>
            </div>

        <!-- <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <div class="row">
              <div class="col-md-6">
              <button class="btn btn-info" @click="addToPurchaseOrder">Add More</button>
              </div>

              <div class="col-md-6">
              <button class="btn btn-default" @click="addToPurchaseOrderDone">Done</button>
              </div>
              </div>
              
            </div>
          </div>
        </div>-->
    </div> <!--end of right column-->
    </div>
      
        

        
          <br><br>
                 
<div class="row" v-show="ShowAddToPurchaseOrderDone">
          <div class="col-md-10">
            <div class="form-group">
              <button class="btn btn-success pull-right" @click="sendPurchaseOrder">Place Purchase Order</button>
            </div>
          </div>
        </div>
          
       
   
  </div>
</template>
<script>
  export default {
    data(){
        return{
          purchase:{product_name:'',amount:'',},
          products:{},
          suppliers:{},
          units:{},
          purchaseditems:[],
          showitems:false,
          ShowAddToPurchaseOrderDone:false,
          total:0
        
        }
    },

    beforeMount: function()
        {
            this.getSuppliers();
            this.getProducts();
            this.getUnitMeasures();
         
   
       },
    methods: {
      sendPurchaseOrder(){
        this.$validator.validateAll().then(()=>{
        var purchases = 0
    if(this.purchaseditems.length)
    {
    purchases = this.purchaseditems
    }
    else
    {
    purchases = this.purchase
    }
        return this.axios.post('purchases', purchases).then((response) => {
         // this.$router.push({name: 'list-purchase-orders'})
                 console.log(response.data)

        })
        })
        
    },

    addToPurchaseOrder()
    {
    this.$validator.validateAll().then(()=>
        {
this.purchase.product_name = this.findProductName().product_name
 this.purchase.amount = this.purchase.unit_cost*this.purchase.quantity;
    this.total = this.total+this.purchase.unit_cost*this.purchase.quantity;



return this.axios.post('virtual/purchases',this.purchase).then((items)=>{
            this.purchaseditems.push(items.data)
                this.showitems=true;


        })

       
       
    })
    },

    findProductName()
    {

    var product_id =this.purchase.product_id;
        var productsObject = this.products;
         function findObjectByKey(array,key,value)
        {
        for(var i =0; i<array.length;i++)
        {
        if(array[i][key]==value)
        {
        return array[i];
        }
        }
        return null;
        }

         var selectedProduct =findObjectByKey(productsObject,'id',product_id)
         return selectedProduct;
    },

    addToPurchaseOrderDone()
    {
    this.ShowAddToPurchaseOrderDone=true;

    },

    
    findProductName()
    {

    var product_id =this.purchase.product_id;
        var productsObject = this.products;
         function findObjectByKey(array,key,value)
        {
        for(var i =0; i<array.length;i++)
        {
        if(array[i][key]==value)
        {
        return array[i];
        }
        }
        return null;
        }

         var selectedProduct =findObjectByKey(productsObject,'id',product_id)
         return selectedProduct;
    },

    getProducts(){
      
          return this.axios.get('products').then((response) => {
                  this.products = response.data;
              }).catch((error)=>{console.log(error)})
    },

    getSuppliers(){
      
              return this.axios.get('suppliers').then((response) => {
                  this.suppliers = response.data;
              }).catch((error)=>{console.log(error)})
    },

    getUnitMeasures(){
          return this.axios.get('lists/unit-of-measures').then((response) => {
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