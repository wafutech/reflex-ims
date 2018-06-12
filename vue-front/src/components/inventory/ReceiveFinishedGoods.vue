<template>
  <div>
 
   <div class="panel-warning">
  <div class="panel-heading">
  <div class="panel=title">
  </div>
  </div>
  <div class="panel-body">
  <div v-show="isData">
  <table class="table table-hover table-stripped">
  <tr>
  <th>
  Product Code
  </th>
  <th>
 Name
  </th>
  <th>
  Description
  </th>
  <th>
  Qty
  </th>
  <th>
  Unit Cost
  </th>
   <th>
  Total
  </th>
  <th>
  Selling Price
  </th>
  <th>
  Date
  </th>
  </tr>
  <tr v-for="i in items">
  <td>{{i.sku}}</td>
   <td>{{i.product_id}}</td>
  <td>{{i.sku}}</td>
  <td>{{i.quantity}}</td>
  <td>{{i.unit_cost}}</td>
  <td>{{formatCurrency(i.unit_cost*i.quantity)}}</td>
  <td>{{i.selling_price}}</td>
  <td>{{i.purchase_date}}</td>
  <td>Barcode</td>
  </tr>
  
  </table>
  <div class="pull-right">
  <table table-hover table-striped>
  <tr>
  <th>Total Before V.A.T </th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
  <th>{{formatCurrency(total)}}</th>
  </tr>
  <tr>
  <th>V.A.T (16%)</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
  <th>{{formatCurrency(vat)}}</th>
  </tr>
   <tr>
  <th>Grand Total</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
  <th>{{formatCurrency(total+vat)}}</th>
  </tr>

  </table>
  </div>
  </div>
  </div>
  <div class="panel-footer">
  <div class="panel panel-info">
  <div class="panel-heading">
  <div class="panel-title">
  <h3>Receive Stock Inventory Items</h3>
 
  </div>
  </div>
  <div class="panel-body">
  <div class="alert alert-warning" v-show="noItems">
  No Items to receive, you're suppose to place a purchase order before receiving inventory items
  </div>

  <form v-on:submit.prevent="addItem" v-show="!noItem">

  <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Product/Item</label>
              
           <div v-cloak>        
          <div class="form-group">
            <select name="product_id" v-model="item.product_id" class="form-control" style="height:40px;" v-validate=" 'required'"  >
             <option v-for="p in products" v-bind:value="p.id">{{p.product_name}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('product_id')">
          {{errors.first('product_id')}}
          </div>
          </div>
          </div>

            </div>
          </div>
        </div>
     

      <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6">
           <div v-cloak>        
          <div class="form-group">
            <label>Supplier:</label>
            <select v-model="item.supplier_id" name="supplier_id" v-validate="'required'" class="form-control" style="height:40px;" :onchange="showOrderedItems()">            
            <option v-for="c in suppliers" v-bind:value="c.id">{{c.supplier_name}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('supplier_id')">
          {{errors.first('supplier_id')}}
          </div>
          </div>
        </div>          

            
          
        </div>
        <div class="col-md-6">
       
        <p><router-link :to="{ name: 'create-product' }">New Product</router-link></p>

         <!--<input v-model="item.barcode" /><br>
      <barcode v-bind:value="barcodeValue">
        Show this if the rendering fails.
      </barcode>-->
        </div>
        
        </div>

        


          <table class="table table-striped table-bitemed">
          <thead>
          <tr>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Selling Price</th>
          <th>Purchase Date</th>
          </tr>
          </thead>
          <tr>
          
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input name="quantity"  type="number" class="form-control" v-model="item.quantity" v-validate="'required|min_value:1'" />
              <div v-show="errors.has('quantity')" class="alert alert-danger">
              {{errors.first('quantity')}}
              </div>
            </div>
          </div>
        </div>
          </td>
          <td><div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input name="unit_cost" type="number" class="form-control" v-validate="'required|min_value:1'" v-model="item.unit_cost"  />
              <div v-show="errors.has('unit_cost')" class="help-block alert alert-danger">
              {{errors.first('unit_cost')}}
              </div>
            </div>
          </div>
        </div></td>
          <td><div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input name="selling_price"  type="number" class="form-control" v-model="item.selling_price" v-validate="'required|min_value:1'" />
            </div>
            <div class="help-block alert alert-danger" v-show="errors.has('selling_price')">
            {{errors.first('selling_price')}}
            </div>
          </div>
        </div></td>
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input name="date" type="date" class="form-control date-picker" v-model="item.purchase_date" v-validate=" 'required' " />
              <div class="help-block alert alert-danger" v-show="errors.has('date')">
              {{errors.first('date')}}
              </div>
            </div>
          </div>
        </div>
        
       
          </td>
          </tr>
          <tr>
          <td>
          <div class="row">
          <div class="col-md-10">
          <div class="form-group">
          <label>VAT</label> <input type="number" v-model="item.vat" class=form-control><span>%</span>
          </div>
          </div>
          </div>
          </td>
          <td>
          <div class="row">
          <div class="col-md-12">
          <div class="form-group">
          <label>Warehouse</label>
          <select v-model="item.warehouse_id" name="warehouse" v-validate="'required'" class="form-control" style="height:40px;">            
            <option v-for="warehouse in warehouses" v-bind:value="warehouse.id">{{warehouse.warehouse_code}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('warehouse')">
            {{errors.first('warehouse')}}
            </div>
          </div>
          </div>
          </div>
          </td>
          <td colspan="2">
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
          <label>Barcode</label> <input type="number" v-model="item.barcode" class="form-control" disabled>
          </div>
          </div>
          </div>
          </td>
          </tr>
          </table>

        </div>
        </div>           
         

    <div class="panel-footer">
    <div class="form-group">
          <button class="btn btn-primary pull-right">Add Item</button>
        </div>
    </div>
     </form>
    </div>
  </div>
  </div>
  </div>
  </div>

  </div>
  </template>
  
  <script>
  import veeValidate from 'vee-validate';
  import VueBarcode from 'vue-barcode';

  export default {
  name:'ReceiveFinishedGoods',
  components:
  {
   'barcode': VueBarcode
  },
    data(){
        return{
          item:{},
          suppliers:{},
          products:{},
          warehouses:{},
          items:[],
          isData:false,
          total:0,
          vat:0,
          supplier:'',
          barcodeValue: 0,
          noItems:false

        }
    },

     beforeMount: function()
        {
            this.getSuppliers();
            this.getProducts();
            this.barcodeGenerator();
            this.getWarehourses();
        
        },

    methods: {
      addItem(){
    
        this.$validator.validateAll().then(()=>{

       return this.axios.post('items', this.item).then((response) => {
        this.total = this.total+this.item.unit_cost*this.item.quantity;
        this.vat =this.item.vat*this.total;
         this.items.push(response.data);
        this.isData=true;


        })

        })
        
    },

    showOrderedItems()
    {

     this.supplier =this.item.supplier_id;
        var itemsObject = this.products;        

         var selectedItem = this.findObjectByKey(itemsObject,'supplier_id',this.supplier)
         console.log(selectedItem);
    },

    findObjectByKey()
    {

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


    },

    getSuppliers(){
       
              return this.axios.get('suppliers').then((response) => {
                  this.suppliers = response.data;
              });
    },

    getProducts(){
          return this.axios.get('receive/purchases').then((response) => {
               if(response.data.length>0) 
               {
               this.products = response.data;
               }  

               else
               {
               this.noItems=true;
               }
                  
              });
               
    },

    getPaymentMethods(){
        
             return  this.axios.get('payment-methods').then((response) => {
                  this.pms = response.data;
              });
    },

    getWarehourses(){

    return  this.axios.get('ware-houses').then((response) => {
                  this.warehouses = response.data;
              });
    },

   formatCurrency(value)
    {
     let val = (value/1).toFixed(2).replace(',','.');
     return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");
    },
    barcodeGenerator()
    {
  var barcode =  Math.floor(Math.random()*1000000000000)+1
  
  this.item.barcode = barcode;

console.log('barcode'+barcode)
    }

    


  }
}
  </script>
  <style>
  .top-row
  {
  background-color:#ccc;
  }
  .table-body
  {
  height:400px;
  }
  </style>