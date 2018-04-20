<template>
    <div>
        <h3 class="title">Products</h3>
               <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-product'}" class="btn btn-success">Add Product</router-link>
          </div>
        </div><br />

        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
            
                <th>Product Name</th>
                <th>Description</th>
                <th>Unit Cost</th>
                <th>Selling Price</th>
                <th>Quantity In Stock</th>
                <th>Min product</th>
                <th>Supply Capacity by:</th>
                 <th>Re-Order Level</th>
                 <th>Re-Order Quantity</th>
                <th>Created by:</th>
                 <th>Date</th>
            </tr>
            </thead>

            <tbody>
                <tr v-for="product in products"
            :key="product.id">
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.product_description }}</td>
                    <td>{{ product.unit_cost }}</td>
                    <td>{{ product.list_price }}</td>
                    <td>{{ product.min_order }}</td>
                    <td>{{ product.reorder_level }}</td>
                     <td>{{ product.reorder_quantity }}</td>
                    <td>{{ product.user_id}}</td>
                    <td>{{ product.created_at}}</td>
                    <td><router-link :to="{name: 'edit-product', params: { id: product.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" v-on:click="deleteproduct(product.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
                products: []
            }
        },

        created: function()
        {
            this.fetchProducts();
        },

        methods: {
            fetchProducts()
            {
              let uri = 'http://127.0.0.1:8000/api/products';
              this.axios.get(uri).then((response) => {
                  this.products = response.data;
                  console.log(this.products);
              });
            },
            deleteproduct(id)
            {
              let uri = `http://127.0.0.1:8000/api/products/${id}`;
              this.products.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>

