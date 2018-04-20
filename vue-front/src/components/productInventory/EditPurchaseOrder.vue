<template>
    <div>
        <h3 class="title">Edit Product Purchase Order</h3>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-product-PurchaseOrder' }" class="btn btn-success">Return to Categories</router-link></div>
        </div>

        <form v-on:submit.prevent="updatePurchaseOrder">
            
            <div class="form-group">
                <label name="Product">PurchaseOrder</label>
                <input type="text" class="form-control" v-model="PurchaseOrder.product_id">
            </div>

             <div class="form-group">
                <label name="description">Supplier</label>
                <input type="text" class="form-control" v-model="PurchaseOrder.supplier_id">
            </div>

            <div class="form-group">
                <label name="quantity">Quantity</label>
                <input type="number" class="form-control" v-model="PurchaseOrder.quantity">
            </div>

            <div class="form-group">
                <label name="unit_cost">Unit Cost</label>
                <input type="number" class="form-control" v-model="PurchaseOrder.unit_cost">
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
                PurchaseOrder:{}
            }
        },

        created: function(){
            this.getPurchaseOrders();
        },

        methods: {
            getPurchaseOrder()
            {
              let uri = `http://localhost/ims/public/api/purchases/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.PurchaseOrder = response.data;
                });
            },

            updatePurchaseOrder()
            {
              let uri = 'http://localhost/ims/public/api/products/'+this.$route.params.id;
                this.axios.patch(uri, this.PurchaseOrder).then((response) => {
                  this.$router.push({name: 'list-purchase-orders'});
                });
            }
        }
    }
</script>