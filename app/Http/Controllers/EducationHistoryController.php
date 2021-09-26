<?php

namespace App\Http\Controllers;

use App\Models\EducationHistory;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class EducationHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = ' Add Education';
        $title = $user->username . ' ' . 'New Education';
        return view('userprofile.add-education', $data, compact('pageName', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $request->validate([
            'degree' => 'required|string|max:30',
            'school_name' => 'required|string|max:30',
            'start_date' => 'required',
        ]);

        $education = new EducationHistory;

        $education->degree = $request->degree;
        $education->user_id = $user->user_id;
        $education->school_name = $request->school_name;
        $education->start_date = date('Y-m-d', strtotime($request->start_date));


            if ($request->has('end_date')) {
                $education->end_date = date('Y-m-d', strtotime($request->end_date));
            }
            else{
                $education->end_date = null;
                $education->present = 'present';
            }



        $query = $education->save();
        if ($query) {
            return redirect('profile')->with('success', 'Your education has been added.');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $education = EducationHistory::find($id);
        $pageName = ' Edit Emloyement';
        $title = $user->username . ' ' . 'Edit education';
        return view('userprofile.edit-education', $data, compact('pageName', 'title', 'education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $request->validate([
            'degree' => 'required|string|max:30',
            'school_name' => 'required|string|max:30',
            'start_date' => 'required',
        ]);

        $education = EducationHistory::find($id);

        $education->degree = $request->degree;
        $education->user_id = $user->user_id;
        $education->school_name = $request->school_name;
        $education->start_date = date('Y-m-d', strtotime($request->start_date));


            if ($request->has('end_date')) {
                $education->end_date = date('Y-m-d', strtotime($request->end_date));
            }
            else{
                $education->end_date = null;
                $education->present = 'present';
            }

        $query = $education->update();

        if ($query) {
            return redirect('profile')->with('success', 'Your education has been updated.');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = EducationHistory::find($id)->delete();
        if ($query) {
            return redirect('profile')->with('success', 'Your education has been deleted.');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }
}
