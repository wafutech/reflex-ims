<template>
  <div>
    <h3 class="title">Fixed Asset Depreciation Calculator</h3>
    
    <div class="panel panel-default">
    <div class="panel-heading">
    <div v-cloak>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group" :onload="fetchDepreciationMethods()">
            <label>Select Depreciation Method:</label>
            <select v-model="selected_method" :onchange="loadDeprecianMethodForm()" class="form-control" style="height:40px;" placeholder="Select Depreciation Method">
            
            <option v-for="d in dpmethods" v-bind:value="d.depreciation_method">{{d.depreciation_method}}</option> 
          </select> 

          </div>
          </div>
          </div>
        </div>
    </div>
    </div>
<!--DEPRECIATION METHODS FORMS-->

<!--STRAIGHT LINE-->
<div v-if="showStraightLineForm">
  <div class="panel panel-success">
  <div class="panel-heading">
  <div class="panel-title">
  <h3>Straight Line Depreciation  Calculator</h3>
  </div>
  </div>
  <div class="panel-body">
     <form v-on:submit.prevent="straightLineDepCal">

      <div class="row">
      <div class="col-md-6">
      <div class="form-group">
            <label>Historical Cost:</label>
            <input type="number" class="form-control" v-model="asset.purchase_price" placeholed="This is usually the purchase price of the fixed asset">
            </div>
      </div>
      
      </div>
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Salvage Value:</label>
              <input type="number" class="form-control" v-model="asset.salvage_value" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="asset.useful_years" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <button class="btn btn-info">Calculate</button>
        </div>

      
</form>

  </div>
  </div>

</div>
<!--</STRAIGHTLINE>-->

<!-- REDUCING BALANCE-->
  <div v-if="showReducingBalForm">
  
  <div class="panel panel-success">
  <div class="panel-heading">
  <div class="panel-title">
  <h3>Declining Balance Depreciation Calculator</h3>
  </div>
  </div>
  <div class="panel-body">
  <div class="row">
  <div class="col-6">
  <form v-on:submit.prevent="reducingBalDepCal">
  <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Historical Cost:</label>
            <input type="number" class="form-control" v-model="reducingbal.purchase_price">
          </div>
        </div>
        </div>
        

                   
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="reducingbal.useful_years" />
            </div>
          </div>
        </div>
      <div class="form-group">
          <button class="btn btn-info">Calculate</button>
        </div>
  </form>

  </div>

  <div class="col-6">
  <p >reducingBalProjection</p>
  <div v-if="showReducingBalProjection">
  {{reducingBalProjection}}
  </div>
    </div>
  </div>
  
  </div>
  </div>


  </div>
<!-- </REDUCINGBAL>-->

<!--UNIT OF PRODUCTION-->
<div v-if="showUnitofProductionForm">

<div class="panel panel-success">
  <div class="panel-heading">
  <div class="panel-title">
  <h3>Units of Production Depreciation Calculator</h3>
  </div>
  </div>
  <div class="panel-body">
  <form v-on:submit.prevent="unitProductionDepCal" method="post">

  <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Historical Cost:</label>
            <input type="number" class="form-control" v-model="asset.purchase_price">
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Salvage Value:</label>
              <input type="number" class="form-control" v-model="asset.salvage_value" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="asset.useful_years" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Outer Shells Units:</label>
              <input type="number" class="form-control" v-model="asset.life_time_units" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Current Units:</label>
              <input type="number" class="form-control" v-model="asset.current_units" />
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <button class="btn btn-info">Calculate</button>
        </div>

  </form>
  </div>
  </div>

</div>
<!-- </UNITOFPRODUCTION>-->

<!-- SUM OF YEARS -->
<div v-if="showSumofYearsForm">

<div class="panel panel-success">
  <div class="panel-heading">
  <div class="panel-title">
  <h3>Sum of the Years Depreciation Calculator</h3>
  </div>
  </div>
  <div class="panel-body">
<form v-on:submit.prevent="sumYearsDepCal">
<div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Historical Cost:</label>
            <input type="number" class="form-control" v-model="asset.purchase_price">
          </div>
        </div>
        </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Salvage Value:</label>
              <input type="number" class="form-control" v-model="asset.salvage_value" />
            </div>
          </div>
        </div>
          
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Useful Years:</label>
              <input type="number" class="form-control" v-model="asset.useful_years" />
            </div>
          </div>
        </div>
      <div class="form-group">
          <button class="btn btn-primary">Calculate</button>
        </div>

</form>

  </div>
  </div>

</div>
<!-- </SUMOFYEARS>--> 
<!--WARNING MESSAGE-->
<div v-if="showWarning">
<div class="alert alert-warning">
<p>Please click in the dropdown above and choose asset 
depreciation method!</p>
</div>
</div> 
<!--CALCULATION RESULTS-->
<div  v-if="showResults">
<table class="table table-striped table-hover">
<tr><th>Annual Depreciation</th><td> {{formatCurrency(results)}}</td></tr>
<tr><th>Monthly Depreciation</th><td>{{formatCurrency(results/12)}} </td></tr>
<tr><th> Depreciation Period</th><td>{{this.asset.useful_years*12}} Months </td></tr>


</table>

</div>  
  </div>
</template>
<script>
  export default {
    data(){
        return{
          dpmethods:{},
          selected_method: '',
          showStraightLineForm: false,
          showReducingBalForm: false,
          showUnitofProductionForm:false,
          showSumofYearsForm:false,
          showWarning:false,
          //Input values
          reducingbal:{},
          asset:{},
          showResults:false,
          results:'',
          showReducingBalProjection:false,
          reducingBalProjection:''

        }

    },

    create: function()
        {
          this.fetchDepreciationMethods();
          this.straightLineDepCal();
          this.reducingBalDepCal();
          this.sumYearsDepCal();
          this.unitProductionDepCal();
        },
    methods: {

      fetchDepreciationMethods()
      {
      var _this = this;
        let uri = 'http://127.0.0.1:8000/api/lists/asset-depreciations';
        _this.axios.get(uri).then((depreciations) => {
        _this.dpmethods = depreciations.data;
      });
      },

      loadDeprecianMethodForm()
      {
      if(this.selected_method !=undefined)
      {
        if(this.selected_method=='Straight Line')
        {
        this.showStraightLineForm = true;
        this.showUnitofProductionForm = false;          this.showSumofYearsForm = false;
        this.showReducingBalForm = false;
        this.showWarning = false;
        }
        else if(this.selected_method=='Declining Balance')
        {
        this.showReducingBalForm = true;

        this.showStraightLineForm = false;
        this.showUnitofProductionForm =false;
        this.showSumofYearsForm = false;
        this.showWarning = false;

        }

        else if(this.selected_method=='Sum-of-the-years digits')
        {
        this.showReducingBalForm = false;

        this.showStraightLineForm = false;
        this.showUnitofProductionForm =false;
        this.showSumofYearsForm = true;
        this.showWarning = false;

        }

        else if(this.selected_method=='Units-of-production')
        {
        this.showReducingBalForm = false;

        this.showStraightLineForm = false;
        this.showUnitofProductionForm =true;
        this.showSumofYearsForm = false;
        this.showWarning = false;

        }

        else
        {
        this.showReducingBalForm = false;

        this.showStraightLineForm = false;
        this.showUnitofProductionForm =false;
        this.showSumofYearsForm = false;
        this.showWarning = true;
        }

      }

      },
      straightLineDepCal()
      {
      //This methods calculates depreciation using the straight line depreciation formular.
      var purchasePrice = this.asset.purchase_price;
      var salvageValue = this.asset.salvage_value;
      var usefulYears = this.asset.useful_years;
      var depreciableCost = purchasePrice-salvageValue;
      var yearlyDepreciation = depreciableCost/usefulYears;
      this.results = yearlyDepreciation;
      this.showResults =true;
      return results;

      },

      reducingBalDepCal()
      {
      var showResults =this.showResults = false;
      //Fetch historical cost from the user
        var purchasePrice = this.reducingbal.purchase_price;
        var reducingBalProjection = this.reducingBalProjection;
        var showReducingBalProjection = this.showReducingBalProjection;
        var results = this.results;


        //Fetch number of useful years.
        var usefulYears = this.reducingbal.useful_years;
      (function() {


  // A table row
  const Row = (nr, start, apdr) => ({
    year: nr,
    startValue: start,
    depExpense: start * apdr,
    endValue: start - (start * apdr)
  })

  // The calculation
  const decliningBalanceDepreciation = multiplier => (
    startValue,
    endValue,
    years
  ) => {
    const valueDecrease = startValue - endValue;
    // Applicable Percentage Depreciation Rate
    const apdr = (valueDecrease / years) / valueDecrease * multiplier;

    const rows = [
      Row(1, startValue, apdr)
    ];

    for (let i = 1; i < years; i += 1) {
      rows.push(
        Row(i + 1, last(rows).endValue, apdr)
      )
    }
    
    return rows;
  };
  
  const dblDecBalDep = decliningBalanceDepreciation(2);

     reducingBalProjection =dblDecBalDep(purchasePrice, 0, usefulYears);
    showReducingBalProjection = true;
    showResults = true;
    results = reducingBalProjection;


  /*console.log(
    dblDecBalDep(purchasePrice, 0, usefulYears)
  );*/


  function last(arr) { return arr[arr.length - 1]; }

}())
return reducingBalProjection;
      

      },
      sumYearsDepCal()
      {
      //Calculates depreciation based on sum of useful years formula
      //Hide results if any
      this.showResults = false;
      var purchasePrice = this.asset.purchase_price;
      var salvageValue = this.asset.salvage_value;
      var usefulYears = this.asset.useful_years;
      var usefulYearsReducing = usefulYears;
        for(var i= usefulYearsReducing;i>1;i-=1)
        {
            var sumYears = [usefulYearsReducing-=1];

        }

        var denominator = sumYears.reduce(add,0);
        function add(a,b)
        {
        return a+b;
        }
        denominator = denominator+usefulYears;
       
        //Compute depreciation
        
        usefulYears+=1;
        for(var j= usefulYears;j>1;j-=1)
        {
            var lifeDepreciation = [((usefulYears-=1)/denominator)*salvageValue];
        
        }
        this.results = lifeDepreciation;
        this.showResults = true;
        return results;


      },

      unitProductionDepCal()
      {
      //Calculate depreciation based on sum of units of production formula
      this.showResults = false;
      var purchasePrice = this.asset.purchase_price;
      var salvageValue = this.asset.salvage_value;
      var usefulYears = this.asset.useful_years;
      var lifeTimeUnits = this.asset.life_time_units;
      var currentUnits  = this.asset.current_units;
      //Check to ensure current units is not greater outer shell units
     /* if(currentUnits>lifeTimeUnits)
      {
      alert('Current units must be equal or less than outer shell units');
      return false;
      }
      else
      {*/
      var depreciableCost = purchasePrice-salvageValue;
        var depreciationRate = depreciableCost/lifeTimeUnits;
        var currentDepreciationCost =  depreciationRate*currentUnits;
        this.results = currentDepreciationCost;
        this.showResults = true;
        return results;
     // }

      
      },

      formatCurrency(value)
      {
      let val = (value/1).toFixed(2).replace(',', '.');
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");



      },

      calculateDepreciation(){
        let uri = 'http://localhost/ims/public/api/assets/depreciation/methods';
         this.axios.get(uri).then((response) => {
                  this.dpmethods = response.data;
                 
              });
       
    },
    }
  
}
</script>