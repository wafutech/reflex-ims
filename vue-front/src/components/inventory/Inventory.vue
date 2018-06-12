<template>
  <div>

  <div class="panel-warning">
  <div class="panel-heading">
  <div class="panel=title">
  <h3>Receive Raw Materials</h3>
  <InventoryNavbar></InventoryNavbar>
  </div>
  </div>
  <div class="panel-body">
 
  </div>
  </div>
  <div class="panel-footer">
  <div class="panel panel-info">
  <div class="panel-heading">
  <nav class="navbar navbar-default">
  <ul>
  <li>List Raw Materials</li>
  <li>Warehouses</li>
  <li>Stock</li>

  </ul>
  </nav>
  </div>
  <div class="panel-body">

  <AddRawMaterial></AddRawMaterial>
    </div>
  </div>
  </div>
  </div>
  </div>

  </div>
  </template>
  
  <script>
import InventoryNavbar from '../../components/inventory/InventoryNavbar';
import AddWarehouse from '../../components/inventory/AddWarehouse';
import ListWarehouse from '../../components/inventory/ListWarehouse';
import ReceiveFinishedGoods from '../../components/inventory/ReceiveFinishedGoods';
import RawMaterialInventory from '../../components/inventory/RawMaterialInventory';
import AddRawMaterial from '../../components/inventory/AddRawMaterial';

  export default {
   components:
        {
        InventoryNavbar,
        ReceiveFinishedGoods,
        AddWarehouse,
        ListWarehouse,
        RawMaterialInventory,
        AddRawMaterial,
        },

    data(){
        return{
          item:{},
          suppliers:{},
          materials:{},
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
        console.log(response.data)
         this.items.push(this.item);
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