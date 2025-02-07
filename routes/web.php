<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('user-dashboard');
});


Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->role == 1) {
            return redirect()->route('Admindashboard');
           }
           else if (auth()->user()->role == 2) {
            return redirect()->route('director-dashboard');
           }
        //    else{
        //     return redirect()->route('user-dashboard');
        //    }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admindashboard', function(){
            return view('admin.index');
        })->name('Admindashboard');

        Route::get('/OfficeDepartment', function(){
            return view('admin.officedepartment');
        })->name('office');

        Route::get('/survey', function(){
            return view('admin.survey');
        })->name('survey');

        Route::get('/results', function(){
            return view('admin.results');
        })->name('results');

        Route::get('/remarks', function(){
            return view('admin.remarks');
        })->name('rem');

        Route::get('/cc', function(){
            return view('admin.cc-list');
        })->name('admin.cc-list');
     });

    //  Route::prefix('user')->middleware('user')->group(function(){



    // });

    Route::prefix('director')->middleware('director')->group(function(){
        Route::get('/dashboard', function(){
               return view('director.index');
           })->name('director-dashboard');

           Route::get('/director.accounts', function(){
            return view('director.add-account');
        })->name('director-add-account');

        Route::get('/director.survey', function(){
            return view('director.survey-question');
        })->name('director.survey');
    });


Route::get('/welcome', function(){
        return view('user.index');
    })->name('user-dashboard');

Route::get('/survey', function(){
     return view('user.take-survey');
 })->name('take-survey');

 Route::get('/offline-form', function(){
    return view('user.offline-form');
})->name('offline');

Route::get('/online-form', function(){
    return view('user.online-form');
})->name('online');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
