<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MediaProductController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\MailerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['cors'])->group(function () {
    // Your routes here


    // Brand Routes
    Route::Get('/getbrand/{id}', [BrandController::class, 'getBrand']);
    Route::Get('/brand', [BrandController::class, 'getAllBrand']);
    Route::Patch('/editbrand/{id}', [BrandController::class, 'editBrand']);
    Route::Post('/brand', [BrandController::class, 'addBrand']);
    Route::Delete('/brand/{id}', [BrandController::class, 'deleteBrand']);
    // Brand Routes

    // Department Route
    Route::Post('/department', [DepartmentController::class, 'addDepartment']);
    Route::Get('/getdepartment/{id}', [DepartmentController::class, 'getDepartment']);
    Route::Get('/department', [DepartmentController::class, 'getAllDepartment']);
    Route::Patch('/editdepartment/{id}', [DepartmentController::class, 'editDepartment']);
    Route::Delete('/department/{id}', [DepartmentController::class, 'deleteDepartment']);
    // Department Route

    // Collection Route
    Route::Post('/collection', [CollectionController::class, 'addCollection']);
    Route::Get('/getcollection/{id}', [CollectionController::class, 'getcollection']);
    Route::Get('/collection', [CollectionController::class, 'getAllCollection']);
    Route::Patch('/editcollection/{id}', [CollectionController::class, 'editCollection']);
    Route::Delete('/collection/{id}', [CollectionController::class, 'deleteCollection']);
    // Collection Route

    // Category Route
    Route::Post('/category', [CategoryController::class, 'addCategory']);
    Route::Get('/getcategory/{id}', [CategoryController::class, 'getCategory']);
    Route::Get('/category', [CategoryController::class, 'getAllCategory']);
    Route::Get('/category/{departmentId}', [CategoryController::class, 'getCategoryByDepartment']);
    Route::Patch('/editcategory/{id}', [CategoryController::class, 'editCategory']);
    Route::Delete('/category/{id}', [CategoryController::class, 'deleteCategory']);
    // Category Route

    // Subcategory Route
    Route::Post('/subcategory', [SubCategoryController::class, 'addSubcategory']);
    Route::Get('/getsubcategory/{id}', [SubCategoryController::class, 'getSubcategory']);
    Route::Get('/subcategory', [SubCategoryController::class, 'getAllSubcategory']);
    Route::Get('/subcategory/{categoryId}', [SubCategoryController::class, 'getSubcategoryByCategory']);
    Route::Patch('/editsubcategory/{id}', [SubCategoryController::class, 'editSubcategory']);
    Route::Delete('/subcategory/{id}', [SubCategoryController::class, 'deleteSubcategory']);
    // Subcategory Route

    // Product Route
    Route::Post('/product', [ProductController::class, 'addProduct']);
    Route::Get('/getproduct/{id}', [ProductController::class, 'getProduct']);
    Route::Get('/product/{subcategoryId}', [ProductController::class, 'getProductBySubcategory']);
    Route::Get('/productforcollection/{collectionId}', [ProductController::class, 'getProductsForCollection']);
    Route::Get('/productcollection/{productId}', [ProductController::class, 'getProductByCollection']);
    Route::Get('/product', [ProductController::class, 'getAllProduct']);
    Route::Get('/latestproduct', [ProductController::class, 'getlatestProducts']);
    Route::Patch('/editproduct/{id}', [ProductController::class, 'editProduct']);
    Route::Delete('/product/{id}', [ProductController::class, 'deleteProduct']);
    // Product Route

    // MediaProduct Route
    Route::Post('/mediaproduct', [MediaProductController::class, 'addImage']);
    Route::Get('/getmedia/{id}', [MediaProductController::class, 'getImage']);
    Route::Get('/media/{productId}', [MediaProductController::class, 'getImageByProduct']);
    Route::Get('/mediaproduct', [MediaProductController::class, 'getAllImage']);
    Route::Patch('/editmediaproduct/{id}', [MediaProductController::class, 'editImage']);
    Route::Delete('/mediaproduct/{id}', [MediaProductController::class, 'deleteImage']);


    // MediaProduct Route

    // Tag Route
    Route::Post('/tag', [TagController::class, 'addTag']);
    Route::Get('/gettag/{id}', [TagController::class, 'getTag']);
    Route::Get('/tag', [TagController::class, 'getAllTag']);
    Route::Patch('/edittag/{id}', [TagController::class, 'editTag']);
    Route::Delete('/tag/{id}', [TagController::class, 'deleteTag']);
    // Tag Route

    // Size Route
    Route::Post('/size', [SizeController::class, 'addSize']);
    Route::Get('/getSize/{id}', [SizeController::class, 'getSize']);
    Route::Get('/productsize/{productId}', [SizeController::class, 'getSizeOfProduct']);
    Route::Get('/size', [SizeController::class, 'getAllSize']);
    Route::Patch('/editSize/{id}', [SizeController::class, 'editSize']);
    Route::Delete('/size/{id}', [SizeController::class, 'deleteSize']);
    // Size Route



    // Authentication Route 
    Route::post('/register', [UserAuth::class, 'register']);
    Route::post('/login', [UserAuth::class, 'login']);
    Route::post('/logout', [UserAuth::class, 'logout']);
    Route::post('/reset-email', [UserAuth::class, 'sendResetCode']);
    Route::get('/users', [UserAuth::class, 'getAllUsers']);
    Route::get('/user/{id}', [UserAuth::class, 'getUserById']);
    Route::put('/update/{id}', [UserAuth::class, 'updateUser']);
    Route::delete('/user/{id}', [UserAuth::class, 'deleteUser']);

    Route::post("send-reset-link", [UserAuth::class, "sendResetLink"])->name("send-reset-link");
});
