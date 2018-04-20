<template>
    <div>
        <h3>Order Yearly Report</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
           <tr v-for="order in orders">
           <th>{{order.year}}</th><td>{{order.orderAmount}}</td>
           </tr>
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