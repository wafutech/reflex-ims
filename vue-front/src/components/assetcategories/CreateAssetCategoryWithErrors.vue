<template>
  <div>
    <h3 class="title">New Asset Category</h3>
     <div class="alert alert-success" v-if="submitted">
                Category created!
            </div>
    <form v-on:submit.prevent="addCategory">          
                    

           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <!--add Bootstrap .has-error if title field has errors -->
                <div class="form-group errors.asset_category ? ' :has-error' : '' ">
              <label>Category:</label>
              
              <input type="text" class="form-control" v-model="category.asset_category" />
              <form-error v-if="errors.asset_category" :errors="errors">
                        @{{ errors.asset_category }}
                    </form-error>
            </div>
            </div>
          </div>
        </div>

            <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <!--add Bootstrap .has-error if title field has errors-->
                <div class="form-group v-bind:errors.description ? ' :has-error' : '' ">
              <label>Description:</label>
              <input type="text" class="form-control" v-model="category.description" />

              <form-error v-if="errors.description" :errors="errors">
                        @{{ errors.description }}
                    </form-error>
                </div>
            </div>
          </div>
        </div>

        <div v-cloak>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group">
            <!-- add Bootstrap .has-error if title field has errors-->
                <div class="form-group v-bind:errors.class_id ? ' :has-error' : ''">
            <label>Class:</label>
            <select v-model="category.class_id" class="form-control" style="height:40px;">
            <option value="null" selected>Select Class</option>
            <option v-for="c in classes" v-bind:value="c.id">{{c.code}}</option> 
          </select> 

            <form-error v-if="errors.class_id" :errors="errors">
                        @{{ errors.class_id }}
                    </form-error>
              </div>
          </div>
          </div>
          </div>
        </div>

                     
          
        <br />

        <div class="form-group">
          <button class="btn btn-info">Save Category</button>
        </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
// import FormError component
import FormError from '../../components/FormError.vue';


  export default {

    data(){
        return{
          classes:{},
          category:{},
          submitted: false,

        // array to hold form errors
        errors: [],
        }
    },

    created: function()
        {
            this.retrieveCatgoryClasses();
           
        },
    methods: {

          retrieveCatgoryClasses(){
          var _this =this;
        let uri = 'http://127.0.0.1:8000/api/lists/asset-classes';
        axios.get(uri).then((classes) => {
        _this.classes = classes.data;
          
        })
    },
      addCategory(){
      var _this =this;
        let uri = 'http://127.0.0.1:8000/api/asset/categories';
        _this.axios.post(uri, _this.category).then(function(response) 
        {
        // form submission successful, reset post data and set submitted to true
          _this.categories = {asset_category:'',description:'',class_id:''};

        // clear previous form errors
                _this.$set('errors', '');

                _this.submitted = true;
          console.log(_this.response.data);
         

        },
        function(response)
        {
        // form submission failed, pass form  errors to errors array
                this.$set('errors', response.data);
        });
       

        
        
    }
  }
}
</script>