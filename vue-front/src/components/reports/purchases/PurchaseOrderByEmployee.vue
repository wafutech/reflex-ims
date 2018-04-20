<template>
    <div>
        <h3>Purchase Orders by Employee</h3>
        
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
                <td>Product Name</td>
                <td>Supplier</td>
                <td>Quantity</td>
                <td>Unit Cost</td>
                <td>Amount</td>
                <td>Purchase Order Date</td>
                                
            </tr>
            </thead>

            <tbody>
                <tr  v-for="purchase in purchases"
            :key="purchase.id">
                   <td>{{ purchase.name }}</td>

                    <td>{{ purchase.product_name }}</td>
                    <td>{{ purchase.id }}</td>
                    <td>{{ purchase.first_name }} {{ purchase.last_name }}</td>
                    <td>{{ purchase.quantity }}{{purchase.unit_code}}</td>
                    <td>{{ purchase.unit_cost }}</td>
                    <td>{{ purchase.amount}}</td>
                    <td>{{ purchase.created_at}}</td>                                  
                                       
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        purchases:[]
               
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
                  this.purchases = response.data;
                  console.log(this.purchases)
              });
            }
            
        }
    }
</script>