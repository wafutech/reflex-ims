<template>
    <div>
        <h3 class="title">Purchase Orders</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-purchase-order'}" class="btn btn-success">New Purchase Order</router-link>
          </div>
        </div><br />

        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Product Description</td>
                <td>Supplier</td>
                <td>Unit Measure</td>
                <td>Quantity</td>
                <td>Unit Cost</td>
                <td>Amount</td>
                <td>Employee</td>                
                 <td>Actions</td>
            </tr>
            </thead>

            <tbody>
                <tr v-for="purchase in purchases">
                    <td>{{ purchase.product_description }}</td>
                    <td>{{ purchase.description }}</td>
                    <td>{{ purchase.first_name }} {{ purchase.last_name }}</td>
                    <td>{{ purchase.quantity }} {{ purchase.unit_code }}</td>
                    <td>{{ purchase.unit_description }}</td>
                    <td>{{ purchase.unit_cost }}</td>
                    <td>{{ purchase.amount }}</td>
                    <td>{{ purchase.employee }}</td>
                    td><router-link :to="{name: 'edit-product-category', params: { id: purchase.id }}" class="btn btn-primary">Edit</router-link></td>                    
                    <td><button class="btn btn-danger" v-on:click="deleteCategory(purchase.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
        data(){
            return{
                purchases: []
            }
        },

        created: function()
        {
            this.fetchPurchases();
        },

        methods: {
            fetchPurchases()
            {
              let uri = 'http://localhost/ims/public/api/products/purchases';
              this.axios.get(uri).then((response) => {
                  this.purchases = response.data;
                  console.log(this.purchases);
              });
            },
            deletePurchase(id)
            {
              let uri = 'http://localhost/ims/public/api/products/purchases/${id}';
              this.purchases.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>