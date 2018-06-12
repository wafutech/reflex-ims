<template>
  <div>
  <div class="panel-warning">
  <div class="panel-heading">
  <div class="panel=title">
  <h3>Receive Inventory Items</h3>
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
  <h3>New Items</h3>
  </div>
  </div>
  <div class="panel-body">

  <form v-on:submit.prevent="addItem">

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
            <select v-model="item.supplier_id" name="supplier_id" v-validate="'required'" class="form-control" style="height:40px;">            
            <option v-for="c in suppliers" v-bind:value="c.id">{{c.company}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('supplier_id')">
          {{errors.first('supplier_id')}}
          </div>
          </div>
        </div>          

            
          
        </div>
        <div class="col-md-6">
       
        <p><router-link :to="{ name: 'create-product' }">New Product</router-link></p>
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

  export default {
    data(){
        return{
          item:{},
          suppliers:{},
          products:{},
          items:[],
          isData:false,
          total:0,
          vat:0

        }
    },

     beforeMount: function()
        {
            this.getSuppliers();
            this.getProducts();
        


        },
    methods: {
      addItem(){
        let uri = 'http://127.0.0.1:8000/api/items';
        this.$validator.validateAll().then(()=>{

        this.axios.post(uri, this.item).then((response) => {
        this.total = this.total+this.item.unit_cost*this.item.quantity;
        this.vat =(16/100)*this.total;
         this.items.push(response.data);
                     this.isData=true;


        })

        })
        
    },
    getSuppliers(){
        let uri = 'http://127.0.0.1:8000/api/suppliers';
              this.axios.get(uri).then((response) => {
                  this.suppliers = response.data;
              });
    },

    getProducts(){
        let uri = 'http://127.0.0.1:8000/api/products';
              this.axios.get(uri).then((response) => {
                  this.products = response.data;
              });
    },

    getPaymentMethods(){
        let uri = 'http://127.0.0.1:8000/api/payment-methods';
              this.axios.get(uri).then((response) => {
                  this.pms = response.data;
              });
    },

   formatCurrency(value)
    {
     let val = (value/1).toFixed(2).replace(',','.');
     return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");
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