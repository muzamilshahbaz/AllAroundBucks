<?php

namespace App\Http\Controllers;

use App\Models\EmployementHistory;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\True_;

class EmployementHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $pageName = ' Add Emloyement';
        $title = $user->username . ' ' . 'New Employement';
        return view('userprofile.add-employement', $data, compact('pageName', 'title'));
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
            'employement_title' => 'required|string|max:30',
            'company_name' => 'required|string|max:30',
            'start_date' => 'required',
        ]);

        $employement = new EmployementHistory;

        $employement->employement_title = $request->employement_title;
        $employement->user_id = $user->user_id;
        $employement->company_name = $request->company_name;
        $employement->start_date = date('Y-m-d', strtotime($request->start_date));


            if ($request->has('end_date')) {
                $employement->end_date = date('Y-m-d', strtotime($request->end_date));
            }
            else{
                $employement->end_date = null;
                $employement->present = 'present';
            }



        $query = $employement->save();
        if ($query) {
            return redirect('profile')->with('success', 'Your Employement has been added.');
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
        $employement = EmployementHistory::find($id);
        $pageName = ' Edit Emloyement';
        $title = $user->username . ' ' . 'Edit Employement';
        return view('userprofile.edit-employement', $data, compact('pageName', 'title', 'employement'));
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
            'employement_title' => 'required|string|max:30',
            'company_name' => 'required|string|max:30',
            'start_date' => 'required',
        ]);

        $employement = EmployementHistory::find($id);

        $employement->employement_title = $request->employement_title;
        $employement->user_id = $user->user_id;
        $employement->company_name = $request->company_name;
        $employement->start_date = date('Y-m-d', strtotime($request->start_date));


            if ($request->has('end_date')) {
                $employement->end_date = date('Y-m-d', strtotime($request->end_date));
            }
            else{
                $employement->end_date = null;
                $employement->present = 'present';
            }

        $query = $employement->update();

        if ($query) {
            return redirect('profile')->with('success', 'Your Employement has been updated.');
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
        $query = EmployementHistory::find($id)->delete();
        if ($query) {
            return redirect('profile')->with('success', 'Your Employement has been deleted.');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }
}
