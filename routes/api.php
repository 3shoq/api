<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\Models\post;
use App\http\Resources\UsersResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\userPostsResource;
use App\Http\Controllers\PostController;
use App\http\Resources\UsersCommentsResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\tokenResource;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\SanctumServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\CommentController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/users' ,[UserController::class, 'index'] );
Route::get('/users/{id}', [UserController::class , 'show']);
Route::get('/posts/users/{id}', [UserController::class , 'posts']);
Route::get('/comments/users/{id}',[UserController::class , 'comments']);
    



// end of users 


/*
*@Post togory Related 

*/

Route::get('/category', [CategoryController::class, 'index']) ;
Route::get('/category', [CategoryController::class, 'index']) ;
Route::get('/posts/category/{id}', [CategoryController::class, 'posts']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show'] );




//end post

/*
*@Comment togory Related 

*/

Route::get('/comments/posts/{id}',[PostController::class , 'comments']  );
Route::get('/comments',[PostController::class , 'allcomments']);


//end


Route::post('/login',[UserController::class , 'login'] );
Route::post('/register', [UserController::class, 'register']) ;








Route::group(['middleware' => ['auth:sanctum']], function(){
    //All secure URL's
    //Route::post('/update-user/{id}',[UserController::class , 'update'] );
    Route::get('/mohammed', function(){
        return 'product';
    });

    Route::post('/update-user/{id}',[UserController::class , 'update'] );

    //Route::post('posts', [PostController::class, 'store'] );
    Route::post('/logout', [UserController::class, 'logout']) ;
    Route::post('newposts', [PostController::class, 'store'] );
    Route::post('newposts/{id}', [PostController::class, 'update'] );
    Route::delete('newposts/{id}', [PostController::class, 'destroy'] );


    Route::post('comments/newposts/{id}', [CommentController::class, 'store'] );

    Route::post('votes/posts/{id}', [PostController::class , 'votes'] ) ;


    });


    //Route::get('/category', [CategoryController::class, 'index']) ;

    



//Route::middleware('auth:api')->get('/user', function (Request $request) {
 //   return $request->user();
//});
