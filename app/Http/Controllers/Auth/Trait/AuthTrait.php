<?php

namespace App\Http\Controllers\Auth\Trait;

use App\Events\Auth\UserLoginSuccess;
use App\Events\Frontend\UserRegistered;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Modules\Service\Models\SystemService;


trait AuthTrait
{
    protected function loginTrait($request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember_me;

    
           if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1], $remember)) {
               event(new UserLoginSuccess($request, auth()->user()));

                return true;
            }

             return false;
    }

    protected function checkService($request){

        $email = $request->email;

        $user=User::where('email',$email)->first();

        $islogin=1;

        if(!$user){

            return  $islogin;
        }

        $user_type=$user->user_type;

        switch($user_type) {
            case 'vet':

             $service=SystemService::active()->where('type','veterinary')->get();
             $islogin = $service->isNotEmpty() ? 1 : 0;
                 
                break;
            case 'groomer':

                $service=SystemService::active()->where('type','grooming')->get();
                $islogin = $service->isNotEmpty() ? 1 : 0;
             
                break;
            case 'walker':

                $service=SystemService::active()->where('type','walking')->get();
                $islogin = $service->isNotEmpty() ? 1 : 0;
              
                break;
            case 'boarder':

                $service=SystemService::active()->where('type','boarding')->get();
                $islogin = $service->isNotEmpty() ? 1 : 0;
               
                break;
            case 'trainer':

                $service=SystemService::active()->where('type','training')->get();
                $islogin = $service->isNotEmpty() ? 1 : 0;
               
                break;
            case 'day_taker':

                $service=SystemService::active()->where('type','daycare')->get();
                $islogin = $service->isNotEmpty() ? 1 : 0;
               
            default:

              $islogin=1;
              
                break;
          }

        return  $islogin;

    }




    protected function registerTrait($request, $model = null)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $arr = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ];

        if (isset($model)) {
            $user = $model::create($arr);
        } else {
            $user = User::create($arr);
        }
        $user->assignRole('user');

        $user->save();

        event(new Registered($user));
        event(new UserRegistered($user));

        return $user;
    }
}
