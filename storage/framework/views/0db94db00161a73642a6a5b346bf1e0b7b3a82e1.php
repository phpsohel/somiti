<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" />
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="manifest" href="<?php echo e(url('manifest.json')); ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-datepicker.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/jquery-timepicker/jquery.timepicker.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/awesome-bootstrap-checkbox.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-select.min.css'); ?>" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/font-awesome/css/font-awesome.min.css'); ?>" type="text/css">
    <!-- Drip icon font-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/dripicons/webfont.css'); ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('public/css/grasp_mobile_progress_circle-1.0.0.min.css'); ?>" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css'); ?>" type="text/css">
    <!-- virtual keybord stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/keyboard/css/keyboard.css'); ?>" type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/daterange/css/daterangepicker.min.css'); ?>" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('public/css/style.default.css'); ?>" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/css/dropzone.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('public/css/style.css'); ?>">
    <!-- Tweaks for older IEs-->

    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/bootstrap-datepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.timepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/popper.js/umd/popper.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap/js/bootstrap-select.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/keyboard/js/jquery.keyboard.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/js/grasp_mobile_progress_circle-1.0.0.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery.cookie/jquery.cookie.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/chart.js/Chart.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/js/charts-custom.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/js/front.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/daterange/js/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/daterange/js/knockout-3.4.2.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/daterange/js/daterangepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/js/dropzone.js'); ?>"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/pdfmake.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/vfs_fonts.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.buttons.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.bootstrap4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.colVis.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.html5.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.print.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/sum().js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.checkboxes.min.js'); ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js">
    </script>
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('public/css/custom-' . $general_setting->theme); ?>" type="text/css" id="custom-style">
</head>

<body onload="myFunction()">
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <div class="main-menu">
                <ul id="side-main-menu" class="side-menu list-unstyled">
                    <li>
                        <a href="<?php echo e(url('/')); ?>">
                            <i class="dripicons-meter"></i>
                            <span><?php echo e(__('file.dashboard')); ?></span>
                        </a>
                    </li>
                    <?php
                    $role = DB::table('roles')->find(Auth::user()->role_id);
                    $category_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'category'], ['role_id', $role->id]])
                        ->first();
                    $index_permission = DB::table('permissions')
                        ->where('name', 'products-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    <li>
                        <a href="#people" aria-expanded="false" data-toggle="collapse">
                            <i class="dripicons-user"></i><span><?php echo e(trans('Member')); ?></span>
                        </a>
                        <ul id="people" class="collapse list-unstyled ">
                            <li id="customer-list-menu">
                                <a href="<?php echo e(route('memberinfo.index')); ?>">
                                    <?php echo e(trans('Member List')); ?>

                                </a>
                            </li>
                            <li id="customer-create-menu">
                                <a href="<?php echo e(route('memberinfo.create')); ?>">
                                    <?php echo e(trans('Add Member')); ?>

                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Generate deposite  -->
                    <li>
                        <a href="#general" aria-expanded="false" data-toggle="collapse">
                            <i class="fa fa-university" aria-hidden="true"></i><span>Generate Deposit</span>
                        </a>
                        <style>
                            .side-navbar{
                                width:250px!important;
                            }
                        </style>
                        <ul id="general" class="collapse list-unstyled">
                            <li id="general-add-daily-deposit-menu">
                                <a href="<?php echo e(route('dailydeposit.create')); ?>">
                                    Generate Daily Deposit
                                </a>
                            </li>
                            <li id="general-add-weekly-deposit-menu">
                                <a href="<?php echo e(route('weeklydeposit.create')); ?>">
                                    Generate weekly deposit
                                </a>
                            </li>
                            <li id="general-add-menu">
                                <a href="<?php echo e(route('deposite.create')); ?>">
                                    Generate Monthly Deposit
                                </a>
                            </li>
                            <li id="general-add-yearly-deposit-menu">
                                <a href="<?php echo e(route('yearlydeposite.create')); ?>">
                                    Generate Yearly Deposit
                                </a>
                            </li>
                            <li id="general-meeting-deposit-list-menu">
                                <a href="<?php echo e(route('meetingdeposite.create')); ?>">
                                    Generate Meeting Deposit
                                </a>
                            </li>

                        </ul>
                    </li>
                    <!-- deposit    -->
                    <li><a href="#deposit" aria-expanded="false" data-toggle="collapse"> <i
                                class="fa fa-building"></i><span>Deposit List</span></a>
                        <ul id="deposit" class="collapse list-unstyled ">
                            <li id="daily-deposit-list-menu">
                                <a href="<?php echo e(route('dailydeposit.index')); ?>">
                                    Daily Deposit List
                                </a>
                            </li>
                            <li id="weekly-deposit-list-menu">
                                <a href="<?php echo e(route('weeklydeposit.index')); ?>">
                                    Weekly Deposit List
                                </a>
                            </li>
                            <li id="monthly-deposit-list-menu">
                                <a href="<?php echo e(route('deposite.index')); ?>">
                                    Monthly Deposit List
                                </a>
                            </li>
                            <li id="yearly-deposit-list-menu">
                                <a href="<?php echo e(route('yearlydeposite.index')); ?>">
                                    Yearly Deposit List
                                </a>
                            </li>
                            <li id="meeting-deposit-list-menu">
                                <a href="<?php echo e(route('meetingdeposite.index')); ?>">
                                    Meeting Deposit List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php
                    $index_permission = DB::table('permissions')
                        ->where('name', 'expenses-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    <?php if($index_permission_active): ?>
                        <li><a href="#expense" aria-expanded="false" data-toggle="collapse"> <i
                                    class="dripicons-wallet"></i><span><?php echo e(trans('file.Expense')); ?></span></a>
                            <ul id="expense" class="collapse list-unstyled ">
                                <li id="exp-cat-menu"><a
                                        href="<?php echo e(route('expense_categories.index')); ?>"><?php echo e(trans('file.Expense Category')); ?></a>
                                </li>
                                <li id="exp-list-menu"><a
                                        href="<?php echo e(route('expenses.index')); ?>"><?php echo e(trans('file.Expense List')); ?></a>
                                </li>
                                <?php
                                $add_permission = DB::table('permissions')
                                    ->where('name', 'expenses-add')
                                    ->first();
                                $add_permission_active = DB::table('role_has_permissions')
                                    ->where([['permission_id', $add_permission->id], ['role_id', $role->id]])
                                    ->first();
                                ?>
                                <?php if($add_permission_active): ?>
                                    <li><a id="add-expense" href=""> <?php echo e(trans('file.Add Expense')); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <li class="">
                        <a href="#loan" aria-expanded="false" data-toggle="collapse"> <i
                                class="dripicons-briefcase"></i><span>Loan</span>
                        </a>
                        <ul id="loan" class="collapse list-unstyled ">
                            <li id="loan-list-menu">
                                <a href="<?php echo e(route('somiti-loan.index')); ?>">Loan List</a>
                            </li>
                            <li id="loan-create-menu">
                                <a href="<?php echo e(route('somiti-loan.create')); ?>">Add Loan</a>
                            </li>

                        </ul>
                    </li>
                    
                    <li><a href="#report" aria-expanded="false" data-toggle="collapse"> <i
                                class="dripicons-document-remove"></i><span><?php echo e(trans('file.Reports')); ?></span></a>
                        <ul id="report" class="collapse list-unstyled ">
                            <li id="menber-loan-report-menu">
                                <a id="member-report-link"
                                    href="<?php echo e(route('report.memberwiseloandetail')); ?>"><?php echo e(trans('Member Wise loan ')); ?></a>
                            </li>
                            <li id="daily-deposit-report-menu">
                                <a id="date-wise-deposit-report-link"
                                    href="<?php echo e(route('report.daily_contribution_report')); ?>"><?php echo e(trans('Daily Contribution Report')); ?></a>
                            </li>
                            <li id="weekly-deposit-report-menu">
                                <a id="date-wise-deposit-report-link"
                                    href="<?php echo e(route('report.weekly_contribution_report')); ?>"><?php echo e(trans('Weekly Contribution Report')); ?></a>
                            </li>
                            <li id="monthly-deposit-report-menu">
                                <a id="date-wise-deposit-report-link"
                                    href="<?php echo e(route('report.monthly_contribution_report')); ?>"><?php echo e(trans('Monthly Contribution Report')); ?></a>
                            </li>
                            <li id="yearly-deposit-report-menu">
                                <a id="date-wise-deposit-report-link"
                                    href="<?php echo e(route('report.yearly_contribution_report')); ?>"><?php echo e(trans('Yearly Contribution Report')); ?></a>
                            </li>
                            <li id="deposit-report-menu">
                                <a id="date-wise-deposit-report-link"
                                    href="<?php echo e(route('report.deposit_report')); ?>"><?php echo e(trans('Summary Report')); ?></a>
                            </li>
                        </ul>
                    </li>


                    <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i
                                class="dripicons-gear"></i><span><?php echo e(trans('file.settings')); ?></span></a>
                        <ul id="setting" class="collapse list-unstyled ">
                            <?php
                            $send_notification_permission = DB::table('permissions')
                                ->where('name', 'send_notification')
                                ->first();
                            $send_notification_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $send_notification_permission->id], ['role_id', $role->id]])
                                ->first();

                            $customer_group_permission = DB::table('permissions')
                                ->where('name', 'customer_group')
                                ->first();
                            $customer_group_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $customer_group_permission->id], ['role_id', $role->id]])
                                ->first();

                            $general_setting_permission = DB::table('permissions')
                                ->where('name', 'general_setting')
                                ->first();
                            $general_setting_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $general_setting_permission->id], ['role_id', $role->id]])
                                ->first();

                            $backup_database_permission = DB::table('permissions')
                                ->where('name', 'backup_database')
                                ->first();
                            $backup_database_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $backup_database_permission->id], ['role_id', $role->id]])
                                ->first();

                            $sms_setting_permission = DB::table('permissions')
                                ->where('name', 'sms_setting')
                                ->first();
                            $sms_setting_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $sms_setting_permission->id], ['role_id', $role->id]])
                                ->first();

                            $create_sms_permission = DB::table('permissions')
                                ->where('name', 'create_sms')
                                ->first();
                            $create_sms_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $create_sms_permission->id], ['role_id', $role->id]])
                                ->first();

                            $pos_setting_permission = DB::table('permissions')
                                ->where('name', 'pos_setting')
                                ->first();
                            $pos_setting_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $pos_setting_permission->id], ['role_id', $role->id]])
                                ->first();

                            ?>
                            <li id="general-settings-menu"><a href="<?php echo e(route('somiti-setting.create')); ?>">Master
                                    Setting</a></li>
                            <?php if($role->id <= 2): ?>
                                <li id="role-menu"><a
                                        href="<?php echo e(route('role.index')); ?>"><?php echo e(trans('file.Role Permission')); ?></a></li>
                            <?php endif; ?>
                            <?php if($send_notification_permission_active): ?>
                                <li id="notification-menu">
                                    <a href=""
                                        id="send-notification"><?php echo e(trans('file.Send Notification')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if($create_sms_permission_active): ?>
                                <li id="create-sms-menu"><a
                                        href="<?php echo e(route('setting.createSms')); ?>"><?php echo e(trans('file.Create SMS')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if($backup_database_permission_active): ?>
                                <li><a href="<?php echo e(route('setting.backup')); ?>"><?php echo e(trans('file.Backup Database')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if($general_setting_permission_active): ?>
                                <li id="general-setting-menu"><a
                                        href="<?php echo e(route('setting.general')); ?>"><?php echo e(trans('file.General Setting')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if($sms_setting_permission_active): ?>
                                <li id="sms-setting-menu"><a
                                        href="<?php echo e(route('setting.sms')); ?>"><?php echo e(trans('file.SMS Setting')); ?></a></li>
                            <?php endif; ?>
                            <?php if($pos_setting_permission_active): ?>
                                <li id="pos-setting-menu"><a href="<?php echo e(route('setting.pos')); ?>">POS
                                        <?php echo e(trans('file.settings')); ?></a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <a id="toggle-btn" href="#" class="menu-btn align-center"><i class="fa fa-bars mt-2">
                        </i></a>
                    <span class="brand-big" style="left:12%;">
                        <?php if($general_setting->site_logo): ?>
                            <img src="<?php echo e(url('public/logo', $general_setting->site_logo ?? '')); ?>"
                                width="150">&nbsp;&nbsp;
                                <?php else: ?>
                                <p>No found Image</p>
                        <?php endif; ?>
                        <a href="<?php echo e(url('/')); ?>">
                            <h1 class="d-inline" style="display:none !important;"><?php echo e($general_setting->site_title); ?>

                            </h1>
                        </a>
                    </span>

                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <?php
                        $add_permission = DB::table('permissions')
                            ->where('name', 'sales-add')
                            ->first();
                        $add_permission_active = DB::table('role_has_permissions')
                            ->where([['permission_id', $add_permission->id], ['role_id', $role->id]])
                            ->first();

                        $empty_database_permission = DB::table('permissions')
                            ->where('name', 'empty_database')
                            ->first();
                        $empty_database_permission_active = DB::table('role_has_permissions')
                            ->where([['permission_id', $empty_database_permission->id], ['role_id', $role->id]])
                            ->first();
                        ?>
                        <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>

                        <?php
                            use App\Loan;
                            $item = Loan::where('loan_status', 1)->count();

                        ?>

                        <?php if(Auth::user()->role_id != 5): ?>
                            <li class="nav-item">
                                <a class="dropdown-item" href="https://acquaintbd.com/contact-us/" target="_blank"><i
                                        class="dripicons-information"></i> <?php echo e(trans('file.Help')); ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i
                                    class="dripicons-user"></i> <span><?php echo e(ucfirst(Auth::user()->name)); ?></span> <i
                                    class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                user="menu">
                                <li>
                                    <a href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><i
                                            class="dripicons-user"></i> <?php echo e(trans('file.profile')); ?></a>
                                </li>
                                <?php if($general_setting_permission_active): ?>
                                    <li>
                                        <a href="<?php echo e(route('setting.general')); ?>"><i class="dripicons-gear"></i>
                                            <?php echo e(trans('file.settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo e(url('my-transactions/' . date('Y') . '/' . date('m'))); ?>"><i
                                            class="dripicons-swap"></i> <?php echo e(trans('file.My Transaction')); ?></a>
                                </li>
                                <?php if(Auth::user()->role_id != 5): ?>
                                    <li>
                                        <a href="<?php echo e(url('holidays/my-holiday/' . date('Y') . '/' . date('m'))); ?>"><i
                                                class="dripicons-vibrate"></i> <?php echo e(trans('file.My Holiday')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i
                                            class="dripicons-power"></i>
                                        <?php echo e(trans('file.logout')); ?>

                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                        style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page">
        <div class="animate-bottom">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <p>&copy; <?php echo e($general_setting->site_title); ?> | <?php echo e(trans('file.Developed')); ?>

                            <?php echo e(trans('file.By')); ?> <span class="external"><?php echo e($general_setting->developed_by); ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <?php echo $__env->yieldContent('scripts'); ?>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/saleproposmajed/service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
    <script type="text/javascript">
        var alert_product = < ? php echo json_encode($alert_product) ? > ;

        if ($(window).outerWidth() > 1199) {
            $('nav.side-navbar').removeClass('shrink');
        }

        function myFunction() {
            setTimeout(showPage, 150);
        }

        function showPage() {
            //  document.getElementById("loader").style.display = "visible";
            document.getElementById("content").style.display = "visible";
        }

        $("div.alert").delay(3000).slideUp(750);

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        $("a#report-link").click(function(e) {
            e.preventDefault();
            $("#product-report-form").submit();
        });



        $("a#user-report-link").click(function(e) {
            e.preventDefault();
            $('#user-modal').modal();
        });

        $("a#customer-report-link").click(function(e) {
            e.preventDefault();
            $('#customer-modal').modal();
        });

        $("a#supplier-report-link").click(function(e) {
            e.preventDefault();
            $('#supplier-modal').modal();
        });

        $("a#due-report-link").click(function(e) {
            e.preventDefault();
            $("#due-report-form").submit();
        });

        $('.selectpicker').selectpicker({
            style: 'btn-link',
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\somiti\resources\views/layout/main.blade.php ENDPATH**/ ?>