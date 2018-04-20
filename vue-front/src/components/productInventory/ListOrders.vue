<template>
    <div>
    <ul class="nav nav-pills">
  <li class="active"> <router-link :to="{ name: 'create-orders'}">New Order</router-link></li>
  <li><a href="#">Need Invoicing</a></li>
  <li><a href="#">Ready to Ship</a></li>
  <li><a href="#">Awaiting Payment</a></li>
  <li><a href="#">Completed Orderst</a></li>
  <li><a href="#">Customers</a></li>
  <li><a href="#">Suppliers</a></li>



</ul>
        <h3 class="title">Orders</h3>
               <div class="row">
          <div class="col-md-12"></div>
          
        </div><br />

        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Order Date</td>
                <td>Customer</td>
                <td>Amount</td>
                <td>Date Paid</td>
                <td>Order Status</td>
                <td>Notes</td>
                <td>Completed by:</td>
                 <td>Actions</td>
            </tr>
            </thead>

            <tbody>
                <tr v-for="order in orders">
                    <td>{{ orders.order_date }}</td>
                    <td>{{ order.customer_id }}</td>
                    <td>{{ order.amount }}</td>
                    <td>{{ order.date_paid }}</td>
                    <td>{{ order.order_status_id }}</td>
                    <td>{{ order.notes }}</td>
                    <td>{{ order.user_id}}</td>
                    
                    <td><button class="btn btn-danger" v-on:click="deleteOrder(order.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
        data(){
            return{
                orders: []
            }
        },

        created: function()
        {
            this.fetchOrders();
        },

        methods: {
            fetchOrders()
            {
              let uri = 'http://localhost/ims/public/api/orders';
              this.axios.get(uri).then((response) => {
                  this.orders = response.data;
                  console.log(this.orders);
              });
            },
            deleteOrder(id)
            {
              let uri = `http://localhost/ims/public/api/orders/${id}`;
              this.orders.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>