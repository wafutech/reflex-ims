<template>
    <div>
        <h3>Order By Customer</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Employee</td>
                <td>Order_date</td>
                <td>Customer</td>
                <td>Order Amount</td>
                <td>Status</td>
                <td>Additionational Notes</td>
                                
            </tr>
            </thead>

            <tbody>
                <tr  v-for="order in orders"
            :key="customer.id">
                    <td>{{ order.name }}</td>
                    <td>{{ order.order_date }}</td>
                    <td>{{ order.first_name }} {{ order.last_name }}</td>
                    <td>{{ order.order_status }}</td>
                    <td>{{ order.notes}}</td>                                  
                                       
                </tr>
            </tbody>
        </table>
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