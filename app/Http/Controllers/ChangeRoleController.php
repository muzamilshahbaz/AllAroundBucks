<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class ChangeRoleController extends Controller
{
    public function changeRole(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $user->user_role = $request->user_role;

        $user->update();


        if ($user->user_role == 'Seller') {
            $exist = Seller::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('dashboard')->with('success', 'Now you are using AllAroundBucks as a Seller.');
            } else {
                $seller = new Seller;

                $seller->user_id = $user->user_id;
                $seller->seller_username = $user->username;

                $query = $seller->save();
            }
        } elseif ($user->user_role == 'Buyer') {
            $exist = Buyer::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('hiredirect')->with('success', 'Now you are using AllAroundBucks as a Buyer.');
            } else {
                $buyer = new Buyer;
                $buyer->user_id = $user->user_id;
                $buyer->buyer_username = $user->username;

                $query = $buyer->save();
            }
        } elseif ($user->user_role == 'Trainer') {
            $exist = Trainer::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('dashboard')->with('success', 'Now you are using AllAroundBucks as a Trainer.');
            } else {
                $trainer = new Trainer;
                $trainer->user_id = $user->user_id;
                $trainer->trainer_username = $user->username;

                $query = $trainer->save();
            }
        } elseif ($user->user_role == 'Student') {
            $exist = Student::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('courses')->with('success', 'Now you are using AllAroundBucks as a Student.');
            } else {
                $student = new Student;
                $student->user_id = $user->user_id;
                $student->student_username = $user->username;

                $query = $student->save();
            }
        }

        if ($query) {
            # code...
            if ($user->user_role == 'Seller' ||  $user->user_role == 'Trainer') {
                return redirect('dashboard')->with('success', 'Congratulations!! You have completed your registeration process, now you can continue with AllAroundBucks.');
            } elseif ($user->user_role == 'Buyer') {
                return redirect('hiredirect')->with('success', 'Congratulations!! You have completed your registeration process, now you can continue with AllAroundBucks.');
            } elseif ($user->user_role == 'Student') {
                return redirect('courses')->with('success', 'Congratulations!! You have completed your registeration process, now you can continue with AllAroundBucks.');
            }
        } else {
            # code...
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }
}
