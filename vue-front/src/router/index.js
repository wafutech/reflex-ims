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
import ShowAsset from '@/components/fixedassets/ShowAsset.vue';
import CreateSupplier from '@/components/suppliers/CreateSupplier.vue';
import DisplaySupplier from '@/components/suppliers/DisplaySupplier.vue';
import EditSupplier from '@/components/suppliers/EditSupplier.vue';
import DisplayAssetCategory from '@/components/assetcategories/DisplayAssetCategory.vue';
import EditAssetCategory from '@/components/assetcategories/EditAssetCategory.vue';
import CreateAssetCategory from '@/components/assetcategories/CreateAssetCategory.vue';
import CreateProduct from '@/components/productInventory/CreateProduct.vue';
import EditProduct from '@/components/productInventory/EditProduct.vue';
import ListProduct from '@/components/productInventory/ListProduct.vue';
import ReceiveInventory from '@/components/productInventory/ReceiveInventory.vue';
import CreateProductCategory from '@/components/productInventory/CreateProductCategory.vue';
import EditProductCategory from '@/components/productInventory/EditProductCategory.vue';
import ListProductCategory from '@/components/productInventory/ListProductCategory.vue';
import CreatePurchaseOrder from '@/components/productInventory/CreatePurchaseOrder.vue';
import EditPurchaseOrder from '@/components/productInventory/EditPurchaseOrder.vue';
import ListPurchaseOrder from '@/components/productInventory/ListPurchaseOrder.vue';
import ListOders from '@/components/productInventory/ListOrders.vue';
import SalesOrderForm from '@/components/orders/SalesOrderForm.vue';
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
import CompanySetup from '@/components/system/CompanySetup.vue';
import RawMaterial from '@/components/inventory/RawMaterial.vue';
import AddRawMaterial from '@/components/inventory/AddRawMaterial.vue';
import EditRawMaterial from '@/components/inventory/EditRawMaterial.vue';
import ListRawMaterial from '@/components/inventory/ListRawMaterial.vue';
import AddWarehouse from '@/components/inventory/AddWarehouse.vue';
import EditWarehouse from '@/components/inventory/EditWarehouse.vue';
import ListWarehouse from '@/components/inventory/ListWarehouse.vue';
import InventoryNavbar from '@/components/inventory/InventoryNavbar.vue';
import RawMaterialInventory from '@/components/inventory/RawMaterialInventory.vue';
import Inventory from '@/components/inventory/Inventory.vue';
import ReceiveFinishedGoods from '@/components/inventory/ReceiveFinishedGoods.vue';
import PurchaseOrderForm from '@/components/orders/PurchaseOrderForm.vue';


//import modalTemplate from '@/components/modalTemplate.vue';
import NotFound from '@/components/GeneralViews/NotFoundPage.vue';
import router from '@/router'
import VueAuth from '@websanova/vue-auth'
import AuthBearer from '@websanova/vue-auth'

/*Import chart components*/
import VueChartJs from '@/components/reports/charts/VueChartJs'
import VueCharts from '@/components/reports/charts/VueCharts'
import VueChartKick from '@/components/reports/charts/VueChartKick'
import LineChart from '@/components/reports/charts/LineChart'

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
   mode: 'history',
  routes: [
    {
      path: '/',
    component: Home,
    name: 'home'
    },

    {
      path: 'setup',
    component: CompanySetup,
    name: 'setup'
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
            auth:false
        }
        
    },
    {
      name: 'list-fixed-assets',
        path: '/assets',
        component: ListFixedAsset,
         meta: {
            auth:false
        }
    },
        {
        name: 'create-asset',
        path: '/assets/create',
        component: CreateAsset,
         meta: {
            auth:false
        }
        },
         {
        name: 'edit-asset',
        path: '/assets/edit',
        component: EditAsset,
         meta: {
            auth:false
        }
        },

        {
        name: 'show-asset',
        path: '/assets/show',
        component: ShowAsset,
         meta: {
            auth:false
        }
        },

           {
        name: 'list-suppliers',
        path: '/suppliers',
        component: DisplaySupplier,
         meta: {
            auth:false
        }
        },

           {
        name: 'create-supplier',
        path: '/suppliers/create',
        component: CreateSupplier,
         meta: {
            auth:false
        }
        },

           {
        name: 'edit-supplier',
        path: '/suppliers/edit',
        component: EditSupplier,
         meta: {
            auth:false
        }
        },
            {
        name: 'edit-asset-category',
        path: '/asset/categories/edit',
        component: EditAssetCategory,
         meta: {
            auth:false
        }
        },
            {
        name: 'display-asset-category',
        path: '/asset/categories',
        component: DisplayAssetCategory,
         meta: {
            auth:false
        }
        },

        {
        name: 'create-asset-category',
        path: '/categories/create',
        component: CreateAssetCategory,
         meta: {
            auth:false
        }
        },
        //Product inventory
        {
        name: 'create-product-category',
        path: '/products/categories/create',
        component: CreateProductCategory,
         meta: {
            auth:false
        }
        },
        {
        name: 'list-product-categories',
        path: '/product/categories',
        component: ListProductCategory,
         meta: {
            auth:false
        }
        },
        {
        name: 'edit-product-category',
        path: '/product/categories/edit',
        component: EditProductCategory,
         meta: {
            auth:false
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
            auth:false
        }
        },

        {
        name: 'list-products',
        path: '/products',
        component: ListProduct,
         meta: {
            auth:false
        }
        },

        {
        name: 'receive-stock',
        path: '/stock-inventories/receive',
        component: ReceiveInventory,
         meta: {
            auth:false
        }
        },

        {
        name: 'list-orders',
        path: '/orders',
        component: ListOders,
         meta: {
            auth:false
        }
        },
        {
        name: 'creat-sale-order',
        path: '/orders/create',
        component: SalesOrderForm,
         meta: {
            auth:false
        }
        },
        {
        name: 'create-purchase-order',
        path: '/purchases/create',
        component: PurchaseOrderForm,
         meta: {
            auth:false
        }
        },
        {
        name: 'edit-purchase-orders',
        path: '/purchases/id:/edit',
        component: EditPurchaseOrder,
         meta: {
            auth:false
        }
        },
        {
        name: 'list-purchase-orders',
        path: '/purchases',
        component: ListPurchaseOrder,
        meta: {
            auth:false
        }
    },
        {
        name: 'list-customers',
        path: '/customers',
        component: ListCustomer,
         meta: {
            auth:false
        }
        },

        {
        name: 'create-customer',
        path: '/customers/create',
        component: CreateCustomer,
         meta: {
            auth:false
        }
        },

        {
        name: 'edit-customer',
        path: '/customers/edit',
        component: EditCustomer,
         meta: {
            auth:false
        }
    },

        {
        name: 'depreciation-calculator',
        path: '/depreciation',
        component: DepreciationMethodsForm,
         meta: {
            auth:false
        }
    },

    {
        name: 'reducing-bal-depreciation',
        path: '/depreciation/reducingbal',
        component: ReducingBalance,
         meta: {
            auth:false
        }
    },
    {
        name: 'straight-line',
        path: '/depreciation/straight-line',
        component: StraightLine,
         meta: {
            auth:false
        }
    },

    {
        name: 'sum-years',
        path: '/depreciation/sum-years',
        component: SumYears,
         meta: {
            auth:false
        }
    },

    {
        name: 'unit-production',
        path: '/depreciation/unit-production',
        component: UnitProduction,
         meta: {
            auth:false
        }
    },

     {
        name: 'reports',
        path: '/reports',
        component: Reports,
         meta: {
            auth:false
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
            auth:false
        }
    }, 
    {
        name: 'new-orders',
        path: '/new-orders',
        component: NewOrders,
         meta: {
            auth:false
        }
    },
    {
        name: 'invoiced-orders',
        path: '/invoiced-orders',
        component: InvoicedOrders,
         meta: {
            auth:false
        }
    },
    {
        name: 'cancelled-orders',
        path: '/cancelled-orders',
        component: CancelledOrders,
         meta: {
            auth:false
        }
    },
    {
        name: 'shipped-orders',
        path: '/shipped-orders',
        component: ShippedOrders,
         meta: {
            auth:false
        }
    },
    {
        name: 'completed-orders',
        path: '/completed-orders',
        component: CompletedOrders,
         meta: {
            auth:false
        }
    },
    {
        name: 'orders-by-customer',
        path: '/orders-by-customer',
        component: OrderByCustomer,
         meta: {
            auth:false
        }
    },

    {
        name: 'orders-by-product',
        path: '/orders-by-product',
        component: OrderByProduct,
         meta: {
            auth:false
        }
    },

    {
        name: 'orders-by-employee',
        path: '/orders-by-employee',
        component: OrderByEmployee,
         meta: {
            auth:false
        }
    },

    {
        name: 'monthly-order-report',
        path: '/monthly-order-report',
        component: OrderMonthlyReport,
         meta: {
            auth:false
        }
    },

    {
        name: 'order-yearly-report',
        path: '/order-yearly-report',
        component: OrderYearlyReport,
         meta: {
            auth:false
        }
    },
    {
        name: 'periodic-order-reports-form',
        path: '/order-periodic-report-form',
        component: OrderPeriodicReportForm,
         meta: {
            auth:false
        }
    },

    {
        name: 'order-periodic-report',
        path: '/order-periodic-report',
        component: OrderPeriodicReport,
         meta: {
            auth:false
        }
    },
    {
        name: 'purchase-orders-report',
        path: '/purchase-orders-report',
        component: PurchaseOrders,
         meta: {
            auth:false
        }
    },

    {
        name: 'purchase-orders-report-byemployee',
        path: '/purchase-orders-by-employee',
        component: PurchaseOrderByEmployee,
         meta: {
            auth:false
        }
    },
    {
        name: 'purchase-orders-report-byvendor',
        path: '/purchase-orders-report-byvendor',
        component: PurchaseOrderByVendor,
         meta: {
            auth:false
        }
    },
    {
        name: 'purchase-orders-monthly-report',
        path: '/purchase-orders-monthly-report',
        component: PurchaseOrderMonthlyReport,
         meta: {
            auth:false
        }
    },
    {
        name: 'purchase-orders-yearly-report',
        path: '/purchase-orders-yearly-report',
        component: PurchaseOrderYearlyReport,
         meta: {
            auth:false
        }
    },
    {
        name: 'purchase-orders-periodic-report',
        path: '/purchase-orders-periodic-reports',
        component: PurchaseOrderPeriodicReportForm,
         meta: {
            auth:false
        }
    },
    {
        name: 'sales',
        path: '/sales',
        component: SalesByProduct,
         meta: {
            auth:false
        }
    },

    {
        name: 'sales-customer',
        path: '/sales-customer',
        component: SalesByCustomer,
         meta: {
            auth:false
        }
    },
    {
        name: 'sales-employee',
        path: '/sales-employee',
        component: SalesByEmployee,
         meta: {
            auth:false
        }
    },
    {
        name: 'sales-monthly-report',
        path: '/sales-monthly-report',
        component: SalesMonthlyReport,
         meta: {
            auth:false
        }
    },
    {
        name: 'sales-yearly-report',
        path: '/sales-yearly-report',
        component: SalesYearlyReport,
         meta: {
            auth:false
        }
    },
    {
        name: 'sales-periodic-report-form',
        path: '/sales-periodic-report-form',
        component: SalesPeriodicReportForm,
         meta: {
            auth:false
        }
    },
     {
        name: 'stock-levels',
        path: '/stock-levels',
        component: StockLevels,
         meta: {
            auth:false
        }
    },
     {
        name: 'transactions',
        path: '/transactions',
        component: TransactionLog,
         meta: {
            auth:false
        }
      },
    
    /**
        RAW-MATERIALS
    */

    {
        name: 'list-raw-materials',
        path: '/raw-materials',
        component: ListRawMaterial,
         meta: {
            auth:false
        }
      },

      {
        name: 'add-raw-material',
        path: '/raw-materials',
        component: AddRawMaterial,
         meta: {
            auth:false
        }
      },

      {
        name: 'edit-raw-material',
        path: '/raw-material-edit',
        component: EditRawMaterial,
         meta: {
            auth:false
        }
      },

      {
        name: 'list-ware-houses',
        path: '/warehousese',
        component: ListWarehouse,
         meta: {
            auth:false
        }
      },
      {
        name: 'create-ware-house',
        path: '/ware-houses/create',
        component: AddWarehouse,
         meta: {
            auth:false
        }
      },
      {
        name: 'edit-ware-house',
        path: '/ware-house/edit',
        component: EditWarehouse,
         meta: {
            auth:false
        }
      },

      {
        name: 'raw-material-inventories',
        path: '/raw-material/inventories',
        component: RawMaterialInventory,
         meta: {
            auth:false
        }
      },

      {
        name: 'inventories',
        path: '/inventories',
        component: Inventory,
         meta: {
            auth:false
        }
      },
      {
        name: 'finished-goods',
        path: '/stock/inventories',
        component: ReceiveFinishedGoods,
         meta: {
            auth:false
        }
      },

      {
        name: 'chartjs',
        path: '/chartjs',
        component: VueChartJs,
         meta: {
            auth:false
        }
      },

      {
        name: 'charts',
        path: '/charts',
        component: VueCharts,
         meta: {
            auth:false
        }
      },

       {
        name: 'chartkick',
        path: '/chart-kick',
        component: VueChartKick,
         meta: {
            auth:false
        }
      },



  { path: '*', 
  component: NotFound
   }





  ]
})

 Vue.router=router;
  Vue.axios=axios;
 App.router = Vue.router;

Vue.use(require('@websanova/vue-auth'),
{
  auth:require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http:require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router:require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});


/*const router = new VueRouter({
    mode:'history',
    routes

});*/