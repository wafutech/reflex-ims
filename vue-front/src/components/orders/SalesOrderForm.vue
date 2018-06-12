<template>
<!---------------
MAIN PAGE CONTAINER
-->
<div>
<div class="loader" v-if="loading">Loading....</div>
<!--PANEL-->


<div class="panel panel-info">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Sales Order Form</h3>
    </div>
    </div>



 <!--BEGIN PANEL BODY-->


  
    <div class="panel-body">
<!--List Order Items-->
<div class="row">
    <div class="col-md-12">
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
    <tr v-for="item in orderItems">
    <td>{{item.product_name}}</td>
    <td>{{item.quantity}}{{item.units}}</td>
    <td>{{formatCurrency(item.selling_price)}}</td>
    <td>{{formatCurrency(item.quantity*item.selling_price)}}</td>
    <td>{{item.order_date}}</td>
    </tr>
    <tr><td colspan="4"><strong>Total</strong></td><td><strong>{{formatCurrency(total)}}</strong></td></tr>
    </table>
    </div>
    </div>
<!--End of order items-->
<hr>



<!--ADD TO ORDER SECTION-->

<!--Customer-->
<div v-show="customerForm">
<div class="row">
    <div class="col-md-8">
     <div v-cloak>        
    <div class="form-group">
     <label>Customer:</label>
            <select v-model="order.customer_id" class="form-control" name="customer_id" v-validate="'required'" style="height:40px;">
            <option value="null" selected>Select Customer</option>
            <option v-for="c in customers" v-bind:value="c.id">{{c.customer_name}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('customer_id')">
          {{errors.first('customer_id')}}
            </div>
          <div class="col-md-4">
    <p><router-link :to="{ name: 'create-customer' }">New Customer</router-link></p>
    </div>

    </div>
    </div>
    </div>
    </div>
 <!--Continue button-->
    <div class="row">
    <div class="col-md-12">
    <button class="btn btn-default pull-right" @click="showProductForm">Continue..</button>
    </div>
    </div>
    <!--End Continue button-->

</div>

<!--</Customer>-->
<hr>
<!--=======================-->
<!--Add product section-->
<div v-show="showProductFrm">
<div class="row">
    <div class="col-md-12">
    <table class="table table-striped table-bordered">
          <thead>
          <tr>
          <th>Product</th>
          <th>Units</th>
          <th>Qty</th>
          <th>Selling Price</th>
          <th>Order Date</th>
          </tr>
          </thead>
          <tr>
          <td>
          <div class="row">
          <div class="col-md-12">
            <div class="form-group">            
           <div v-cloak>        
          <div class="form-group">
            <select v-model="item.product_id" name="product_id"  v-validate="'required'" class="form-control" style="height:40px;">
            <option value="null" selected>Select Product</option>
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
          </td>
          <td>
          
          <div class="row">
          <div class="col-md-12">
            <div class="form-group">            
           <div v-cloak>        
          <div class="form-group">
            <select v-model="item.units" name="unit_of_measure"  v-validate="'required'"  class="form-control" style="height:40px;">
            <option value="null" selected>Select Unit</option>
            <option v-for="u in units" v-bind:value="u.unit_code">{{u.unit_code}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('unit_of_measure')">

          {{errors.first('unit_of_measure')}}
              </div>
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
             
              <input type="number" name="quantity" v-validate="'required|numeric|min:1'" class="form-control" v-model="item.quantity" />
              <div class="help-block alert alert-danger" v-show="errors.has('quantity')">

          {{errors.first('quantity')}}
              </div>
            </div>
          </div>
        </div>
          </td>

          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
             
              <input type="number" name="selling_price" v-validate="'required|numeric'" class="form-control" v-model="item.selling_price" />
              <div class="help-block alert alert-danger" v-show="errors.has('selling_price')">

          {{errors.first('selling_price')}}
              </div>
            </div>
          </div>
        </div>
          </td>
        
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="date" class="form-control date-picker" v-model="order.order_date" />
            </div>
          </div>
        </div>
        
          </td>
          <tr><td colspan="3"></td>
          <div class="row">
          <div class="col-md-10">
            <div class="form-group">
             <label>Amount:</label>
             <input type="number" name="amount" class="form-control disabled" v-model="item.amount" disabled/>
             <input type="number" name="orderid" class="form-control disabled" v-model="item.order_id" disabled/>
              </div>
            </div>
            </div>


          <td><button class="btn btn-info" @click="addOrder">Add to order</button></td><td> <button class="btn btn-warning pull-right" @click="orderDone">Done</button></td></tr>
          </tr>
          </table>
          </div>
          
    </div>
    </div>

</div>
<!--=========================-->
<!--End add product section-->
<hr>
<!--Order Bio Data-->
<div v-show="showOrderBioForm">
<h3><small>Please Complete this Section Before Submiting the Order</small></h3>
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-12">
<div class="form-group">
   <label>Order Status</label>
   <select v-model="order.order_status_id"   class="form-control" v-validate="'required'" name="order_status" style="height:40px;">
            <option value="null" selected>Select Status</option>
            <option v-for="status in order_status" v-bind:value="status.id">{{status.order_status}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('order_status')">

          {{errors.first('order_status')}}
              </div>

  </div>
  </div>
  </div>
<!--Payment Status-->
 <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <label>Paid</label>
  <select name="paid" v-model="order.paid" v-validate="''">
              <option value="0" selected="yes">No</option>
              <option value="1">Yes</option>
              </select>
              <div class="help-block alert alert-danger" v-show="errors.has('paid')">

          {{errors.first('paid')}}
              </div>
  </div>
  </div>
  </div>

  <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <label>Paid Date</label>
  <input type="date" name="date_paid" v-model="order.date_paid" class="form-control date-picker">
  </div>
  </div>
  </div>
<div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <label>Payment Method:</label>
              <select v-model="order.payment_method_id" class="form-control" name="payment_method" v-validate="'required'" style="height:40px;">
            <option value="null" disabled>Select Payment Method</option>
            <option v-for="pm in pms" v-bind:value="pm.id">{{pm.payment_method}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('payment_method')">

          {{errors.first('payment_method')}}
              </div>
  </div>
  </div>
  </div>
</div>



<div class="col-md-6">
<div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <label>Expected Date:</label>
              <input type="date" name="expected_date" v-model="order.expected_date" class="form-control date-picker" v-validate="'required'">
          <div class="help-block alert alert-danger" v-show="errors.has('expected_date')">

          {{errors.first('expected_date')}}
              </div>
  </div>
  </div>

  <div class="col-md-12">
  <div class="form-group">
  <label>Deliver Fee:</label>
              <input type="number" name="delivery_fee" v-model="order.delivery_fee" class="form-control" v-validate="'required|numeric|min:0'">
          <div class="help-block alert alert-danger" v-show="errors.has('delivery_fee')">

          {{errors.first('delivery_fee')}}
              </div>
  </div>
  </div>

  </div>

    <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Additional Notes:</label>
              <textarea class="form-control" v-model="order.notes" ></textarea>
              </div>
          </div>
        </div> 
</div><!--End of right column -- order bio 


</div>
<!--End Order Bio Data-->



<!--END ADD TO ORDER SECTION-->
    
    <!--END PANEL BODY-->





</div>


    <!--PANEL FOOTER-->
    <div class="panel-footer">

    <div class="row">
<div class="md-12">
<button class="btn btn-success pull-right" @click="submitOrder()">Submit Order</button>
</div>
</div>
    </div> <!--</footer>-->


    </div><!--</panel>-->


<!--END OF PANEL-->

</div>
</div>
</template>
<script>
export default {
    data(){
        return{
        loading:true,
          order:{order_amount:'',},
          customers:{},
          products:{},
          pms:{},
          itemAmount:'',
          product:{
          'product_id':'',

          },
          item:{amount:'',order_id:'',},
          isOrder:false,
          order_paid:false,
          order_status:{},
          units:{},
          total:0,
customerForm:true,
showProductFrm:true,
showOrderBioForm:false,
product:[],

orderItems:[],
orderid:''


        }
    },
     beforeMount: function()
        {
            this.getCustomers();
            this.getProducts();
            this.getPaymentMethods();
            this.getOrderStatus();
            this.fetchUnitofMesuares();
 
        },
        Mounted:function()
        {

        },

        methods:
        {

       showProductForm()
        {
          this.showProductForm=true;
          this.customerFrm=false;

        },
        orderDone()
        {
            this.showProductFrm=false;
            this.showOrderBioForm=true;

        },



 addOrder(){
       
    
 this.$validator.validateAll().then(()=>
        {
this.item.product_name = this.findProductName().product_name
 this.item.amount = this.item.selling_price*this.item.quantity;
this.total = this.total+this.item.selling_price*this.item.quantity;

return this.axios.post('virtual/orders',this.item).then((items)=>{
            this.orderItems.push(items.data)
            console.log(items.data)
        this.isOrder=true;


        })
      
       
    })

        
                 },

      findProductName()
    {

    var product_id =this.item.product_id;
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


  getCustomers(){
         return this.axios.get('customers').then((response) => {
                  this.customers = response.data;
              });
                  this.loading=false;

    },

    getProducts(){
             return this.axios.get('products').then((response) => {
                  this.products = response.data;
              });

    },

    getPaymentMethods(){
        let uri = 'http://127.0.0.1:8000/api/payment-methods';
              this.axios.get('payment-methods').then((response) => {
                  this.pms = response.data;
              });
    },

   

    getOrderStatus()
    {
    return this.axios.get('order/status').then((response)=>
    {
    this.order_status = response.data;
    })
    },

    submitOrder()
    {
    this.$validator.validateAll().then(()=>
    {
    this.order.order_amount =this.total
    console.log('orders'+this.order)
     return this.axios.post('orders', this.order).then((response) => {
          //this.$router.push({name: 'list-orders'})
          this.orderid = response.data
          this.orderItems.order_id=this.orderid
          return this.saveOrderItems()

        })
    })
      
               
    },

    saveOrderItems()
    {
    /*for(var i=0; i<this.orderItems.length;i++)
    {
      var items=
      {
      order_id:this.orderid,
      amount:orderItems['amount'][i],
      product_id:orderItems['product_id'][i],
      units:orderItems['units'][i],
      quantity:orderItems['quantity'][i],
      selling_price:orderItems['selling_price'][i]

      }

      return this.axios.post('order/details',items).then((response)=>{
    console.log(response.data)
    }).catch((error)=>{console.log(error)}) 
    }*/

    return this.axios.post('order/details',this.orderItems).then((response)=>{
    console.log(response.data)
    }).catch((error)=>{console.log(error)}) 
    
    },

    fetchUnitofMesuares()
            {
             return this.axios.get('lists/unit-of-measures').then((response) => {
                  this.units = response.data;
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
