<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsFeedController;

use App\Mail\WelcomeMail;
use App\Models\Project;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Http\Request;

use App\Events\Message;
use App\Http\Controllers\PaidProjectController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Models\PaidProject;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PagesController::class, 'home'])->middleware('AlreadyLoggedIn');
Route::get('howitworks', [PagesController::class, 'howitworks'])->middleware('AlreadyLoggedIn');
Route::get('ourtrainers', [PagesController::class, 'ourtrainers'])->middleware('AlreadyLoggedIn');
Route::get('/contact-us', function () {
    $title = 'Contact Us - AllAroundBucks';
    return view('pages.contact', compact('title'));
});
Route::get('signin', [PagesController::class, 'signin'])->middleware('AlreadyLoggedIn');
Route::get('signup', [PagesController::class, 'signup'])->middleware('AlreadyLoggedIn');

Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('dashboard',[UserController::class, 'dashboard'])->middleware('isLogged');

Route::get('hiredirect',[UserController::class, 'hiredirect'])->middleware('isLogged');

Route::get('/profile',[UserController::class, 'profile'])->middleware('isLogged');
//Route::get('coursefeed',[UserController::class, 'courses'])->middleware('isLogged');


Route::get('logout',[LogoutController::class, 'logout']);
Route::get('index',[LogoutController::class, 'index'])->middleware('AlreadyLoggedIn');

Route::get('user/{username}',[UserController::class, 'user'])->middleware('isLogged');

Route::get('/courses',[UserController::class, 'courses'])->middleware('isLogged');

Route::get('addCourseForm',[CoursesController::class, 'addCourseForm'])->middleware('isLogged');

Route::post('addCourse',[CoursesController::class, 'addVideo'])->middleware('isLogged');

Route::post('addCourse',[CoursesController::class, 'addCourse'])->middleware('isLogged');

Route::get('coursedetails/{course_id}',[CoursesController::class, 'coursedetails'])->middleware('isLogged');

Route::get('projects',[ProjectsController::class, 'projects'])->middleware('isLogged');

Route::get('newProject',[ProjectsController::class, 'newProject'])->middleware('isLogged');

Route::post('addProject',[ProjectsController::class, 'addProject'])->middleware('isLogged');

Route::get('projectsfeed',[ProjectsFeedController::class, 'projectsfeed'])->middleware('isLogged');



Route::get('/google', [LoginController::class, 'redirectToGoogle'])->middleware('AlreadyLoggedIn');;
Route::get('/callback/google', [LoginController::class, 'handleGoogleCallback'])->middleware('AlreadyLoggedIn');;

Route::get('/facebook', [LoginController::class, 'redirectToFacebook'])->middleware('AlreadyLoggedIn');;
Route::get('/callback/facebook', [LoginController::class, 'handleFacebookCallback'])->middleware('AlreadyLoggedIn');;

Route::get('/verifyaccount', [RegisterController::class, 'verifyaccount']);

Route::post('/verify', [RegisterController::class, 'verify']);

Route::get('/editprofile/{user_id}',[UserController::class, 'editprofile'])->middleware('isLogged');


Route::put('/updateprofile/{id}', [UserController::class, 'updateprofile'])->middleware('isLogged');

Route::get('/delete-project/{project_id}', [ProjectsController::class, 'deleteProject'])->middleware('isLogged');;

Route::get('/project/{project_id}', [ProjectsController::class, 'viewProject'])->middleware('isLogged');

Route::get('/inbox', [UserController::class, 'inbox'])->middleware('isLogged');

Route::get('/settings', [UserController::class, 'settings'])->middleware('isLogged');

Route::get('/sellerearnings', [UserController::class, 'earnings'])->middleware('isLogged');
Route::get('/trainerearnings', [UserController::class, 'earnings'])->middleware('isLogged');


Route::get('/deactivate_account/{user_id }', [SettingsController::class, 'deactivate'])->middleware('isLogged');

Route::get('/savePersonalInfo', [SettingsController::class, 'savePersonalInfo'])->middleware('isLogged');

Route::get('/changePassword', [SettingsController::class, 'changePassword'])->middleware('isLogged');

Route::post('/send-message', function (Request $request) {
    event(
        new Message(
            $request->input('username'),
            $request->input('message')
        )
    );

    return ['success'=> true];
});


Route::get('write-proposal/{project_id}', [ProposalController::class, 'writeProposal'])->middleware('isLogged');

Route::post('send-proposal/{project_id}',[ProposalController::class, 'sendProposal'])->middleware('isLogged');

Route::get('proposals', [ProposalController::class, 'proposals']);

Route::get('project-proposals/{project_id}', [ProposalController::class, 'projectProposals'])->middleware('isLogged');

Route::get('reject-proposal/{proposal_id}', [ProposalController::class, 'rejectProposal'])->middleware('isLogged');

Route::get('accept-proposal/{proposal_id}', [ProposalController::class, 'acceptProposal'])->middleware('isLogged');

Route::get('roleName', [RegisterController::class, 'roleName']);

Route::put('roleAndUsername/{user_id}', [RegisterController::class, 'roleAndUserName'])->middleware('isLogged');

Route::get('acceptAndPay/{proposal_id}', [PaidProjectController::class, 'acceptAndPay'])->middleware('isLogged');

Route::get('projectsstatus', [PaidProjectController::class, 'projectsstatus'])->middleware('isLogged');

Route::get('send-project/{id}', [PaidProjectController::class, 'sendProject'])->middleware('isLogged');

Route::put('projectSend/{id}', [PaidProjectController::class, 'projectSend'])->middleware('isLogged');

Route::get('approve-project/{id}', [PaidProjectController::class,'approveProject'])->middleware('isLogged');

Route::put('buyerFeedback/{id}', [PaidProjectController::class, 'buyerFeedback'])->middleware('isLogged');

Route::put('sellerFeedback/{id}', [PaidProjectController::class, 'sellerFeedback'])->middleware('isLogged');

Route::get('search-projects', [ProjectsFeedController::class, 'searchProject'])->middleware('isLogged');

Route::put('/change-role', [UserController::class, 'changeRole'])->middleware('isLogged');


Route::post('/visitor/search', [SearchController::class, 'visitorSearch']);
