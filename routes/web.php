<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/json-api', 'ApiController@index');


Route::get('/', function() {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');


Route::get('/admin', function() {
    return redirect()->route('dashboard');
});

// backend codes

Route::prefix('/admin')->group(function () {
    Route::get('/login', ['uses' => "Auth\LoginController@index"])->name('login');
    Route::post('/login/authenticate', ['uses' => "Auth\LoginController@authenticate"])->name('login.authenticate');

    Route::get('/register', 'Auth\RegisterController@index')->name('signup');

    Route::post('/register', 'Auth\RegisterController@register')->name('register');

    Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

    Route::get('/password', 'Auth\ForgotPasswordController@index')->name('password');
    Route::post('/password', 'Auth\ForgotPasswordController@update')->name('password.reset');

});

// Protected Routes
Route::group(['prefix' => '/admin' , 'middleware' => 'backend.auth'], function () {
    Route::get('/activate', 'ActivateController@index')->name('activate.user');

    // dashboard
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    // Customers
    Route::get('/customers', function () {
        return view('backend.customers.index');
    })->name('customers');

    // Single Transaction Page
    Route::get('/s-transaction', function () {
        return view('backend.transactions.s-transaction');
    });

    // Creditors
    Route::get('/creditor/add', function () {
        return view('backend.creditors.add');
    })->name('add_creditor');

    // Debtors
    Route::get('/debtor/add', function () {
        return view('backend.debtors.add');
    })->name('add_debtor');

    //Single Customer view
    Route::get('/singleCustomer', function(){
        return view('backend.customers.singleCustomer');
    })->name('customer');

    // transaction
    Route::get('/broadcast', function () {
        return view('backend.broadcasts.send_broadcast');
    })->name('broadcast');

    Route::get('/broadcast/compose', function () {
            return view('backend.broadcasts.compose_broadcast');
        })->name('compose');

    Route::get('/transactions', 'TransactionController@index')->name('transactions');
    Route::get('/transactions/{id}', 'SingleTransactionController@index')->name('view_transaction');


    Route::get('/backend/complaint_log' , 'ComplaintlogController@index');

    Route::get('/backend/2f4k7e34o', function () {
        return view('backend.complaintlog.delete_complaint');
    });

    Route::get('/backend/1123', function () {
        return view('backend.complaintlog.update_status');
    });

    // all users

    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/{id}', 'UsersController@show')->name('user.view');


    Route::get('/debt_reminders', function () {
        return view('backend.debt_reminder.index');
    })->name('debts.reminder');


    Route::get('/complaint', function () {
        return view('backend.complaints.complaintform');
    })->name('complaint.form');

    Route::get('/complaint_log', function () {
        return view('backend.complaints.complaintlog');
    })->name('complaint.log');

    Route::get('/change-loc', function () {
        return view('backend.location.change_loc');
    });

    // all users
    // duplicate routes

    // Route::get('/users_list', function () {
    //     return view('users_list.single_user');
    // })->name('users.list');

    // Route::get('/view_user', function () {
    //     return view('backend.users_list.show');
    // })->name('user.view');

    // analytics
    Route::get('/analytics', function () {
        return view('backend.analytics.analytics');
    })->name('analytics');

    // stores
    Route::get('/stores', 'StoreController@index')->name('stores');

    Route::match(['get', 'post'],'/create_store', 'StoreController@create')->name('store.create');


    Route::get('/view_store/{id}', 'StoreController@show')->name('store.view');

    Route::get('/edit_store/{id}', 'StoreController@edit')->name('store.edit');

    Route::get('/settings', 'SettingsController@index')->name('settings');

    Route::post('/settings', 'SettingsController@update')->name('settings.update');

    Route::get('/edit_assistants', function () {
        return view('backend.store-assistants.edit_assistants');
    })->name('assistants.edit');

    Route::get('/edit_customer', function () {
        return view('backend.customers.edit_customer');
    })->name('customer');

    // Route::get('/singleCustomer', function(){
    //     return view('backend.customers.singleCustomer');
    // })->name('customer');

    // assistant
    Route::get('/add_assistant', function () {
        return view('backend.store-assistants.add_assistant');
    })->name('assistants.add');

    //notifications page
    Route::get('/notifications', function () {
        return view('backend.notifications.user_notification');
    })->name('notification');
});
