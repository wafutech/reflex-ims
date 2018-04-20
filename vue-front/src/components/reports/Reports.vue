<template>
<div>

  <h1>Reports</h1>
    <div class="row">
    <div class="col-md-6">

    <div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Orders</h3>
    </div>
    </div>
    <div class="panel-body">
    <ul>
    <li>
 <router-link :to="{ name: 'all-orders' }"> All Orders</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'new-orders' }"> New Orders</router-link> 
    </li>

    <li>
 <router-link :to="{ name: 'completed-orders' }"> Completed Orders</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'cancelled-orders' }"> Cancelled Orders</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'invoiced-orders' }">Invoiced Orders</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'orders-by-employee' }"> Order By Employee</router-link> 
    </li>
<li>
 <router-link :to="{ name: 'orders-by-customer' }"> Order By Customers</router-link> 
 </li>

 <li>
 <router-link :to="{ name: 'orders-by-product' }"> Order By Products</router-link> 
 </li>
 <li>
 <router-link :to="{ name: 'monthly-order-report' }"> Order Monthly Report</router-link> 
 </li>
 <li>
 <router-link :to="{ name: 'order-yearly-report' }"> Order Annual Report</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'periodic-order-reports-form' }"> Order Custom Periodic Report</router-link> 
    </li>
    </ul>
    </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Sales</h3>
    </div>
    </div>
    <div class="panel-body">
    <ul>
    <li>
 <router-link :to="{ name: 'sales' }">Total Sales by Product</router-link> 
    </li>
   
    <li>
 <router-link :to="{ name: 'sales-customer' }"> Sales by Customer</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'sales-employee' }"> Sales by Employee</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'sales-monthly-report' }"> Monthly Sales</router-link> 
    </li>
<li>
 <router-link :to="{ name: 'sales-yearly-report' }"> Yearly Sales</router-link> 
    </li>
<li>
 <router-link :to="{ name: 'sales-periodic-report-form' }"> Sales Custom Periodic Report</router-link> 
    </li>

    </ul>
    </div>
    </div>
    </div>
    </div>


    <div class="row">
    <div class="col-md-6">
    
    <div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Purchases</h3>
    </div>
    </div>
    <div class="panel-body">
     <ul>
    <li>
 <router-link :to="{ name: 'purchase-orders-report' }"> All Purchases</router-link> 
    </li>
   
    <li>
 <router-link :to="{ name: 'purchase-orders-report-byemployee' }"> Purchase Orders By Employee</router-link> 
    </li>

    <li>
 <router-link :to="{ name: 'purchase-orders-report-byvendor' }"> Purchase Orders By Supplier</router-link> 
    </li>

 <li>
 <router-link :to="{ name: 'purchase-orders-monthly-report' }"> Purchase Orders Monthly Report</router-link> 
 </li>
 <li>
 <router-link :to="{ name: 'purchase-orders-yearly-report' }">Purchase Orders Yearly Report</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'purchase-orders-periodic-report' }"> Purchase Order Custom Periodic Report</router-link> 
    </li>
    </ul>
    </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title">
    <h3>Other Reports</h3>
    </div>
    </div>
    <div class="panel-body">
     <ul>
    <li>
 <router-link :to="{ name: 'list-products' }"> Fixed Asset List</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'list-products' }"> Acc Depreciation by Asset</router-link> 
    </li>

    <li>
 <router-link :to="{ name: 'list-products' }">Fixed Asset Projected Depreciation</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'stock-levels' }"> Stock Levels</router-link> 
    </li>
    <li>
 <router-link :to="{ name: 'transactions' }"> Transaction Log</router-link> 
    </li>
<li>
 <router-link :to="{ name: 'list-products' }"> Products List</router-link> 
 </li>
 

   
    </ul>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</template>
