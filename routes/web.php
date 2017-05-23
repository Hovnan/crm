<?php


Route::get('bbb', function (){
    return view('authentication.confirm');
});
//Route::get('/dashboard/', 'DashboardController@index');
//Route::get('/dashboard/{branch?}', ['as' => 'dashboard.show', 'uses' => 'DashboardController@show'])->middleware('authers');
//Route::post('/dashboard/{id}', ['as' => 'dashboard.show', 'uses' => 'DashboardController@postShow']);

//login
Route::group(['middleware' => 'visitors'], function () {

    Route::get('/', function() { return view('site.index'); });
    Route::get('/personal', function() { return view('authentication.password'); });
    Route::post('/login/{branch?}', 'LoginController@postLogin');
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@login']);
    Route::get('/loginForget', ['as' => 'login.forget', 'uses' => 'LoginController@loginForget']);
    Route::post('/loginEmail', ['as' => 'login.email', 'uses' => 'LoginController@postEmail']);

    //Regiser
    Route::get('/registerStart', ['as' => 'register.start', 'uses' => 'RegistrationController@getRegister']);
    Route::post('/registerStart', ['as' => 'register.start', 'uses' => 'RegistrationController@postRegister']);
    Route::post('/register-1', ['as' => 'register-1', 'uses' => 'RegistrationController@postRegisterOne']);
    Route::get('/register-2/{id}', ['as' => 'register-2', 'uses' => 'RegistrationController@getRegisterTwo']);
    Route::post('/register-2/{id}', ['as' => 'register-2', 'uses' => 'RegistrationController@postRegisterTwo']);
    Route::get('/register-3/{id}', ['as' => 'register-3', 'uses' => 'RegistrationController@getRegisterThree']);
    Route::post('/register-3/{id}', ['as' => 'register-3', 'uses' => 'RegistrationController@postRegisterThree']);
    Route::get('/register-4/{id}', ['as' => 'register-4', 'uses' => 'RegistrationController@getRegisterFour']);
    Route::post('/register-4/{id}', ['as' => 'register-4', 'uses' => 'RegistrationController@postRegisterFour']);

    Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword');
    Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');

    Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
    Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');

    Route::get('/activate/{id}/{activationCode}', ['as' => 'activate.get', 'uses' =>'ActivationController@getActivate']);
    Route::post('/activate/{id}/{activationCode}', ['as' => 'activate.post', 'uses' => 'ActivationController@postActivate']);
});

Route::group(['middleware' => 'authers'], function () {
    
    Route::post('/logout', 'LoginController@logout');
    Route::get('/dashboard/{branch?}', ['as' => 'dashboard.show', 'uses' => 'DashboardController@show']);
    Route::get('/profile/{branch}', ['as' => 'dashboard.profile', 'uses' => 'DashboardController@profile']);

    Route::resource('/companies', 'CompanyController');

    Route::get('/customers/{branch}', ['as' => 'customer.index', 'uses' => 'CustomerController@index']);
    //Route::post('/customers-search/{branch}', ['as' => 'customer.search', 'uses' => 'CustomerController@search']);
    Route::post('/customers/{branch}', ['as' => 'customer.store', 'uses' => 'CustomerController@store']);
    Route::get('/customers/{branch}/{id}', ['as' => 'customer.edit', 'uses' => 'CustomerController@edit']);
    Route::post('/customers/{branch}/{id}', ['as' => 'customer.update', 'uses' => 'CustomerController@update']);
    Route::post('/customers-update/{branch}', ['as' => 'customer.ajaxUpdate', 'uses' => 'CustomerController@ajaxUpdate']);

    Route::post('/childs', ['as' => 'child.decrease', 'uses' => 'ChildController@decrease']);
    Route::post('/childs-edit', ['as' => 'child.edit', 'uses' => 'ChildController@edit']);
    Route::post('/childs-search', ['as' => 'child.search', 'uses' => 'ChildController@search']);
    Route::post('/childs-attach', ['as' => 'child.attach', 'uses' => 'ChildController@attach']);
    
    Route::get('/employees/{branch}', ['as' => 'employee.index', 'uses' => 'EmployeeController@index']);
    Route::post('/employees-search/{branch}', ['as' => 'employee.search', 'uses' => 'EmployeeController@search']);
    Route::post('/employees-searchAjax', ['as' => 'employee.searchAjax', 'uses' => 'EmployeeController@searchAjax']);
    Route::post('/employees/{branch}', ['as' => 'employee.store', 'uses' => 'EmployeeController@store']);
    Route::get('/employees/{branch}/{id}', ['as' => 'employee.edit', 'uses' => 'EmployeeController@edit']);
    Route::post('/employees/{branch}/{id}', ['as' => 'employee.update', 'uses' => 'EmployeeController@update']);
    
    Route::get('/accountings/{branch}', ['as' => 'accounting.index', 'uses' => 'AccountingController@index']);
    Route::post('/accountings/{branch}', ['as' => 'accounting.store', 'uses' => 'AccountingController@store']);

    Route::post('/directions/{branch}', ['as' => 'direction.store', 'uses' => 'DirectionController@store']);

    Route::get('/requests/{branch}', ['as' => 'request.index', 'uses' => 'RequestController@index']);
    Route::post('/requests-search/{branch}', ['as' => 'request.search', 'uses' => 'RequestController@search']);
    Route::post('/requests/{branch}', ['as' => 'request.store', 'uses' => 'RequestController@store']);
    Route::get('/requests/{branch}/{id}', ['as' => 'request.edit', 'uses' => 'RequestController@edit']);
    Route::post('/requests/{branch}/{id}', ['as' => 'request.update', 'uses' => 'RequestController@update']);
    
    Route::get('/trainings/{branch}', ['as' => 'training.index', 'uses' => 'TrainingController@index']);
    Route::post('/trainings/{branch}', ['as' => 'training.store', 'uses' => 'TrainingController@store']);
    Route::get('/trainings/{branch}/{id}', ['as' => 'training.edit', 'uses' => 'TrainingController@edit']);
    Route::post('/trainings/{branch}/{id}', ['as' => 'training.update', 'uses' => 'TrainingController@update']);
    
    Route::get('/subscribers/{branch}', ['as' => 'subscriber.index', 'uses' => 'SubscriberController@index']);
    Route::post('/subscribers-search/{branch}', ['as' => 'subscriber.search', 'uses' => 'SubscriberController@search']);
    Route::post('/subscribers/{branch}', ['as' => 'subscriber.store', 'uses' => 'SubscriberController@store']);
    Route::get('/subscribers/{branch}/{id}', ['as' => 'subscriber.edit', 'uses' => 'SubscriberController@edit']);
    Route::post('/subscribers/{branch}/{id}', ['as' => 'subscriber.update', 'uses' => 'SubscriberController@update']);
    Route::post('/subscribers-unFixed', ['as' => 'subscriber.unFixed', 'uses' => 'SubscriberController@unFixed']);
    Route::post('/subscribers-price', ['as' => 'subscriber.price', 'uses' => 'SubscriberController@selectPrice']);
    
    Route::get('/timetables/{branch}', ['as' => 'timetable.index', 'uses' => 'TimetableController@index']);
    Route::post('/timetables/{branch}', ['as' => 'timetable.store', 'uses' => 'TimetableController@store']);
    Route::get('/timetables/{branch}/{id}', ['as' => 'timetable.edit', 'uses' => 'TimetableController@edit']);
    Route::post('/timetables/{branch}/{id}', ['as' => 'timetable.update', 'uses' => 'TimetableController@update']);

    Route::resource('/branches', 'BranchController');

    Route::resource('/users', 'UserController');

    //permissions
    Route::post('/permission', ['as' => 'permission.store', 'uses' => 'PermissionController@store']);
    Route::post('/permissionRemove', ['as' => 'permission.remove', 'uses' => 'PermissionController@remove']);
    
    //invitation 
    Route::post('/invitations' , ['as' => 'invitation.store', 'uses' => 'InvitationController@store']);

    // store admin or manager
    Route::post('/helpers', ['as' => 'helper.store', 'uses' => 'HelperController@store']);

});


//Regitser
//Route::get('/register/{id}', 'RegistrationController@getRegister');
//Route::post('/register', ['as' => 'register.store', 'uses' => 'RegistrationController@postRegister']);


//Route::get('/register-1/{mail?}', ['as' => 'register-1', 'uses' => 'RegistrationController@getRegisterOne']);
//Route::get('/register-1', ['as' => 'register-1', 'uses' => 'RegistrationController@getRegisterOne']);
//Route::get('/registerAdmin', 'RegistrationController@registerAdmin');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::group(['domain' => 'account.localhost:8000'], function () {
    Route::get('/user', function () {
        return 'afff';
    });
    //Route::resource('/companies', 'CompanyController');
});*/

//Route::get('/register/{id}', ['as' => 'register.destroy', 'uses' => 'RegistrationController@destroy']);


    //Route::get('/register/{id}', 'RegistrationController@getRegister');
    //Route::post('/register', ['as' => 'register.store', 'uses' => 'RegistrationController@postRegister']);
  /*  Route::post('/registerStart', ['as' => 'register.start', 'uses' => 'RegistrationController@registerOne']);
    //Route::get('/register-1/{mail?}', ['as' => 'register-1', 'uses' => 'RegistrationController@getRegisterOne']);
    //Route::get('/register-1', ['as' => 'register-1', 'uses' => 'RegistrationController@getRegisterOne']);
    Route::post('/register-1', ['as' => 'register-1', 'uses' => 'RegistrationController@postRegisterOne']);
    Route::get('/register-2/{id}', ['as' => 'register-2', 'uses' => 'RegistrationController@getRegisterTwo']);
    Route::post('/register-2/{id}', ['as' => 'register-2', 'uses' => 'RegistrationController@postRegisterTwo']);
    Route::get('/register-3/{id}', ['as' => 'register-3', 'uses' => 'RegistrationController@getRegisterThree']);
    Route::post('/register-3/{id}', ['as' => 'register-3', 'uses' => 'RegistrationController@postRegisterThree']);
    Route::get('/register-4/{id}', ['as' => 'register-4', 'uses' => 'RegistrationController@getRegisterFour']);
    Route::post('/register-4/{id}', ['as' => 'register-4', 'uses' => 'RegistrationController@postRegisterFour']);
    Route::get('/registerAdmin', 'RegistrationController@registerAdmin');

    Route::post('/postEmail', ['as' => 'login.email', 'uses' => 'LoginController@postEmail']);//Set name for root





    Route::get('/', function () {
        return view('landing.main');
    });
    Route::get('/email', function () {
        return view('authentication.confirm');
    });
Route::get('/password', function () {
    return view('authentication.password');
});
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');


//Route::group(['middleware' => 'authers'], function () {


    Route::get('/logo-login', function () {
        return view('authentication.logo-login');
    });
    
    Route::resource('/companies', 'CompanyController');

    Route::resource('/branches', 'BranchController');

    Route::post('/permission', ['as' => 'permission.store', 'uses' => 'PermissionController@store']);
    //Route::get('/permission/{id}/{branch}/{value}', ['as' => 'permission.store', 'uses' => 'PermissionController@store']);
    Route::post('/permissionRemove', ['as' => 'permission.remove', 'uses' => 'PermissionController@remove']);
    //Route::get('/permissionRemove/{id}/{branch}/{value}', ['as' => 'permission.remove', 'uses' => 'PermissionController@remove']);

    Route::get('/earnings', 'AdminController@earnings')->middleware('admin');
    Route::get('/tasks', 'ManagerController@tasks')->middleware('managers');
//Route::get('/dashboard/{id}/{company}', ['as' => 'dashboard', 'uses' => 'OwnerController@dashboard'])->middleware('owners');
    Route::get('/owner/{company}', ['as' => 'owner.dating', 'uses' => 'OwnerController@dating']);//->middleware('owners'); resolve owner problem
    Route::get('/owner/{company}/{branch}', ['as' => 'owner.dashboard', 'uses' => 'OwnerController@dashboard']);//->middleware('owners'); resolve owner problem
    Route::get('/owner-profile/{company}/{branch}', ['as' => 'owner.profile', 'uses' => 'OwnerController@profile']);//->middleware('owners');
    Route::post('/addAdmin/{company}/{branch}', ['as' => 'add.admin', 'uses' => 'OwnerController@addAdmin']);//->middleware('owners');
//Route::get('/profile/{id}', ['as' => 'profile', 'uses' => 'UserController@show']);
    Route::resource('/users', 'UserController');
//Route::post('/companies', ['as' => 'company.store', 'uses' => 'CompanyController@store']);
//Route::get('/company/{id}', ['as' => 'company.show', 'uses' => 'CompanyController@show']);

//Route::get('/register/{id}', 'RegistrationController@getRegister');
//Route::post('/register', ['as' => 'register.store', 'uses' => 'RegistrationController@postRegister']);


//Admins
    Route::get('/admin-profile/{company}/{branch}', ['as' => 'admin.profile', 'uses' => 'AdminController@profile']);//->middleware('owners');
    Route::post('/addManager/{company}/{branch}', ['as' => 'add.manager', 'uses' => 'AdminController@addManager']);//->middleware('owners');
//managers
    Route::get('/manager-profile/{company}/{branch}', ['as' => 'manager.profile', 'uses' => 'ManagerController@profile']);//->middleware('owners');

//});*/