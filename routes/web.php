<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', 'HomeController@dashboard');
});

Route::group(['middleware' => ['auth', 'active']], function () {

	// dashboard
	Route::get('/', 'HomeController@index');

	// role and permission
	Route::get('role/permission/{id}', 'RoleController@permission')->name('role.permission');
	Route::post('role/set_permission', 'RoleController@setPermission')->name('role.setPermission');
	Route::resource('role', 'RoleController');

	// customer group
	Route::post('importcustomer_group', 'CustomerGroupController@importCustomerGroup')->name('customer_group.import');
	Route::post('customer_group/deletebyselection', 'CustomerGroupController@deleteBySelection');
	Route::get('customer_group/lims_customer_group_search', 'CustomerGroupController@limsCustomerGroupSearch')->name('customer_group.search');
	Route::resource('customer_group', 'CustomerGroupController');

	// customer
	Route::post('importcustomer', 'MemberController@importCustomer')->name('customer.import');
	Route::get('customer/getDeposit/{id}', 'MemberController@getDeposit');
	Route::post('customer/add_deposit', 'MemberController@addDeposit')->name('customer.addDeposit');
	Route::post('customer/update_deposit', 'MemberController@updateDeposit')->name('customer.updateDeposit');
	Route::post('customer/deleteDeposit', 'MemberController@deleteDeposit')->name('customer.deleteDeposit');
	Route::post('customer/deletebyselection', 'MemberController@deleteBySelection');
	Route::get('customer/lims_customer_search', 'MemberController@limsCustomerSearch')->name('customer.search');
	Route::resource('memberinfo', 'MemberController');
	Route::get('customer/profile/{id}', 'MemberController@customerProfile')->name('customer.profile');
	Route::get('memberinfo/deposit/details/{id}', 'MemberController@memberDepositDetail')->name('memberDepositDetail');

	Route::get('customer/search', 'MemberController@customerSearch')->name('customersearching');

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////  selim start  ///////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Daily Deposit
	Route::resource('dailydeposit', 'DailyDepositController');
	Route::get('dailydeposit/deposit-details/{id}', 'DailyDepositController@dailyDepositDetails')->name('dailydepositdetails');
	Route::post('dailydeposit/deposit-details/payment', 'DailyDepositController@dailydepositPayment')->name('dailydepositPayment');
	Route::get('dailydeposit/money-receipt/detail/{id}', 'DailyDepositController@dailyMoneyReceipt')->name('dailyMoneyReceipt');
	Route::get('dailydeposit/money-receipt/single/{id}', 'DailyDepositController@dailymoneyreceiptSingle')->name('dailymoneyreceiptSingle');
	Route::post('dailydeposit/newdepositorstore', 'DailyDepositController@singleCustomerDailyDepositStore')->name('singlecustomerdailydepositstore');
	Route::get('search/daily/deposite/member', 'DailyDepositController@searchByAjax')->name('search_daily_deposit_by_ajax');
	Route::get('dailydeposit/money-receipt/edit/{id}', 'DailyDepositController@moneyReceiptEdit')->name('daily_money_receipt_edit');
	Route::post('dailydeposit/money-receipt/updatedepositPayment/{id}', 'DailyDepositController@updatedepositPayment')->name('updatedailydepositPayment');


	// Weekly  Deposit
	Route::resource('weeklydeposit', 'WeeklyDepositController');
	Route::get('weeklydeposite/deposit-details/{id}', 'WeeklyDepositController@WeeklyDepositDetails')->name('weeklydepositdetails');
	Route::get('weeklydeposite/money/receipt/{id}', 'WeeklyDepositController@weeklyMoneyReceipt')->name('weeklyMoneyReceipt');
	Route::post('weeklydeposite/single/Customer/Weekly/Deposit/Store', 'WeeklyDepositController@singleCustomerWeeklyDepositStore')->name('singlecustomerweeklydepositstore');
	Route::post('weeklydeposite/weeklydepositPayment', 'WeeklyDepositController@WeeklyDepositPayment')->name('weeklydepositPayment');
	Route::get('/weekly/money/receipt/Single/{id}', 'WeeklyDepositController@weeklymoneyreceiptSingle')->name('weeklymoneyreceiptSingle');
	Route::get('search/weekly/deposite/member', 'WeeklyDepositController@searchByAjax')->name('search_weekly_deposit_by_ajax');
	Route::get('weeklydeposit/money-receipt/edit/{id}', 'WeeklyDepositController@moneyReceiptEdit')->name('weekly_money_receipt_edit');
	Route::post('weeklydeposit/money-receipt/updatedepositPayment/{id}', 'WeeklyDepositController@updatedepositPayment')->name('updateweeklydepositPayment');

	// Monthly Deposit
	Route::resource('deposite', 'MonthlyDepositController');
	Route::get('/search/deposite/member', 'MonthlyDepositController@searchDepositeMember');
	Route::get('deposite/deposit-details/{id}', 'MonthlyDepositController@depositDetails')->name('depositDetails');
	Route::post('deposite/deposit-details/payment', 'MonthlyDepositController@depositPayment')->name('depositPayment');
	Route::get('deposite/money-receipt/{id}', 'MonthlyDepositController@moneyReceipt')->name('moneyReceipt');
	Route::get('deposite/money-receipt/detail/{id}', 'MonthlyDepositController@moneyreceiptSingle')->name('moneyreceiptSingle');
	Route::post('deposite/search', 'MonthlyDepositController@singleCustomerDepositStore')->name('deposit.singleCustomerStore');
	Route::post('deposite/deposit-details/payment', 'MonthlyDepositController@depositPayment')->name('depositPayment');
	Route::get('monthlydeposit/money-receipt/edit/{id}', 'MonthlyDepositController@moneyReceiptEdit')->name('monthly_money_receipt_edit');
	Route::post('monthlydeposit/money-receipt/updatedepositPayment/{id}', 'MonthlyDepositController@updatedepositPayment')->name('updatemonthlydepositPayment');


	// Yearly Deposit
	Route::resource('yearlydeposite', 'YearlyDepositController');
	Route::get('search/yearly/deposite/member', 'YearlyDepositController@searchYearlyDeposite');
	Route::get('yearlydeposite/deposit-details/{id}', 'YearlyDepositController@depositDetails')->name('yearlydepositDetails');
	Route::post('yearlydeposite/deposit-details/payment', 'YearlyDepositController@depositPayment')->name('yearlydepositPayment');
	Route::get('yearlydeposite/money-receipt/{id}', 'YearlyDepositController@moneyReceipt')->name('yearlymoneyReceipt');
	Route::get('yearlydeposite/money-receipt/detail/{id}', 'YearlyDepositController@yearlymoneyreceiptSingle')->name('yearlymoneyreceiptSingle');
	Route::post('yearlydeposite/singlemember', 'YearlyDepositController@singleMemberYearlyDepositStore')->name('singleMemberYearlyDepositStore');

	Route::get('yearlydeposite/money-receipt/edit/{id}', 'YearlyDepositController@moneyReceiptEdit')->name('yearly_money_receipt_edit');
	Route::post('yearlydeposite/money-receipt/updatedepositPayment/{id}', 'YearlyDepositController@updatedepositPayment')->name('updateyearlydepositPayment');

	// meeting deposit
	Route::resource('meetingdeposite', 'MeetingDepositController');
	Route::get('meeting/deposite/deposit-details/{id}', 'MeetingDepositController@depositDetails')->name('meetingDepositDetails');
	Route::post('single/customer/meeting/deposit/store', 'MeetingDepositController@singlecustomermeetingdepositstore')->name('singlecustomermeetingdepositstore');
	Route::get('meeting/money/receipt/Single/{id}', 'MeetingDepositController@meetingmoneyreceiptSingle')->name('meetingmoneyreceiptSingle');
	Route::post('meeting/Deposit/Payment', 'MeetingDepositController@meetingDepositPayment')->name('meetingDepositPayment');
	Route::get('meeting/money-receipt/{id}', 'MeetingDepositController@meetingMoneyReceipt')->name('meetingMoneyReceipt');
	Route::get('meeting/Deposit/money-receipt/{id}', 'MeetingDepositController@meetingmoneyreceiptSingle')->name('meetingmoneyreceiptSingle');
	Route::get('search/meeting/deposite/member', 'MeetingDepositController@searchByAjax')->name('search_meeting_deposit_by_ajax');

	Route::get('meeting/money-receipt/edit/{id}', 'MeetingDepositController@moneyReceiptEdit')->name('meeting_money_receipt_edit');
	Route::post('meeting/money-receipt/updatedepositPayment/{id}', 'MeetingDepositController@updatedepositPayment')->name('updatemeetingdepositPayment');

	// Loan
	Route::resource('somiti-loan', 'LoanController');
	Route::get('loan/search_loan_list_by_ajax', 'LoanController@searchloanlistbyajax')->name('search_loan_list_by_ajax');
	Route::get('somiti-loan/get-approved/details', 'LoanController@approveLoan')->name('somiti-loan.approve');
	Route::post('somiti-loan/loan-status/update', 'LoanController@updateLoanStatus')->name('somiti-loan.update');
	Route::get('somiti-loan/single/{loanID}/detail/{memberLoanID}', 'LoanController@singleLoanDetail')->name('somiti-loan.single-detail');
	Route::get('somiti-loan/loan-details/somito-loan-id/{id}', 'LoanController@memberLoanDetails')->name('memberLoanDetails');
	Route::post('somiti-loan/loan-details/somito-loan', 'LoanController@memberLoanDeposite')->name('memberLoanDeposite');
	Route::get('somiti-loan/get-membertype/wise-member', 'LoanController@getMemberbyAjax')->name('getMemberbyAjax');
	Route::get('somiti-loan/loan-details/receipt/{id}', 'LoanController@loanDetailReceipt')->name('loanDetailReceipt');

	// daily contribution report
	Route::get('report/daily-contribution-report', 'ReportController@dailyContributionReport')->name('report.daily_contribution_report');
	Route::post('report/daily-contribution-report/search', 'ReportController@dailydepositreportsearch')->name('report.dailydepositreportsearch');

	// weekly contribution report
	Route::get('report/weekly-contribution-report', 'ReportController@weeklyContributionReport')->name('report.weekly_contribution_report');
	Route::post('report/weekly-contribution-report/search', 'ReportController@weeklyContributionReportSearch')->name('report.weeklyContributionReportSearch');

	// monthly contribution report
	Route::get('report/monthly-contribution-report', 'ReportController@monthlyContributionReport')->name('report.monthly_contribution_report');
	Route::post('report/monthly-contribution-report/search', 'ReportController@monthlyContributionReportSearch')->name('report.monthlyContributionReportSearch');

	// yearly contribution report
	Route::get('report/yearthly-contribution-report', 'ReportController@yearlyContributionReport')->name('report.yearly_contribution_report');
	Route::post('report/yearthly-contribution-report/search', 'ReportController@yearlyContributionReportSearch')->name('report.yearlyContributionReportSearch');

	// summary report
	Route::get('report/deposite-report', 'ReportController@depositReport')->name('report.deposit_report');

	// Somiti Setting
	Route::resource('setting/somiti-setting', 'SomitiSettingController');

	Route::get('report/member-wise-loan-list', 'ReportController@memberWiseLoanDetail')->name('report.memberwiseloandetail');
	Route::post('report/member-wise-loan-list', 'ReportController@memberWiseLoanDetailSearch')->name('report.memberwiseloandetailsearch');

	Route::post('report/date-wise-deposite-list', 'ReportController@dateWiseDepositDetailSearch')->name('report.datewisedepositedetailsearch');

	// user profile
	Route::get('user/profile/{id}', 'UserController@profile')->name('user.profile');
	Route::put('user/update_profile/{id}', 'UserController@profileUpdate')->name('user.profileUpdate');
	Route::put('user/changepass/{id}', 'UserController@changePassword')->name('user.password');
	Route::get('user/genpass', 'UserController@generatePassword');
	Route::post('user/deletebyselection', 'UserController@deleteBySelection');
	Route::resource('user', 'UserController');

	Route::get('setting/general_setting', 'SettingController@generalSetting')->name('setting.general');
	Route::post('setting/general_setting_store', 'SettingController@generalSettingStore')->name('setting.generalStore');

	//report setting
	Route::get('setting/report_setting', 'SettingController@report_setting')->name('setting.report');
	Route::post('setting/report_setting_store', 'SettingController@report_setting_store')->name('report-setting-store');


	Route::get('backup', 'SettingController@backup')->name('setting.backup');
	Route::get('setting/general_setting/change-theme/{theme}', 'SettingController@changeTheme');
	Route::get('setting/mail_setting', 'SettingController@mailSetting')->name('setting.mail');
	Route::get('setting/sms_setting', 'SettingController@smsSetting')->name('setting.sms');
	Route::get('setting/createsms', 'SettingController@createSms')->name('setting.createSms');
	Route::post('setting/sendsms', 'SettingController@sendSms')->name('setting.sendSms');
	Route::get('setting/hrm_setting', 'SettingController@hrmSetting')->name('setting.hrm');
	Route::post('setting/hrm_setting_store', 'SettingController@hrmSettingStore')->name('setting.hrmStore');
	Route::post('setting/mail_setting_store', 'SettingController@mailSettingStore')->name('setting.mailStore');
	Route::post('setting/sms_setting_store', 'SettingController@smsSettingStore')->name('setting.smsStore');
	Route::get('setting/pos_setting', 'SettingController@posSetting')->name('setting.pos');
	Route::post('setting/pos_setting_store', 'SettingController@posSettingStore')->name('setting.posStore');
	Route::get('setting/empty-database', 'SettingController@emptyDatabase')->name('setting.emptyDatabase');

	// loan
	Route::resource('loan', 'LoanController');
	Route::get('loan/change/status/{id}', 'LoanController@changeStaus')->name('loan.change-status');

	// footer
	Route::resource('footer', 'FooterController');

});
