<template>
    <div>
        <h3>Stock Levels</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Product</td>
                <td>Quantity In Stock</td>
                <td>Re-Order Level</td>
                              
                                
            </tr>
            </thead>

            <tbody>
                <tr  v-for="stock in stocks">
                    <td>{{ stock.product_name }}</td>
                    <td>{{ stock.quantity_in_hand }}</td>
                    <td>{{stock.reorder_level}}</td>
                    
                                       
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        stock:[]
               
         }
        },

        created: function()
        {
            this.fetchInventoryReports();
        },

        methods: {
            fetchInventoryReports()
            {
              let uri = 'http://localhost/ims/public/api/reports/stocklevels';
              this.axios.get(uri).then((response) => {
                  this.stock = response.data;
                  console.log(this.stock)
              });
            }
            
        }
    }
</script>