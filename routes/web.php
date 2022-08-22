<?php

use App\Http\Controllers\Admin\Banners;
use App\Http\Controllers\Admin\Common;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Admin\Login;
use App\Http\Controllers\User\SignUp;
use App\Http\Controllers\User\InspirationalFeed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Events;
use App\Http\Controllers\Admin\CMSPage;
use App\Http\Controllers\User\Home;
use App\Http\Controllers\User\MyProfile;

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

/*--------------------------------------- user routes ----------------------*/
Route::get('/', [Home::class, 'index']);
Route::get('sign-up', [SignUp::class, 'register']);
Route::post('signIn', [SignUp::class, 'signIn']);
Route::get('login', [SignUp::class, 'login']);
Route::post('login', [SignUp::class, 'login']);
Route::get('forgot-password', [SignUp::class, 'forgotPassword']);
Route::post('forgot-password', [SignUp::class, 'forgotPassword']);
Route::get('auth-google', [SignUp::class, 'redirectToGoogle']);
Route::get('auth-google-callback', [SignUp::class, 'handleGoogleCallback']);
Route::get('user-logout', [SignUp::class, 'userLogout']);
Route::get('testimony', [Home::class, 'spiritualTestimony']);
Route::get('holy-spirit', [Home::class, 'powerOfHolySpirit']);
Route::get('tips', [Home::class, 'godLuvTips']);
Route::get('give', [Home::class, 'give']);

Route::get('auth-facebook', [SignUp::class, 'redirectToFB']);
Route::get('auth-facebook-callback', [SignUp::class, 'handleFacebookCallback']);


Route::get('auth-instagram', [SignUp::class, 'redirectToInsta']);
Route::get('auth-instagram-callback', [SignUp::class, 'handleInstagramCallback']);

Route::group(['middleware' => 'auth_user'],function () {
    Route::get('inspirational-feed',[InspirationalFeed::class,'index']);
    Route::post('createGroup',[InspirationalFeed::class,'createGroup']);
    Route::post('createEvent',[InspirationalFeed::class,'createEvent']);
    Route::post('hideEventOrReport',[InspirationalFeed::class,'hideEventOrReport']);
    Route::post('fellingSearch', [InspirationalFeed::class, 'fellingSearch']);
    Route::post('activitySearch', [InspirationalFeed::class, 'activitySearch']);
    Route::post('createInspirationalFeedPost', [InspirationalFeed::class, 'createInspirationalFeedPost']);
    Route::post('createInspirationalFeedTestimony', [InspirationalFeed::class, 'createInspirationalFeedTestimony']);
    Route::post('hideInspirationalFeed', [InspirationalFeed::class, 'hideInspirationalFeed']);
    Route::post('likePost', [InspirationalFeed::class, 'likePost']);
    Route::post('sharePostOnTimeLine', [InspirationalFeed::class, 'sharePostOnTimeLine']);
    Route::post('commentOnPost', [InspirationalFeed::class, 'commentOnPost']);
    Route::post('likeComment', [InspirationalFeed::class, 'likeComment']);
    Route::post('replyOnComment', [InspirationalFeed::class, 'replyOnComment']);

    Route::get('events-list', [Home::class, 'eventsList']);
    Route::get('event-detail/{id}', [Home::class, 'eventDetail']);
    Route::post('showInterestInEvent', [Home::class, 'showInterestInEvent']);
    Route::post('isUserGoingInEvent', [Home::class, 'isUserGoingInEvent']);
    Route::get('groups-list', [Home::class, 'groupsList']);
    Route::get('discover-groups-list', [Home::class, 'discoverGroupsList']);
    Route::get('group-detail/{id}', [Home::class, 'groupDetail']);
    Route::post('joinGroup', [Home::class, 'joinGroup']);

    Route::get('profile', [MyProfile::class, 'index']);
    Route::post('profile', [MyProfile::class, 'index']);
    Route::get('edit_details', [MyProfile::class, 'edit_details']);
});

/*--------------------------------------- user routes ----------------------*/

/*------------------------------admin route ---------------------------*/
Route::get('/pwd', [Login::class, 'pwd']);
Route::get('/admin', [Login::class, 'index']);
Route::post('/admin', [Login::class, 'index']);
Route::get('/admin/forgot-password', [Login::class, 'forgotPassword']);
Route::post('/admin/forgot-password', [Login::class, 'forgotPassword']);
Route::get('/admin/logout', [Login::class, 'logout']);
Route::group(['middleware' => 'auth_admin'], function () {
      
  Route::get('/admin/dashboard', [Dashboard::class, 'index']);
     /*------------------ common route ----------------*/
       Route::post('/admin/changeStatus', [Common::class, 'changeStatus']);
       Route::post('/admin/delete', [Common::class, 'delete']);
     /*------------------ common route ----------------*/

    /*------------------- user route ------------------*/
      Route::get('/admin/users-list', [Users::class, 'index']);
      Route::get('/admin/fetchUserData', [Users::class, 'fetchUserData']);
    /*------------------- user route ------------------*/

    /*------------------- events route ------------------*/
    Route::get('/admin/events-list', [Events::class, 'index']);
    Route::get('/admin/add-event', [Events::class, 'addEvent']);
    Route::post('/admin/addUpdateEvent', [Events::class, 'addUpdateEvent']);
    Route::any('/admin/edit-event/{id}', [Events::class, 'editEvent']);
    Route::any('/admin/fetchEventsData', [Events::class, 'fetchEventsData']);
   /*------------------- events route ------------------*/

    /*------------------- cms page route ------------------*/
    Route::get('/admin/cms-page-list', [CMSPage::class, 'index']);
    Route::get('/admin/add-cms-page', [CMSPage::class, 'addCMSPage']);
    Route::post('/admin/addUpdateCMSPage', [CMSPage::class, 'addUpdateCMSPage']);
    Route::any('/admin/edit-cms-page/{id}', [CMSPage::class, 'editCMSPage']);
    Route::any('/admin/fetchCMSPageData', [CMSPage::class, 'fetchCMSPageData']);
    //Route::get('/upload_image_cke', [CMSPage::class, 'upload_image_cke']);
    Route::post('/ckeditor/upload', [CMSPage::class, 'upload_image_cke'])->name('ckeditor.upload');
   /*------------------- cms page route ------------------*/

   /*------------------- banners route ------------------*/
   Route::get('/admin/banners-list', [Banners::class, 'index']);
   Route::get('/admin/add-banner', [Banners::class, 'addBanner']);
   Route::post('/admin/addUpdateBanner', [Banners::class, 'addUpdateBanner']);
   Route::any('/admin/edit-banner/{id}', [Banners::class, 'editBanner']);
   Route::any('/admin/fetchBannersData', [Banners::class, 'fetchBannersData']);
  /*------------------- banners route ------------------*/

});

/*------------------------------admin route ---------------------------*/