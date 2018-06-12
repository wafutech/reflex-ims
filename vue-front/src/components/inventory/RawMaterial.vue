<template>
  <div>

  <div class="panel-warning">
  <div class="panel-heading">
  <div class="panel=title">
  <h3>Receive Raw Materials</h3>
  </div>
  </div>
  <div class="panel-body">
  <div v-show="isData">
  <table class="table table-hover table-stripped">
  <tr>
  <th>
  Raw Material 
  </th>
  <th>
 Description (Optional)
  </th>
  <th>
  Qty
  </th>
  
  <th>
  Unit Cost
  </th>
   <th>
  Amount
  </th>
  <th>
  Warehouse
  </th>
  <th>
  Date
  </th>
  </tr>
  <tr v-for="i in items">
  <td>{{i.raw_material_name}}</td>
   <td>{{i.quantity}}</td>
  <td>{{formatCurrency(i.unit_cost)}}</td>
  <td>{{formatCurrency(i.amount)}}</td>
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
  <h3>Add New</h3>
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
            <select name="raw_material_id" v-model="item.raw_material_id" class="form-control" style="height:40px;" v-validate=" 'required'"  >
             <option v-for="rm in materials" v-bind:value="rm.id">{{rm.raw_material_name}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('raw_material_id')">
          {{errors.first('raw_material_id')}}
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
          <th>Unit of Measure</th>
          <th>Unit Cost</th>
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
          <!--Unit of Measure-->
          <td><div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Unit of Measure</label>
              <select name="unit_of_measure" v-model="item.unit_of_measure" class="form-control" style="height:40px;" v-validate=" 'required'"  >
             <option v-for="unit in units" v-bind:value="unit.id">{{unit.unit_description}}</option> 
          </select> 
              <div v-show="errors.has('unit_of_measure')" class="help-block alert alert-danger">
              {{errors.first('unit_of_measure')}}
              </div>
            </div>
          </div>
        </div></td>

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
          <!-->Warehouse-->
          <td colspan="3">
          <td><div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Assign Warehouser</label>
              <select name="warehouse_id" v-model="item.warehouse_id" class="form-control" style="height:40px;" v-validate=" 'required'"  >
             <option v-for="w in warehouses" v-bind:value="w.id">{{w.warehouse_name}}</option> 
          </select> 
              <div v-show="errors.has('warehouse_id')" class="help-block alert alert-danger">
              {{errors.first('warehouse_id')}}
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

  export default {
    data(){
        return{
          item:{},
          suppliers:{},
          materials:{},
          items:[],
          isData:false,
          total:0,
          vat:0,
          units:{},
          warehouses:{}

        }
    },

     beforeMount: function()
        {
            this.getSuppliers();
            this.getRawMaterials();
            this.getWarehouses();
        


        },
    methods: {
      addItem(){
        let uri = 'http://127.0.0.1:8000/api/raw-material-inventory';
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

    getRawMaterials(){
        let uri = 'http://127.0.0.1:8000/api/raw-materials';
              this.axios.get(uri).then((response) => {
                  this.materials = response.data;
              });
    },

    getWarehouses()
    {
     let uri = 'http://127.0.0.1:8000/api/ware-houses';
              this.axios.get(uri).then((response) => {
                  this.warehouses = response.data;
              });

    },

    getPaymentMethods(){
        let uri = 'http://127.0.0.1:8000/api/payment-methods';
              this.axios.get(uri).then((response) => {
                  this.pms = response.data;
              });
    },

    getUnitOfMeasure(){
        let uri = 'http://127.0.0.1:8000/api/lists/unit-of-measures';
              this.axios.get(uri).then((response) => {
                  this.units = response.data;
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