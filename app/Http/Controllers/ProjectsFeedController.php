<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Buyer;
use App\Models\Project;
use App\Models\Category;

class ProjectsFeedController extends Controller
{
   public function projectsfeed()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

            $projects = Project::all()->sortByDesc('project_id');


            $pageName = 'Projects Feed';
            $title = 'Projects Feed';

            return view('userprofile.projectsfeed', $data, compact('title','pageName','projects'));
    }

    public function searchProject(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $projects = Project::where('project_title', 'like', '%'. $request->project_search_query.'%')
                        ->orWhere('project_category', 'like', '%'. $request->project_search_query.'%')
                        ->orWhere('project_description', 'like', '%'. $request->project_search_query.'%')
                        ->orWhere('buyer_username', 'like', '%'. $request->project_search_query.'%')
                        ->get()
                        ->sortByDesc('project_id');

        $pageName = 'Search Projects Results';
        $title = 'Search Results';

        return view('userprofile.projectsfeed', $data, compact('title','pageName','projects'));
    }

}
