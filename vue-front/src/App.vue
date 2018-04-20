<template>
    <div class="page-wrapper">
    <div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="float-left" style="color:white;">
    LOGO
    </DIV>
     <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           
        </div>

        <ul class="nav navbar-right top-nav">
<li>
                        <router-link :to="{ name: 'home' }">Home</router-link>
                    </li>
                    <li class="pull-right">
                        <router-link :to="{ name: 'depreciation-calculator' }">Depreciation Calculator</router-link>
                    </li>
                     <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'login' }">Login</router-link>
                    </li>
                    <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'register' }">Register</router-link>
                    </li>
                    <li v-if="$auth.check()" class="pull-right">
                        <a href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>            
        </ul>
 <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>

                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i>Fixed Assets  <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'create-asset' }">New Asset</router-link> </a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i><router-link :to="{ name: 'list-fixed-assets' }">Asset Register</router-link> </a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'display-asset-category' }"> Categories</router-link></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i>  Inventory <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'create-product' }"> New Product</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'list-products' }"> Product List</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'list-product-categories' }"> Categories</router-link></a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#customer-1"><i class="fa fa-fw fa-star"></i>  Customers <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="customer-1" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'create-customer' }"> New Customer</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'list-customers' }"> Customer List</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'orders-by-customer' }"> Customer Orders</router-link></a></li>
                        <li> <modal :show="showModal" @close="showModal = false"></modal>
                    <button id="show-modal" @click="showModal = true">New Post</button></li>
                    </ul>
                </li>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#order-1"><i class="fa fa-fw fa-star"></i>  Orders <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="order-1" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'create-customer' }"> New Order</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'list-orders' }"> Orders</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'orders-by-customer' }"> Customer Orders</router-link></a></li>
                    </ul>
                </li>

                <li>
                    <a href="investigaciones/favoritas"><i class="fa fa-fw fa-user-plus"></i>  <router-link :to="{ name: 'list-purchase-orders' }"> Purchase Orders</router-link></a></a>
                </li>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#calc-1"><i class="fa fa-fw fa-star"></i>  Depreciation Calculators <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="calc-1" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'straight-line' }"> Straight Line</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'reducing-bal-depreciation' }"> Declining Balance</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'unit-production' }"> Unit of Production</router-link></a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> <router-link :to="{ name: 'sum-years' }"> sum of Years</router-link></a></li>
                    </ul>
                </li>
                <li>
                    <a href="sugerencias"><i class="fa fa-fw fa-paper-plane-o"></i> <router-link :to="{ name: 'reports' }"> Reports</router-link></a></a>

                    
                </li>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
     <div id="page-wrapper">
        <div class="container-fluid">
                <router-view></router-view>

            <div class="row" id="main" >
                
                <div class="footer">
                <div class="footer-bottom">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <div class="copyright">

                    © 2018, Wafutech, All rights reserved

                </div>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <div class="design">

                     <a href="#">For Eloquent Modern Web Application </a> |  <a target="_blank" href="http://www.webenlance.com">Fullstack Web Developer</a>

                </div>

            </div>

        </div>

    </div>

</div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    </div>
    </div
</template>

import axios from 'axios';
export default {
  name: 'App'
  
  
        }