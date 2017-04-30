/***
Metronic AngularJS App Main Script
***/

/* Metronic App */
var MetronicApp = angular.module("MetronicApp", [
    "ui.router",
    "ui.bootstrap",
    "oc.lazyLoad",
    "ngSanitize"
],
function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

/* Configure ocLazyLoader(refer: https://github.com/ocombe/ocLazyLoad) */
MetronicApp.config(['$ocLazyLoadProvider', function($ocLazyLoadProvider) {
    $ocLazyLoadProvider.config({
        // global configs go here
    });
}]);

/********************************************
 BEGIN: BREAKING CHANGE in AngularJS v1.3.x:
*********************************************/
/**
`$controller` will no longer look for controllers on `window`.
The old behavior of looking on `window` for controllers was originally intended
for use in examples, demos, and toy apps. We found that allowing global controller
functions encouraged poor practices, so we resolved to disable this behavior by
default.

To migrate, register your controllers with modules rather than exposing them
as globals:

Before:

```javascript
function MyController() {
  // ...
}
```

After:

```javascript
angular.module('myApp', []).controller('MyController', [function() {
  // ...
}]);

Although it's not recommended, you can re-enable the old behavior like this:

```javascript
angular.module('myModule').config(['$controllerProvider', function($controllerProvider) {
  // this option might be handy for migrating old apps, but please don't use it
  // in new ones!
  $controllerProvider.allowGlobals();
}]);
**/

//AngularJS v1.3.x workaround for old style controller declarition in HTML
MetronicApp.config(['$controllerProvider', function($controllerProvider) {
  // this option might be handy for migrating old apps, but please don't use it
  // in new ones!
  $controllerProvider.allowGlobals();
}]);

/********************************************
 END: BREAKING CHANGE in AngularJS v1.3.x:
*********************************************/

/* Setup global settings */
MetronicApp.factory('settings', ['$rootScope', function($rootScope) {
    // supported languages
    var settings = {
        layout: {
            pageSidebarClosed: false, // sidebar menu state
            pageContentWhite: true, // set page content layout
            pageBodySolid: false, // solid body color state
            pageAutoScrollOnLoad: 1000 // auto scroll to top on page load
        },
        assetsPath: '../public/assets',
        globalPath: '../public/assets/global',
        layoutPath: '../public/assets/layouts/layout2',
    };

    $rootScope.settings = settings;

    return settings;
}]);

/* Setup App Main Controller */
MetronicApp.controller('AppController', ['$scope', '$rootScope', function($scope, $rootScope) {
    $scope.$on('$viewContentLoaded', function() {
        App.initComponents(); // init core components
        //Layout.init(); //  Init entire layout(header, footer, sidebar, etc) on page load if the partials included in server side instead of loading with ng-include directive
    });
}]);

/***
Layout Partials.
By default the partials are loaded through AngularJS ng-include directive. In case they loaded in server side(e.g: PHP include function) then below partial
initialization can be disabled and Layout.init() should be called on page load complete as explained above.
***/

/* Setup Layout Part - Header */
MetronicApp.controller('HeaderController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initHeader(); // init header
    });
}]);

/* Setup Layout Part - Sidebar */
MetronicApp.controller('SidebarController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initSidebar(); // init sidebar
    });
}]);

/* Setup Layout Part - Quick Sidebar */
MetronicApp.controller('QuickSidebarController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
       setTimeout(function(){
            QuickSidebar.init(); // init quick sidebar
        }, 2000)
    });
}]);

/* Setup Layout Part - Theme Panel */
MetronicApp.controller('ThemePanelController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Demo.init(); // init theme panel
    });
}]);

/* Setup Layout Part - Footer */
MetronicApp.controller('FooterController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initFooter(); // init footer
    });
}]);

/* Setup Rounting For All Pages */
MetronicApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    // Redirect any unmatched url
    $urlRouterProvider.otherwise("/dashboard");

    $stateProvider

        // Dashboard
        .state('dashboard', {
            url: "/dashboard",
            templateUrl: site_url + "dashboard",
            data: {pageTitle: 'Dashboard'},
            controller: "DashboardController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                            '../public/assets/global/plugins/morris/morris.css',
                            '../public/assets/global/plugins/morris/morris.min.js',
                            '../public/assets/global/plugins/morris/raphael-min.js',
                            '../public/assets/global/plugins/jquery.sparkline.min.js',

                            '../public/assets/pages/scripts/dashboard.min.js',
                            'angular/controllers/DashboardController.js',
                        ]
                    });
                }]
            }
        })

        // Category
        .state('category', {
            url: "/category",
            templateUrl: site_url + "category",
            data: {pageTitle: 'Categories'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/datatables/datatables.min.css',
                            '../public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',

                            '../public/assets/global/plugins/datatables/datatables.all.min.js',

                            '../public/assets/pages/scripts/table-datatables-managed.min.js',

                            'angular/controllers/GeneralPageController.js'
                        ]
                    });
                }]
            }
        })

        //Add Category
        .state('add_category', {
            url: "/add_category",
            templateUrl: site_url + "category_add_edit",
            data: {pageTitle: 'Add Category'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                            '../public/assets/global/plugins/select2/css/select2.min.css',
                            '../public/assets/global/plugins/select2/css/select2-bootstrap.min.css',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',

                            '../public/assets/global/plugins/select2/js/select2.full.min.js',
                            '../public/assets/pages/scripts/components-select2.min.js',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
                            '../public/assets/pages/scripts/components-bootstrap-tagsinput.min.js',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',

                            'angular/controllers/GeneralPageController.js',
                        ]
                    });
                }]
            }
        })

        //Add Category
        .state('edit_category', {
            url: "/edit_category/{id}",
            templateUrl: site_url + "category_add_edit/{id}",
            data: {pageTitle: 'Edit Category'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                            '../public/assets/global/plugins/select2/css/select2.min.css',
                            '../public/assets/global/plugins/select2/css/select2-bootstrap.min.css',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',

                            '../public/assets/global/plugins/select2/js/select2.full.min.js',
                            '../public/assets/pages/scripts/components-select2.min.js',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
                            '../public/assets/pages/scripts/components-bootstrap-tagsinput.min.js',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',

                            'angular/controllers/GeneralPageController.js',
                        ]
                    });
                }]
            }
        })

        // Product
        .state('product', {
            url: "/product",
            templateUrl: site_url + "product",
            data: {pageTitle: 'Products'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/datatables/datatables.min.css',
                            '../public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',

                            '../public/assets/global/plugins/datatables/datatables.all.min.js',

                            '../public/assets/pages/scripts/table-datatables-managed.min.js',

                            'angular/controllers/GeneralPageController.js'
                        ]
                    });
                }]
            }
        })

        //Add Product
        .state('add_product', {
            url: "/add_product",
            templateUrl: site_url + "product_add_edit",
            data: {pageTitle: 'Add Product'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                            '../public/assets/global/plugins/select2/css/select2.min.css',
                            '../public/assets/global/plugins/select2/css/select2-bootstrap.min.css',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',

                            '../public/assets/global/plugins/select2/js/select2.full.min.js',
                            '../public/assets/pages/scripts/components-select2.min.js',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
                            '../public/assets/pages/scripts/components-bootstrap-tagsinput.min.js',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',

                            'angular/controllers/GeneralPageController.js',
                        ]
                    });
                }]
            }
        })

        //Edit Product
        .state('edit_product', {
            url: "/edit_product/{id}",
            templateUrl: site_url + "product_add_edit/{id}",
            data: {pageTitle: 'Edit Product'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                            '../public/assets/global/plugins/select2/css/select2.min.css',
                            '../public/assets/global/plugins/select2/css/select2-bootstrap.min.css',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',

                            '../public/assets/global/plugins/select2/js/select2.full.min.js',
                            '../public/assets/pages/scripts/components-select2.min.js',
                            '../public/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
                            '../public/assets/pages/scripts/components-bootstrap-tagsinput.min.js',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',

                            'angular/controllers/GeneralPageController.js',
                        ]
                    });
                }]
            }
        })

        // AngularJS plugins
        .state('fileupload', {
            url: "/file_upload.html",
            templateUrl: "views/file_upload.html",
            data: {pageTitle: 'AngularJS File Upload'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'angularFileUpload',
                        files: [
                            '../public/assets/global/plugins/angularjs/plugins/angular-file-upload/angular-file-upload.min.js',
                        ]
                    }, {
                        name: 'MetronicApp',
                        files: [
                            'angular/controllers/GeneralPageController.js'
                        ]
                    }]);
                }]
            }
        })

        // UI Select
        .state('uiselect', {
            url: "/ui_select.html",
            templateUrl: "views/ui_select.html",
            data: {pageTitle: 'AngularJS Ui Select'},
            controller: "UISelectController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'ui.select',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/angularjs/plugins/ui-select/select.min.css',
                            '../public/assets/global/plugins/angularjs/plugins/ui-select/select.min.js'
                        ]
                    }, {
                        name: 'MetronicApp',
                        files: [
                            'angular/controllers/UISelectController.js'
                        ]
                    }]);
                }]
            }
        })

        // UI Bootstrap
        .state('uibootstrap', {
            url: "/ui_bootstrap.html",
            templateUrl: "views/ui_bootstrap.html",
            data: {pageTitle: 'AngularJS UI Bootstrap'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'MetronicApp',
                        files: [
                            'angular/controllers/GeneralPageController.js'
                        ]
                    }]);
                }]
            }
        })

        // Tree View
        .state('tree', {
            url: "/tree",
            templateUrl: "views/tree.html",
            data: {pageTitle: 'jQuery Tree View'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/jstree/dist/themes/default/style.min.css',

                            '../public/assets/global/plugins/jstree/dist/jstree.min.js',
                            '../public/assets/pages/scripts/ui-tree.min.js',
                            'angular/controllers/GeneralPageController.js'
                        ]
                    }]);
                }]
            }
        })

        // Form Tools
        .state('formtools', {
            url: "/form-tools",
            templateUrl: "views/form_tools.html",
            data: {pageTitle: 'Form Tools'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
                            '../public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
                            '../public/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css',
                            '../public/assets/global/plugins/typeahead/typeahead.css',

                            '../public/assets/global/plugins/fuelux/js/spinner.min.js',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
                            '../public/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',
                            '../public/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js',
                            '../public/assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js',
                            '../public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
                            '../public/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js',
                            '../public/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js',
                            '../public/assets/global/plugins/typeahead/handlebars.min.js',
                            '../public/assets/global/plugins/typeahead/typeahead.bundle.min.js',
                            '../public/assets/pages/scripts/components-form-tools-2.min.js',

                            'angular/controllers/GeneralPageController.js'
                        ]
                    }]);
                }]
            }
        })

        // Date & Time Pickers
        .state('pickers', {
            url: "/pickers",
            templateUrl: "views/pickers.html",
            data: {pageTitle: 'Date & Time Pickers'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/clockface/css/clockface.css',
                            '../public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                            '../public/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                            '../public/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css',
                            '../public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
                            '../public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',

                            '../public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                            '../public/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                            '../public/assets/global/plugins/clockface/js/clockface.js',
                            '../public/assets/global/plugins/moment.min.js',
                            '../public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js',
                            '../public/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
                            '../public/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',

                            '../public/assets/pages/scripts/components-date-time-pickers.min.js',

                            'angular/controllers/GeneralPageController.js'
                        ]
                    }]);
                }]
            }
        })

        // Custom Dropdowns
        .state('dropdowns', {
            url: "/dropdowns",
            templateUrl: "views/dropdowns.html",
            data: {pageTitle: 'Custom Dropdowns'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([{
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css',
                            '../public/assets/global/plugins/select2/css/select2.min.css',
                            '../public/assets/global/plugins/select2/css/select2-bootstrap.min.css',

                            '../public/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js',
                            '../public/assets/global/plugins/select2/js/select2.full.min.js',

                            '../public/assets/pages/scripts/components-bootstrap-select.min.js',
                            '../public/assets/pages/scripts/components-select2.min.js',

                            'angular/controllers/GeneralPageController.js'
                        ]
                    }]);
                }]
            }
        })

        // Advanced Datatables
        .state('datatablesAdvanced', {
            url: "/datatables/managed.html",
            templateUrl: "views/datatables/managed.html",
            data: {pageTitle: 'Advanced Datatables'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/datatables/datatables.min.css',
                            '../public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',

                            '../public/assets/global/plugins/datatables/datatables.all.min.js',

                            '../public/assets/pages/scripts/table-datatables-managed.min.js',

                            'angular/controllers/GeneralPageController.js'
                        ]
                    });
                }]
            }
        })

        // Ajax Datetables
        .state('datatablesAjax', {
            url: "/datatables/ajax.html",
            templateUrl: "views/datatables/ajax.html",
            data: {pageTitle: 'Ajax Datatables'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/datatables/datatables.min.css',
                            '../public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
                            '../public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',

                            '../public/assets/global/plugins/datatables/datatables.all.min.js',
                            '../public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                            '../public/assets/global/scripts/datatable.min.js',

                            'angular/scripts/table-ajax.js',
                            'angular/controllers/GeneralPageController.js'
                        ]
                    });
                }]
            }
        })

        // User Profile
        .state("profile", {
            url: "/profile",
            templateUrl: "views/profile/main.html",
            data: {pageTitle: 'User Profile'},
            controller: "UserProfileController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
                            '../public/assets/pages/css/profile.css',

                            '../public/assets/global/plugins/jquery.sparkline.min.js',
                            '../public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',

                            '../public/assets/pages/scripts/profile.min.js',

                            'angular/controllers/UserProfileController.js'
                        ]
                    });
                }]
            }
        })

        // User Profile Dashboard
        .state("profile.dashboard", {
            url: "/dashboard",
            templateUrl: "views/profile/dashboard.html",
            data: {pageTitle: 'User Profile'}
        })

        // User Profile Account
        .state("profile.account", {
            url: "/account",
            templateUrl: "views/profile/account.html",
            data: {pageTitle: 'User Account'}
        })

        // User Profile Help
        .state("profile.help", {
            url: "/help",
            templateUrl: "views/profile/help.html",
            data: {pageTitle: 'User Help'}
        })

        // Todo
        .state('todo', {
            url: "/todo",
            templateUrl: "views/todo.html",
            data: {pageTitle: 'Todo'},
            controller: "TodoController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            '../public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                            '../public/assets/apps/css/todo-2.css',
                            '../public/assets/global/plugins/select2/css/select2.min.css',
                            '../public/assets/global/plugins/select2/css/select2-bootstrap.min.css',

                            '../public/assets/global/plugins/select2/js/select2.full.min.js',

                            '../public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',

                            '../public/assets/apps/scripts/todo-2.min.js',

                            'angular/controllers/TodoController.js'
                        ]
                    });
                }]
            }
        })

}]);

/* Init global settings and run the app */
MetronicApp.run(["$rootScope", "settings", "$state", function($rootScope, settings, $state) {
    $rootScope.$state = $state; // state to be accessed from view
    $rootScope.$settings = settings; // state to be accessed from view
}]);
