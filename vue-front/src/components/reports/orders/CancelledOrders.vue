<template>
    <div>
        <h3 class="title">Cancelled Orders <span class="pull-right"><router-link :to="{ name: 'reports'}" class="btn btn-success"><<Back</router-link></span></h3>
        
          <div class="panel panel-default">
          <div class="panel-heading">
          <div class="panel-title">
         <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Order No.</th>
                <th>Customer</th>
                <th>Order Amount</th>
                <th>Status</th>
                <th> Notes</th>
                                
            </tr>
            </thead>
            </table>
          </div>
          </div>
          <div class="panel-body">
         <table class="table table-hover table-striped">
         <tbody>
                <tr  v-for="order in orders"
            :key="order.id">
                    <td>{{ order.order_date }}</td>
                    <td>{{ order.id }}</td>
                    <td>{{ order.customer_name }} </td>
                    <td>{{ order.order_status }}</td>
                    <td>{{ order.notes}}</td>                              
                                       
                </tr>
            </tbody>

         </table>
          </div>
          </div>
          
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        orders:[]
               
         }
        },

        created: function()
        {
            this.fetchInventoryReports();
        },

        methods: {
            fetchInventoryReports()
            {
              let uri = 'http://localhost/ims/public/api/reports/${id}';
              this.axios.get(uri).then((response) => {
                  this.orders = response.data;
                  console.log(this.orders)
              });
            }
            
        }
    }
</script>