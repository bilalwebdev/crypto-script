<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Auth\{
    ForgotPasswordController,
    ResetPasswordController,
    LoginController,
};
use App\Http\Controllers\Backend\{
    AddonController,
    AdminController,
    AdminProfileController,
    DashboardController,
    EmailTemplateController,
    ConfigurationController,
    LanguageController,
    LogController,
    ManageDepositController,
    ManageGatewayController,
    ManageSectionController,
    ManageUserController,
    ManageWithdrawController,
    MarketController,
    PagesController,
    PaymentController,
    PaymentMethodController,
    PlanController,
    ReferralController,
    RoleController,
    SignalController,
    SignalCurrencyPairController,
    SignalTimeFrameController,
    TicketController,
    TransactionController,
    ManageKycController,
};
use App\Http\Controllers\JobController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [LoginController::class, 'loginPage'])->name('login');

    Route::post('login', [LoginController::class, 'login']);


    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');

    Route::post('password/reset', [ForgotPasswordController::class, 'sendResetCodeEmail']);

    Route::get('password/verify-code', [ForgotPasswordController::class, 'verifyCodeForm'])->name('password.verify.code');

    Route::post('password/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify.code');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');

    Route::get('password/send/again', [ResetPasswordController::class,  'sendAgain'])->name('send.again');

    Route::post('password/reset/change', [ResetPasswordController::class, 'reset'])->name('password.change');




    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('home');

    Route::get('profile', [AdminProfileController::class, 'profile'])->name('profile');

    Route::post('profile', [AdminProfileController::class, 'profileUpdate']);

    Route::post('change/password', [AdminProfileController::class, 'changePassword'])->name('change.password');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('language/ajax', [LanguageController::class, 'languageAjax'])->name('cms-builder');


    // Route::middleware('permission:signal,admin')->group(function () {
    //     Route::resource('currency-pair', SignalCurrencyPairController::class);
    //     Route::post('currency-pair/changeStatus/{id}', [SignalCurrencyPairController::class, 'changeStatus'])->name('currency-pair.changestatus');


    //     Route::resource('markets', MarketController::class);
    //     Route::post('markets/changeStatus/{id}', [MarketController::class, 'changeStatus'])->name('markets.changestatus');


    //     Route::resource('frames', SignalTimeFrameController::class);
    //     Route::post('frames/changeStatus/{id}', [SignalTimeFrameController::class, 'changeStatus'])->name('frames.changestatus');


    //     Route::resource('signals', SignalController::class);
    //     Route::post('signals/send/{id}', [SignalController::class, 'sent'])->name('signals.sent');
    // });

    // Role Permission

    Route::resource('roles', RoleController::class, ['except' => ['show', 'delete', 'edit']])->middleware('permission:manage-role,admin');

    Route::resource('admins', AdminController::class)->middleware('permission:manage-admin,admin');
    Route::post('admins/changeStatus/{id}', [AdminController::class, 'changeStatus'])->name('changestatus')->middleware('permission:manage-admin,admin');

    // Manage User
    Route::middleware('permission:manage-user,admin')->prefix('users')->name('user.')->group(function () {
        Route::post('update/{user}', [ManageUserController::class, 'userUpdate'])->name('update');
        Route::post('balance/{user}', [ManageUserController::class, 'userBalanceUpdate'])->name('balance.update');
        Route::post('mail/{user}', [ManageUserController::class, 'sendUserMail'])->name('mail');
        Route::get('{status}', [ManageUserController::class, 'userStatusWiseFilter'])->name('filter');
        Route::get('interest/log', [ManageUserController::class, 'interestLog'])->name('interestlog');
        Route::post('bulk/mail', [ManageUserController::class, 'bulkMail'])->name('bulk');
        Route::get('doc/{user}', [ManageUserController::class, 'kycDoc'])->name('doc');
        Route::get('kyc/request', [ManageUserController::class, 'kycAll'])->name('kyc.req');
        Route::get('kyc/request/{id}', [ManageUserController::class, 'kycDetails'])->name('kyc.details');
        Route::post('/kyc-approve', [ManageUserController::class, 'kycStatus'])->name('kyc.approve');
        Route::post('delete-acc/{login}', [ManageUserController::class, 'accDel'])->name('acc-del');
        Route::get('/edit/{user}', [ManageUserController::class, 'userEdit'])->name('edit');
    });

    Route::get('/users', [ManageUserController::class, 'index'])->name('user.index');
    Route::get('/users/details/{user}', [ManageUserController::class, 'userDetails'])->name('user.details');

    Route::post('user/assign-admin', [ManageUserController::class, 'assignAdmin'])->name('user.assign-admin')->middleware('permission:manage-user,admin');
    Route::get('user/create', [ManageUserController::class, 'userCreate'])->name('user.create')->middleware('permission:manage-user,admin');
    Route::post('user/submit', [ManageUserController::class, 'userSubmit'])->name('user.submit')->middleware('permission:manage-user,admin');



    Route::get('user/upload-kyc/{user}', [ManageUserController::class, 'adminKycUpload'])->name('user.upload-kyc')->middleware('permission:manage-user,admin');
    Route::post('/user/kyc-submit', [ManageUserController::class, 'adminKycStore'])->name('user.submit-kyc')->middleware('permission:manage-user,admin');

    // End User

    //payment method

    Route::middleware('permission:manage-payment-method,admin')->group(function () {
        Route::resource('payment-method', PaymentMethodController::class);
        Route::post('payment-method/changeStatus/{id}', [PaymentMethodController::class, 'changeStatus'])->name('payment-method.changestatus');
    });




    // General Settings
    // Route::middleware('permission:manage-setting,admin')->prefix('general')->name('general.')->group(function () {

    //     Route::get('index', [ConfigurationController::class, 'index'])->name('index');

    //     Route::post('setting', [ConfigurationController::class, 'ConfigurationUpdate'])->name('basic');
    // });

    // End General Settings


    // support Ticket

    Route::middleware('permission:manage-ticket,admin')->prefix('ticket')->name('ticket.')->group(function () {
        Route::get('/{id}', [TicketController::class, 'show'])->name('show');
        Route::post('ticket/reply/{id}', [TicketController::class, 'reply'])->name('reply');
        Route::get('filter/{status}', [TicketController::class, 'filterByStatus'])->name('status');
        Route::delete('destroy/{id}', [TicketController::class, 'destroy'])->name('destroy');
    });

    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');

    // kyc-docs

    Route::middleware('permission:manage-ticket,admin')->prefix('kyc-docs')->name('kyc-doc.')->group(function () {
        Route::get('/approve/{id}', [ManageKycController::class, 'approve'])->name('approve');
        Route::get('/reject/{id}', [ManageKycController::class, 'reject'])->name('reject');
        Route::get('/delete/{id}', [ManageKycController::class, 'delete'])->name('delete');
    });

    Route::get('/kyc-docs', [ManageKycController::class, 'index'])->name('kyc-doc.index');


    // Email Manager
    // Route::middleware('permission:manage-email,admin')->prefix('email')->name('email.')->group(function () {

    //     Route::get('config', [EmailTemplateController::class, 'emailConfig'])->name('config');
    //     Route::post('config', [EmailTemplateController::class, 'emailConfigUpdate']);
    //     Route::get('templates', [EmailTemplateController::class, 'emailTemplates'])->name('templates');
    //     Route::get('templates/{template}', [EmailTemplateController::class, 'emailTemplatesEdit'])->name('templates.edit');
    //     Route::post('templates/{template}', [EmailTemplateController::class, 'emailTemplatesUpdate']);
    // });


    Route::middleware('permission:manage-referral,admin')->prefix('refferal')->name('refferal.')->group(function () {
        Route::get('/', [ReferralController::class, 'index'])->name('index');
        Route::post('invest', [ReferralController::class, 'investStore'])->name('invest');
        Route::post('status/{id?}', [ReferralController::class, 'refferalStatusChange'])->name('refferalstatus');
    });


    // Route::middleware('permission:manage-gateway,admin')->prefix('gateway')->name('payment.')->group(function () {
    //     Route::get('online', [ManageGatewayController::class, 'online'])->name('index');
    //     Route::get('offline', [ManageGatewayController::class, 'offline'])->name('offline');
    //     Route::get('/{name}', [ManageGatewayController::class, 'loadView'])->name('gateway');
    //     Route::post('status/{id}', [ManageGatewayController::class, 'status'])->name('status');
    //     Route::post('update/online/{id}', [ManageGatewayController::class, 'updateOnlinePaymentGateway'])->name('update.online');
    //     Route::post('gourl', [ManageGatewayController::class, 'gourlUpdate'])->name('update.gourl');
    //     Route::get('offline-gateway/create', [ManageGatewayController::class, 'offlineCreate'])->name('offline.create');
    //     Route::post('offline-gateway/create', [ManageGatewayController::class, 'offlineStore']);
    //     Route::get('offline-gateway/edit/{id}', [ManageGatewayController::class, 'offlineEdit'])->name('offline.edit');
    //     Route::post('offline-gateway/edit/{id}', [ManageGatewayController::class, 'offlineUpdate']);
    // });


    // Route::middleware('permission:manage-language,admin')->prefix('language')->name('language.')->group(function () {
    //     Route::get('/', [LanguageController::class, 'index'])->name('index');
    //     Route::post('/', [LanguageController::class, 'store']);
    //     Route::post('edit/{id}', [LanguageController::class, 'update'])->name('edit');
    //     Route::post('delete/{id}', [LanguageController::class, 'delete'])->name('delete');


    //     Route::get('translator/{lang}', [LanguageController::class, 'transalate'])->name('translator');
    //     Route::post('translator/{lang}', [LanguageController::class, 'transalateUpate']);

    //     Route::post('translator/ajax/update/{lang}', [LanguageController::class, 'ajaxUpdate'])->name('ajax');
    //     Route::post('translator/delete/{lang}', [LanguageController::class, 'deleteKey'])->name('key.delete');
    // });


    // Route::middleware('permission:manage-withdraw,admin')->prefix('withdraw')->name('withdraw.')->group(function () {

    //     Route::get('method', [ManageWithdrawController::class, 'index'])->name('index');
    //     Route::get('method/search', [ManageWithdrawController::class, 'index'])->name('search');
    //     Route::post('method', [ManageWithdrawController::class, 'withdrawMethodCreate']);
    //     Route::post('edit/{id}', [ManageWithdrawController::class, 'withdrawMethodUpdate'])->name('update');
    //     Route::post('delete/{id}', [ManageWithdrawController::class, 'withdrawMethodDelete'])->name('delete');

    //     Route::get('withdraw-log/{id}', [ManageWithdrawController::class, 'withdrawLog'])->name('log');
    //     Route::get('{status?}', [ManageWithdrawController::class, 'filterWithdraw'])->name('filter');
    //     Route::post('accept/{withdraw}', [ManageWithdrawController::class, 'withdrawAccept'])->name('accept');
    //     Route::post('reject/{withdraw}', [ManageWithdrawController::class, 'withdrawReject'])->name('reject');
    // });

    // Route::middleware('permission:payments,admin')->prefix('payments')->name('payments.')->group(function () {
    //     Route::get('/{type}', [PaymentController::class, 'payment'])->name('index');
    //     Route::get('details/{id}', [PaymentController::class, 'details'])->name('details');

    //     Route::post('accept/{trx}', [PaymentController::class, 'accept'])->name('accept');
    //     Route::post('reject/{trx}', [PaymentController::class, 'reject'])->name('reject');
    // });

    // Route::middleware('permission:manage-theme,admin')->group(function () {
    //     Route::get('manage-theme', [ConfigurationController::class, 'manageTheme'])->name('manage.theme');
    //     Route::post('manage-theme/{name}', [ConfigurationController::class, 'themeUpdate'])->name('manage.theme.update');
    //     Route::post('change/theme/color/{theme}', [ConfigurationController::class, 'themeColor'])->name('manage.theme.color');
    // });

    // Route::middleware('permission:manage-frontend,admin')->group(function () {
    //     Route::get('pages', [PagesController::class, 'index'])->name('frontend.pages');
    //     Route::get('pages/create', [PagesController::class, 'pageCreate'])->name('frontend.pages.create');
    //     Route::post('pages/create', [PagesController::class, 'pageInsert']);
    //     Route::get('pages/edit/{id}', [PagesController::class, 'pageEdit'])->name('frontend.pages.edit');
    //     Route::post('pages/edit/{id}', [PagesController::class, 'pageUpdate']);
    //     Route::get('pages/search', [PagesController::class, 'index'])->name('frontend.search');
    //     Route::post('pages/delete/{id}', [PagesController::class, 'pageDelete'])->name('frontend.pages.delete');

    //     Route::get('manage/section/{name}', [ManageSectionController::class, 'section'])->name('frontend.section.manage');
    //     Route::post('manage/section/{name}', [ManageSectionController::class, 'sectionContentUpdate']);
    //     Route::get('manage/element/{name}', [ManageSectionController::class, 'sectionElement'])->name('frontend.element');
    //     Route::get('manage/element/{name}/search', [ManageSectionController::class, 'section'])->name('frontend.element.search');
    //     Route::post('manage/element/{name}', [ManageSectionController::class, 'sectionElementCreate']);
    //     Route::get('edit/{name}/element/{element}', [ManageSectionController::class, 'editElement'])->name('frontend.element.edit');
    //     Route::post('edit/{name}/element/{element}', [ManageSectionController::class, 'updateElement']);
    //     Route::post('delete/{name}/element/{element}', [ManageSectionController::class, 'deleteElement'])->name('frontend.element.delete');


    //     Route::get('frontend/translate/{name}/{element}', [ManageSectionController::class, 'translate'])->name('frontend.translate');
    //     Route::post('frontend/translate/{name}/{element}', [ManageSectionController::class, 'translateUpdate']);
    // });

    Route::middleware('permission:manage-deposit,admin')->group(function () {
        Route::get('deposit/{id}/details', [ManageDepositController::class, 'details'])->name('deposit.details');
        Route::post('deposit/{id}/accept', [ManageDepositController::class, 'accept'])->name('deposit.accept');
        Route::post('deposit/{id}/reject', [ManageDepositController::class, 'reject'])->name('deposit.reject');
    });

    Route::get('deposits', [ManageDepositController::class, 'index'])->name('deposits');

    Route::middleware('permission:manage-transact,admin')->group(function () {

        Route::get('/transac', [TransactionController::class, 'trans'])->name('transac');
        Route::post('/transac/store', [TransactionController::class, 'storeTrans'])->name('transac.store');
        Route::get('/transac/confirm', [TransactionController::class, 'confirmTrans'])->name('transac.confirm');
        Route::post('/transac/final', [TransactionController::class, 'finalTrans'])->name('transac.final');
    });

    Route::middleware('permission:manage-withdraw,admin')->group(function () {

        Route::get('withdraw/{id}/details', [ManageWithdrawController::class, 'details'])->name('withdraw.details');
        Route::post('withdraw/{id}/accept', [ManageWithdrawController::class, 'accept'])->name('withdraw.accept');
        Route::post('withdraw/{id}/reject', [ManageWithdrawController::class, 'reject'])->name('withdraw.reject');
    });

    Route::get('withdraws', [ManageWithdrawController::class, 'index'])->name('withdraws');

    Route::middleware('permission:manage-deposit,admin')->group(function () {
        Route::get('deposit/log/{user?}', [LogController::class, 'depositLog'])->name('deposit.log');
        // Route::get('deposit/{status}', [ManageDepositController::class, 'index'])->name('deposit');
        // Route::post('deposit/{trx}/accept', [ManageDepositController::class, 'accept'])->name('deposit.accept');
        // Route::post('deposit/{trx}/reject', [ManageDepositController::class, 'reject'])->name('deposit.reject');
        // Route::get('deposit/{trx}/details', [ManageDepositController::class, 'details'])->name('deposit.details');
    });


    Route::middleware('permission:manage-logs,admin')->group(function () {
        Route::get('transaction-log/{user?}', [LogController::class, 'transaction'])->name('transaction');
        Route::get('payment-report/{user?}', [LogController::class, 'paymentReport'])->name('payment.report');
        Route::get('withdarw-report/{user?}', [LogController::class, 'withdarawReport'])->name('withdraw.report');
        Route::get('transfer/log', [LogController::class, 'transferLog'])->name('transfer.report');
        Route::get('commision/{user?}', [LogController::class, 'Commision'])->name('commision');
        Route::get('commision-setting/{id?}', [LogController::class, 'commisionSetting'])->name('commision-setting');
        Route::post('commision-save', [LogController::class, 'commisionSave'])->name('commision-save');
        Route::get('trade-log/{user?}', [LogController::class, 'tradeLog'])->name('trade');
    });


    Route::get('changeLang', [LanguageController::class, 'changeLang'])->name('changeLang');
    Route::get('all-notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/mark-as-read', [AdminController::class, 'markNotification'])->name('markNotification');
    Route::post('/mark-as-read/{id}', [AdminController::class, 'SignlemarkNotification'])->name('markNotification.single');

    // Route::get('subscribers', [AdminController::class, 'subscribers'])->name('subscribers');

    // Route::post('subscribers/{email}', [AdminController::class, 'singleMail'])->name('subscribers.single');

    // Route::post('bulk/mail', [AdminController::class, 'bulkMail'])->name('subscribers.bulk');

    // Route::get('maintanace-mode', [DashboardController::class, 'maintanance'])->name('maintanace');

    Route::get('cacheclear', [ConfigurationController::class, 'cacheClear'])->name('general.cacheclear');



    Route::get('commision-calculate', [JobController::class, 'commisionCalculate']);
});
