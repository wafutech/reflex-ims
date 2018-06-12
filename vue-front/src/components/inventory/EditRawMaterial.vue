<template>
    <div>
        <h3 class="title">Edit Raw Materials</h3>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'list-raw-materials' }" class="btn btn-success">Back</router-link></div>
        </div>

        <form v-on:submit.prevent="updateRawMaterial">
            <div class="form-group">
                <label>Raw Material Name</label>
                <input type="text" name="raw_material_name" class="form-control" v-model="raw_material.raw_material_name" v-validate="'required'">
                <div class="help-block" alert alert-danger v-show="errors.has('raw_material_name')">
                {{errors.first('raw_material_name')}}
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="raw_material_desc" class="form-control" v-model="raw_material.raw_material_desc" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('raw_material_desc')">
                {{errors.first('raw_material_desc')}}
                </div>
            </div>

            <div class="form-group">
                <label>Quantity in Hand:</label>
                <input type="text" name="quantity_in_hand" class="form-control" v-model="raw_material.quantity_in_hand" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('quantity_in_hand')">
                {{errors.first('quantity_in_hand')}}
                </div>
            </div>

            <div class="form-group">
                <label>Quantity in Hand:</label>
                <input type="text" name="quantity_in_hand" class="form-control" v-model="raw_material.quantity_in_hand" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('quantity_in_hand')">
                {{errors.first('quantity_in_hand')}}
                </div>
            </div>

            <!--Unit of Measure-->
            <div class="form-group">
              <label>Unit of Measure</label>
              <select name="unit_of_measure" v-model="item.unit_of_measure" class="form-control" style="height:40px;" v-validate=" 'required'"  >
             <option v-for="unit in units" v-bind:value="unit.id">{{unit.unit_description}}</option> 
          </select> 
              <div v-show="errors.has('unit_of_measure')" class="help-block alert alert-danger">
              {{errors.first('unit_of_measure')}}
              </div>
            </div>


           <div v-cloak>        
          <div class="form-group">
            <label>Prefered Supplier:</label>
            <select v-model="item.prefered_supplier" name="prefered_supplier" v-validate="'required'" class="form-control" style="height:40px;">            
            <option v-for="c in suppliers" v-bind:value="c.id">{{c.company}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('prefered_supplier')">
          {{errors.first('prefered_supplier')}}
          </div>
          </div>
          </div>

          <div class="form-group">
                <label>Value (The monitory value of the Qty in Hand Inventory):</label>
                <input type="text" name="starting_value" class="form-control" v-model="raw_material.starting_value" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('starting_value')">
                {{errors.first('starting_value')}}
                </div>
            </div>

            <div class="form-group">
                <label>Re-Order Level:</label>
                <input type="text" name="reorder_level" class="form-control" v-model="raw_material.reorder_level" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('reorder_level')">
                {{errors.first('reorder_level')}}
                </div>
            </div>

            <div class="form-group">
                <label>Re-Order Quantity:</label>
                <input type="text" name="reorder_quantity" class="form-control" v-model="raw_material.reorder_quantity" v-validate="'string'">
                <div class="help-block" alert alert-danger v-show="errors.has('reorder_quantity')">
                {{errors.first('reorder_quantity')}}
                </div>
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
                raw_material:{},
                suppliers:{},
                units:{}

            }
        },

        created: function(){
            this.updateRawMaterial();
            this.getSuppliers();
            this.fetchUnitofMesuares();
            this.getRawMaterials();
        },

        methods: {
            getRawMaterials()
            {
              let uri = `http://127.0.0.1:8000/api/raw-materials/${this.$route.params.id}/edit`;
                this.axios.get(uri).then((response) => {
                    this.raw_material = response.data;
                });
            },

            updateRawMaterial()
            {
              let uri = 'http://127.0.0.1:8000/api/Products/'+this.$route.params.id;
                this.axios.patch(uri, this.raw_material).then((response) => {
                  this.$router.push({name: 'list-product'});
                });
            },

            getSuppliers(){
        let uri = 'http://127.0.0.1:8000/api/suppliers';
              this.axios.get(uri).then((response) => {
                  this.suppliers = response.data;
              });
    },

          fetchUnitofMesuares()
            {
              let uri = 'http://127.0.0.1:8000/api/lists/unit-of-measures';
              this.axios.get(uri).then((response) => {
                  this.units = response.data;
              });
            }
        }
    }
</script>