<template>
    <div>
        <h3 class="title">Edit Product</h3>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-products' }" class="btn btn-success">Return to Products</router-link></div>
        </div>

        <form v-on:submit.prevent="updateProduct">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" class="form-control" v-model="product.product_name">
            </div>

            <div class="form-group">
                <label name="product_description">Category</label>
                <input type="text" class="form-control" v-model="product.product_description">
            </div>

             <div class="form-group">
                <label name="category_id">Category</label>
                <input type="text" class="form-control" v-model="product.category_id">
            </div>

             <div class="form-group">
                <label name="unit_cost">Unit Cost</label>
                <input type="text" class="form-control" v-model="product.unit_cost">
            </div>

             <div class="form-group">
                <label name="list_price">Selling Price</label>
                <input type="text" class="form-control" v-model="product.list_price">
            </div>

             <div class="form-group">
                <label name="reorder_level">Re-Order Level</label>
                <input type="number" class="form-control" v-model="product.reorder_level">
            </div>

             <div class="form-group">
                <label name="reorder_quantity">Re-Order Quantity Years</label>
                <input type="number" class="form-control" v-model="product.reorder_quantity">
            </div>

             <div class="form-group">
                <label name="units">Units</label>
                <input type="text" class="form-control" v-model="product.unit_id">
            </div>
            <div class="form-group">
                 <button class="btn btn-success pull-right">Update</button>
            </div>
             

            
        </form>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                Product:{}
            }
        },

        created: function(){
            this.getProduct();
        },

        methods: {
            getProduct()
            {
              let uri = `http://127.0.0.1:8000/api/products/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.Product = response.data;
                });
            },

            updateProduct()
            {
              let uri = 'http://127.0.0.1:8000/api/Products/'+this.$route.params.id;
                this.axios.patch(uri, this.product).then((response) => {
                  this.$router.push({name: 'list-product'});
                });
            }
        }
    }
</script>