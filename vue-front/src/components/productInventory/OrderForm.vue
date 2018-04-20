<template>
  <div>
 
  <div class="panel panel-info">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Order Form</h3>
    </div>
    </div>
    <div class="panel-body">
    <form v-on:submit.prevent="addOrder">
      <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label>Customer:</label>
            <select name="customer_id" v-model="customers">
            <option value="">{{customers.asset_description}}</option>
            </select>
            <input v-validate.initial="'required|email'" :class="{'form-control': true, 'is-danger': errors.has('email') }" type="text" class="form-control" v-model="order.customer_id">
                  

            
          </div>
        </div>
        <div class="col-md-3">
       
        <p><router-link :to="{ name: 'create-customer' }">New Customer</router-link></p>
        </div>
        <div class="col-md-3">
        <p>User Name</p>
        </div>
        </div>
          <table class="table table-striped table-bordered">
          <thead>
          <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Amount</th>
          <th>Date</th>
          </tr>
          </thead>
          <tr>
          <td>
          <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input type="text" class="form-control col-md-6" v-model="order.product_id" />
            </div>
          </div>
        </div>
          </td>
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input type="number" class="form-control col-md-6" v-model="order.quantity" />
            </div>
          </div>
        </div>
          </td>
          <td>0.0</td>
          <td>0.0</td>
          <td>
           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label></label>
              <input type="date" class="form-control col-md-6 date-picker" v-model="order.paid_date" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Order Total</label>
              <input type="number" class="form-control col-md-6 disabled" v-model="order.order_amount" />
            </div>
          </div>
        </div>
        <a href="#" id="moreProduct" class="btn btn-default">Add More</a>
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
              <input type="text" class="form-control col-md-6" v-model="order.payment_method_id" />
            </div>
          </div>
        </div>

          
         

           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Additional Notes:</label>
              <textarea class="form-control col-md-6" v-model="order.notes" ></textarea>
              
            </div>
          </div>
        </div>      

     
   
    <div class="panel-footer">
    <div class="form-group">
          <button class="btn btn-primary">Add to order</button>
        </div>
    </div>
     </form>
    </div>
}
}
    
</div>
    
  </div>
</template>
<script>
  export default {
    data(){
        return{
          order:{},
          customers:[]
        }
    },
    methods: {
      addOrder(){
        let uri = 'http://localhost/ims/public/api/orders';
        this.axios.post(uri, this.order).then((response) => {
          this.$router.push({name: 'list-orders'})
        })
    },
    getCustomers(){
        let uri = 'http://localhost/ims/public/api/assets';
              this.axios.get(uri).then((response) => {
                  this.customers = response.data;
                  console.log(this.customers);
              });
    }


  }
}
</script>