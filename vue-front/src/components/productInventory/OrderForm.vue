<template>
  <div>
 
  <div class="panel panel-info">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Order Form</h3>
    </div>
    </div>
    <div class="panel-body">
    <table class="table table-striped table-hover" v-show="isOrder">
    <tr>
    <th>
    Product Name
    </th>
    <th>
    Qty
    </th>
    <th>
    Unit Price
    </th>
    <th>
    Amount
    </th>
    <th>
    Date
    </th>
    </tr>
    <tr v-for="order in orders">
    <td>{{item.product_name}}</td>
    <td>{{order.quantity}}</td>
    <td>{{formatCurrency(item.list_price)}}</td>
    <td>{{formatCurrency(order.quantity*item.list_price)}}</td>
    <td>{{order.paid_date}}</td>


    </tr>
    </table>
    <form v-on:submit.prevent="addOrder">
      <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6">
           <div v-cloak>        
          <div class="form-group">
            <label>Customer:</label>
            <select v-model="order.customer_id" class="form-control" style="height:40px;">
            <option value="null" selected>Select Customer</option>
            <option v-for="c in customers" v-bind:value="c.id">{{c.company}}</option> 
          </select> 
          </div>
        </div>          

            
          
        </div>
        <div class="col-md-6">
       
        <p><router-link :to="{ name: 'create-customer' }">New Customer</router-link></p>
        </div>
        
        </div>

        


          <table class="table table-striped table-bordered">
          <thead>
          <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Date</th>
          </tr>
          </thead>
          <tr>
          <td>
          <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              
           <div v-cloak>        
          <div class="form-group">
            <select v-model="order.product_id"   :onchange="getSingleProduct()" class="form-control" style="height:40px;">
            <option value="null" selected>Select Product</option>
            <option v-for="p in products" v-bind:value="p.id">{{p.product_name}}</option> 
          </select> 
          </div>
          </div>

            </div>
          </div>
        </div>
          </td>
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input type="number" class="form-control" v-model="order.quantity" />
            </div>
          </div>
        </div>
          </td>
        
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input type="date" class="form-control date-picker" v-model="order.paid_date" />
            </div>
          </div>
        </div>
        
          </td>
          </tr>
          </table>

        </div>
        </div>
        <br><br>
                 
         

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Payment Method:</label>
              <select v-model="order.product_id" class="form-control" style="height:40px;">
            <option value="null" selected>Select Payment Method</option>
            <option v-for="pm in pms" v-bind:value="pm.id">{{pm.payment_method}}</option> 
          </select> 
            </div>
          </div>
        </div>

          
         

           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Additional Notes:</label>
              <textarea class="form-control" v-model="order.notes" ></textarea>
              
            </div>
          </div>
        </div>      

     
   
    <div class="panel-footer">
    <div class="form-group">
          <button class="btn btn-primary">Add to order</button>

          <button class="btn btn-success" @click="submitOrder()">Submit Order</button>
        </div>
    </div>
     </form>
    </div>

    
</div>
    
  </div>
</template>
<script>
  export default {
    data(){
        return{
          order:{},
          customers:{},
          products:{},
          pms:{},
          itemAmount:'',
          orders:[],
          product:{
          'product_id':'',

          },
          item:'',
          isOrder:false



        }
    },

     beforeMount: function()
        {
            this.getCustomers();
            this.getProducts();
            this.getPaymentMethods();
            this.getSingleProduct();
            this.submitOrder();
   


        },
    methods: {
      addOrder(){

               this.orders.push(this.order);
               this.isOrder = true;
              

        
    },

    submitOrder()
    {

console.log(this.orders);               

let uri = 'http://127.0.0.1:8000/api/orders';
        this.axios.post(uri, this.orders).then((response) => {
          this.$router.push({name: 'list-orders'})
        })
               
    },
    getCustomers(){
        let uri = 'http://127.0.0.1:8000/api/customers';
              this.axios.get(uri).then((response) => {
                  this.customers = response.data;
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

    

    getSingleProduct()
    {
        
        var product_id =this.order.product_id;
        this.product.product_id = product_id
        let uri = 'http://127.0.0.1:8000/api/order/item';
        this.axios.post(uri, this.product).then((response) => {
          this.item = response.data;

          console.log(this.item);
        })

    },
    formatCurrency(value)
    {
     let val = (value/1).toFixed(2).replace('.',',');
     return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
    }


  }
}
</script>