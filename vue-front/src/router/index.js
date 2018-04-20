import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import axios from 'axios';
import App from '@/App.vue';
import Dashboard from '@/components/Dashboard.vue';
import Home from '@/components/Home.vue';
import Register from '@/components/Auth/Register.vue';
import Loginform from '@/components/Auth/Loginform.vue';
import ListFixedAsset from '@/components/fixedassets/ListFixedAsset.vue';
import CreateAsset from '@/components/fixedassets/CreateAsset.vue';
import EditAsset from '@/components/fixedassets/EditAsset.vue';
import CreateSupplier from '@/components/suppliers/CreateSupplier.vue';
import DisplaySupplier from '@/components/suppliers/DisplaySupplier.vue';
import EditSupplier from '@/components/suppliers/EditSupplier.vue';
import DisplayAssetCategory from '@/components/assetcategories/DisplayAssetCategory.vue';
import EditAssetCategory from '@/components/assetcategories/EditAssetCategory.vue';
import CreateAssetCategory from '@/components/assetcategories/CreateAssetCategory.vue';
import CreateProduct from '@/components/productInventory/CreateProduct.vue';
import EditProduct from '@/components/productInventory/EditProduct.vue';
import ListProduct from '@/components/productInventory/ListProduct.vue';
import CreateProductCategory from '@/components/productInventory/CreateProductCategory.vue';
import EditProductCategory from '@/components/productInventory/EditProductCategory.vue';
import ListProductCategory from '@/components/productInventory/ListProductCategory.vue';
import CreatePurchaseOrder from '@/components/productInventory/CreatePurchaseOrder.vue';
import EditPurchaseOrder from '@/components/productInventory/EditPurchaseOrder.vue';
import ListPurchaseOrder from '@/components/productInventory/ListPurchaseOrder.vue';
import ListOders from '@/components/productInventory/ListOrders.vue';
import OrderForm from '@/components/productInventory/OrderForm.vue';
import ListCustomer from '@/components/customers/ListCustomer.vue';
import CreateCustomer from '@/components/customers/CreateCustomer.vue';
import EditCustomer from '@/components/customers/EditCustomer.vue';
import DepreciationMethodsForm from '@/components/fixedassets/depreciation/DepreciationMethodsForm.vue';
import StraightLine from '@/components/fixedassets/depreciation/StraightLine.vue';
import ReducingBalance from '@/components/fixedassets/depreciation/ReducingBalance.vue';
import SumYears from '@/components/fixedassets/depreciation/SumYears.vue';
import UnitProduction from '@/components/fixedassets/depreciation/UnitProduction.vue';
import Reports from '@/components/reports/Reports.vue';
import OrdersToDate from '@/components/reports/orders/OrdersToDate.vue';
import CompletedOrders from '@/components/reports/orders/CompletedOrders.vue';
import InvoicedOrders from '@/components/reports/orders/InvoicedOrders.vue';
import ShippedOrders from '@/components/reports/orders/ShippedOrders.vue';
import CancelledOrders from '@/components/reports/orders/CancelledOrders.vue';
import NewOrders from '@/components/reports/orders/NewOrders.vue';
import OrderByCustomer from '@/components/reports/orders/OrderByCustomer.vue';
import OrderByEmployee from '@/components/reports/orders/OrderByEmployee.vue';
import OrderByProduct from '@/components/reports/orders/OrderByProduct.vue';
import OrderMonthlyReport from '@/components/reports/orders/OrderMonthlyReport.vue';
import OrderYearlyReport from '@/components/reports/orders/OrderYearlyReport.vue';
import OrderPeriodicReportForm from '@/components/reports/orders/OrderPeriodicReportForm.vue';
import OrderPeriodicReport from '@/components/reports/orders/OrderPeriodicReport.vue';
import PurchaseOrders from '@/components/reports/purchases/PurchaseOrders.vue';
import PurchaseOrderByEmployee from '@/components/reports/purchases/PurchaseOrderByEmployee.vue';
import PurchaseOrderByVendor from '@/components/reports/purchases/PurchaseOrderByVendor.vue';
import PurchaseOrderMonthlyReport from '@/components/reports/purchases/PurchaseOrderMonthlyReport.vue';
import PurchaseOrderYearlyReport from '@/components/reports/purchases/PurchaseOrderYearlyReport.vue';
import PurchaseOrderPeriodicReportForm from '@/components/reports/purchases/PurchaseOrderPeriodicReportForm.vue';
import SalesByCustomer from '@/components/reports/sales/SalesByCustomer.vue';
import SalesByEmployee from '@/components/reports/sales/SalesByEmployee.vue';
import SalesByProduct from '@/components/reports/sales/SalesByProduct.vue';
import SalesByProductCategory from '@/components/reports/sales/SalesByProductCategory.vue';
import SalesMonthlyReport from '@/components/reports/sales/SalesMonthlyReport.vue';
import SalesYearlyReport from '@/components/reports/sales/SalesYearlyReport.vue';
import SalesPeriodicReportForm from '@/components/reports/sales/SalesPeriodicReportForm.vue';
import StockLevels from '@/components/reports/others/StockLevels.vue';
import TransactionLog from '@/components/reports/others/TransactionLog.vue';
//import modalTemplate from '@/components/modalTemplate.vue';
import NotFound from '@/components/GeneralViews/NotFoundPage.vue';
import router from '@/router';
import VueAuth from '@websanova/vue-auth'; 
import AuthBearer from '@websanova/vue-auth';

/*GeneralViews
//import NotFound from '@/components/GeneralViews/NotFoundPage.vue'

// Admin pages
/*import Overview from '@/components/Dashboard/Views/Overview.vue'
import UserProfile from '@/components/Dashboard/Views/UserProfile.vue'
import Notifications from '@/components/Dashboard/Views/Notifications.vue'
import Icons from '@/components/Dashboard/Views/Icons.vue'
import Maps from '@/components/Dashboard/Views/Maps.vue'
import Typography from '@/components/Dashboard/Views/Typography.vue'
import TableList from '@/components/Dashboard/Views/TableList.vue'*/
Vue.use(Router);
Vue.router = router
export default new Router({
  routes: [
    {
      path: '/',
    component: Home,
    name: 'home'
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
        
    },{
        path: '/login',
        name: 'login',
        component: Loginform,
        meta: {
            auth: false
        }
        
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
        
    },
    {
      name: 'list-fixed-assets',
        path: '/assets',
        component: ListFixedAsset,
         meta: {
            auth: true
        }
    },
        {
        name: 'create-asset',
        path: '/assets/create',
        component: CreateAsset,
         meta: {
            auth: true
        }
        },
         {
        name: 'edit-asset',
        path: '/assets/edit',
        component: EditAsset,
         meta: {
            auth: true
        }
        },

           {
        name: 'list-suppliers',
        path: '/suppliers',
        component: DisplaySupplier,
         meta: {
            auth: true
        }
        },

           {
        name: 'create-supplier',
        path: '/suppliers/create',
        component: CreateSupplier,
         meta: {
            auth: true
        }
        },

           {
        name: 'edit-supplier',
        path: '/supplies/id:',
        component: EditSupplier,
         meta: {
            auth: true
        }
        },
            {
        name: 'edit-asset-category',
        path: '/asset/categories/edit',
        component: EditAssetCategory,
         meta: {
            auth: true
        }
        },
            {
        name: 'display-asset-category',
        path: '/asset/categories',
        component: DisplayAssetCategory,
         meta: {
            auth: true
        }
        },

        {
        name: 'create-asset-category',
        path: '/categories/create',
        component: CreateAssetCategory,
         meta: {
            auth: true
        }
        },
        //Product inventory
        {
        name: 'create-product-category',
        path: '/products/categories/create',
        component: CreateProductCategory,
         meta: {
            auth: true
        }
        },
        {
        name: 'list-product-categories',
        path: '/product/categories',
        component: ListProductCategory,
         meta: {
            auth: true
        }
        },
        {
        name: 'edit-product-category',
        path: '/product/categories/edit',
        component: EditProductCategory,
         meta: {
            auth: true
        }
        },

        {
        name: 'create-product',
        path: '/products/create',
        component: CreateProduct
        },
        {
            name: 'edit-product',
        path: '/products/edit',
        component: EditProduct,
         meta: {
            auth: true
        }
        },

        {
        name: 'list-products',
        path: '/products',
        component: ListProduct,
         meta: {
            auth: true
        }
        },

        {
        name: 'list-orders',
        path: '/orders',
        component: ListOders,
         meta: {
            auth: true
        }
        },
        {
            name: 'create-orders',
        path: '/orders/create',
        component: OrderForm,
         meta: {
            auth: true
        }
        },
        {
        name: 'create-purchase-order',
        path: '/purchases/create',
        component: CreatePurchaseOrder,
         meta: {
            auth: true
        }
        },
        {
        name: 'edit-purchase-orders',
        path: '/purchases/id:/edit',
        component: EditPurchaseOrder,
         meta: {
            auth: true
        }
        },
        {
        name: 'list-purchase-orders',
        path: '/purchases',
        component: ListPurchaseOrder,
        meta: {
            auth: true
        }
    },
        {
        name: 'list-customers',
        path: '/customers',
        component: ListCustomer,
         meta: {
            auth: true
        }
        },

        {
        name: 'create-customer',
        path: '/customers/create',
        component: CreateCustomer,
         meta: {
            auth: true
        }
        },

        {
        name: 'edit-customer',
        path: '/customers/edit',
        component: EditCustomer,
         meta: {
            auth: true
        }
    },

        {
        name: 'depreciation-calculator',
        path: '/depreciation',
        component: DepreciationMethodsForm,
         meta: {
            auth: true
        }
    },

    {
        name: 'reducing-bal-depreciation',
        path: '/depreciation/reducingbal',
        component: ReducingBalance,
         meta: {
            auth: true
        }
    },
    {
        name: 'straight-line',
        path: '/depreciation/straight-line',
        component: StraightLine,
         meta: {
            auth: true
        }
    },

    {
        name: 'sum-years',
        path: '/depreciation/sum-years',
        component: SumYears,
         meta: {
            auth: true
        }
    },

    {
        name: 'unit-production',
        path: '/depreciation/unit-production',
        component: UnitProduction,
         meta: {
            auth: true
        }
    },

     {
        name: 'reports',
        path: '/reports',
        component: Reports,
         meta: {
            auth: true
        }
    },
    
    /*#####################
    # REPORTS
    ######################*/   

    {
        name: 'all-orders',
        path: '/all-orders',
        component: OrdersToDate,
         meta: {
            auth: true
        }
    }, 
    {
        name: 'new-orders',
        path: '/new-orders',
        component: NewOrders,
         meta: {
            auth: true
        }
    },
    {
        name: 'invoiced-orders',
        path: '/invoiced-orders',
        component: InvoicedOrders,
         meta: {
            auth: true
        }
    },
    {
        name: 'cancelled-orders',
        path: '/cancelled-orders',
        component: CancelledOrders,
         meta: {
            auth: true
        }
    },
    {
        name: 'shipped-orders',
        path: '/shipped-orders',
        component: ShippedOrders,
         meta: {
            auth: true
        }
    },
    {
        name: 'completed-orders',
        path: '/completed-orders',
        component: CompletedOrders,
         meta: {
            auth: true
        }
    },
    {
        name: 'orders-by-customer',
        path: '/orders-by-customer',
        component: OrderByCustomer,
         meta: {
            auth: true
        }
    },

    {
        name: 'orders-by-product',
        path: '/orders-by-product',
        component: OrderByProduct,
         meta: {
            auth: true
        }
    },

    {
        name: 'orders-by-employee',
        path: '/orders-by-employee',
        component: OrderByEmployee,
         meta: {
            auth: true
        }
    },

    {
        name: 'monthly-order-report',
        path: '/monthly-order-report',
        component: OrderMonthlyReport,
         meta: {
            auth: true
        }
    },

    {
        name: 'order-yearly-report',
        path: '/order-yearly-report',
        component: OrderYearlyReport,
         meta: {
            auth: true
        }
    },
    {
        name: 'periodic-order-reports-form',
        path: '/order-periodic-report-form',
        component: OrderPeriodicReportForm,
         meta: {
            auth: true
        }
    },

    {
        name: 'order-periodic-report',
        path: '/order-periodic-report',
        component: OrderPeriodicReport,
         meta: {
            auth: true
        }
    },
    {
        name: 'purchase-orders-report',
        path: '/purchase-orders-report',
        component: PurchaseOrders,
         meta: {
            auth: true
        }
    },

    {
        name: 'purchase-orders-report-byemployee',
        path: '/purchase-orders-by-employee',
        component: PurchaseOrderByEmployee,
         meta: {
            auth: true
        }
    },
    {
        name: 'purchase-orders-report-byvendor',
        path: '/purchase-orders-report-byvendor',
        component: PurchaseOrderByVendor,
         meta: {
            auth: true
        }
    },
    {
        name: 'purchase-orders-monthly-report',
        path: '/purchase-orders-monthly-report',
        component: PurchaseOrderMonthlyReport,
         meta: {
            auth: true
        }
    },
    {
        name: 'purchase-orders-yearly-report',
        path: '/purchase-orders-yearly-report',
        component: PurchaseOrderYearlyReport,
         meta: {
            auth: true
        }
    },
    {
        name: 'purchase-orders-periodic-report',
        path: '/purchase-orders-periodic-reports',
        component: PurchaseOrderPeriodicReportForm,
         meta: {
            auth: true
        }
    },
    {
        name: 'sales',
        path: '/sales',
        component: SalesByProduct,
         meta: {
            auth: true
        }
    },

    {
        name: 'sales-customer',
        path: '/sales-customer',
        component: SalesByCustomer,
         meta: {
            auth: true
        }
    },
    {
        name: 'sales-employee',
        path: '/sales-employee',
        component: SalesByEmployee,
         meta: {
            auth: true
        }
    },
    {
        name: 'sales-monthly-report',
        path: '/sales-monthly-report',
        component: SalesMonthlyReport,
         meta: {
            auth: true
        }
    },
    {
        name: 'sales-yearly-report',
        path: '/sales-yearly-report',
        component: SalesYearlyReport,
         meta: {
            auth: true
        }
    },
    {
        name: 'sales-periodic-report-form',
        path: '/sales-periodic-report-form',
        component: SalesPeriodicReportForm,
         meta: {
            auth: true
        }
    },
     {
        name: 'stock-levels',
        path: '/stock-levels',
        component: StockLevels,
         meta: {
            auth: true
        }
    },
     {
        name: 'transactions',
        path: '/transactions',
        component: TransactionLog,
         meta: {
            auth: true
        }
      },
    
  { path: '*', 
  component: NotFound
   }





  ]
})

 Vue.router=router;
 App.router = Vue.router;


Vue.use(require('@websanova/vue-auth'),
{
  auth:require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http:require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router:require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

//new Vue(App).$mount('#app');