<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buyer;
use App\Models\Project;
use App\Models\Category;
use App\Models\PaidProject;
use App\Models\Proposal;
use App\Models\Seller;
use App\Models\UserRole;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function projects()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }


        $pageName = ' Your Posted Projects';
        $title = $user->username . ' ' . 'Projects';


        $buyer = Buyer::where('user_id', $user->user_id)->first();
        $buyerProject = Project::where('buyer_id', $buyer->buyer_id)->orderBy('project_id', 'DESC')->get();

        $activeProjects = PaidProject::where('buyer_id', $buyer->buyer_id)
            ->where('status', 'active')
            ->orderBy('id', 'DESC')->get();
        $completeProjects = PaidProject::where('buyer_id', $buyer->buyer_id)
            ->where('status', 'completed')
            ->orderBy('id', 'DESC')->get();
        $awaitApproveProjects = PaidProject::where('buyer_id', $buyer->buyer_id)
            ->where('status', 'awaiting for approval')
            ->orderBy('id', 'DESC')->get();

        $awaitFeedbackProjects = PaidProject::where('buyer_id', $buyer->buyer_id)
            ->where('status', 'awaiting for feedback')
            ->orderBy('id', 'DESC')->get();

        return view('userprofile.projects', $data, compact('title', 'pageName', 'buyerProject', 'activeProjects', 'awaitFeedbackProjects', 'awaitApproveProjects', 'completeProjects'));
    }


    public function newProject()
    {
        if (session()->has('LoggedUser')) {
            $buyer = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $buyer,
                'roles' =>  UserRole::all()
            ];
        }

        $title =  'Add New Course';
        $pageName = 'Add New Course';

        $catData = Category::all();
        return view('userprofile.newProject', $data, compact('title', 'pageName', 'catData'));
    }

    public function addProject(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $buyerUsername = $user->username;

        $buyer = Buyer::where('buyer_username', $buyerUsername)->first();

        $request->validate([
            'project_title' => 'required|string|max:100',
            'project_category' => 'required|min:1',
            'project_description' => 'required|max:1000',
            'project_duration' => 'required|min:1',
            'project_duration_format' => 'required',
            'project_price' => 'required|min:1'
        ]);

        $project = new Project;

        $project->project_title = $request->project_title;
        $category = Category::where('category_id', $request->project_category)->first();
        $project->project_category = $category->category_name;
        $project->category_id = $request->project_category;
        $project->project_description = $request->project_description;
        $project->project_duration = $request->project_duration;
        $project->project_duration_format = $request->project_duration_format;
        $project->project_price = $request->project_price;
        $project->buyer_username = $buyer->buyer_username;
        $project->buyer_id = $buyer->buyer_id;

        $projectQuery = $project->save();

        if ($projectQuery) {
            return redirect('projects')->with('success', 'Your Project has been added, wait for the proposals from the sellers');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }

    function deleteProject($project_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = Project::find($project_id);
        $query = $project->delete();

        if ($query) {
            return redirect('projects')->with('success', 'Your Project has been deleted successfully');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }

    function viewProject($project_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = Project::find($project_id);
        $title = $project->project_title;
        $pageName = 'Project Details';

        $seller = Seller::where('user_id', $user->user_id)->first();
        $project_category = Category::where('category_id', $project->category_id)->first();

        if ($user->user_role == 'Seller') {
            $proposals = Proposal::where('seller_id', $seller->seller_id)->get();
            // foreach ($proposals as $prop) {
            //     if ($prop->project_id != $project->project_id) {
            //         continue;
            //     } else {
            //         $proposal = Proposal::where('project_id', $project->project_id)->first();
            //         return view('userprofile.viewProject', $data, compact('project', 'project_category', 'title', 'pageName', 'proposal'));
            //     }
            // }

            $proposal = $proposals->where('project_id', $project->project_id)->first();
            return view('userprofile.viewProject', $data, compact('project', 'project_category', 'title', 'pageName', 'proposal'));
        } else {
            return view('userprofile.viewProject', $data, compact('project', 'project_category', 'title', 'pageName'));
        }
    }

    public function edit($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = Project::find($id);
        $title = 'Edit Project';
        $pageName = 'Edit Project';
        $catData = Category::all();
        return view('userprofile.edit-project', $data, compact('project', 'title', 'pageName', 'catData'));
    }
    public function update(Request $request, $project_id)
    {
        // if (session()->has('LoggedUser')) {
        //     $user = User::where('user_id', '=', session('LoggedUser'))->first();
        //     $data = [
        //         'LoggedUserInfo' => $user,
        //         'roles' =>  UserRole::all()
        //     ];
        // }

        // $buyerUsername = $user->username;

        // $buyer = Buyer::where('buyer_username', $buyerUsername)->first();

        $request->validate([
            'project_title' => 'required|string|max:100',
            'project_category' => 'required|min:1',
            'project_description' => 'required|max:1000',
            'project_duration' => 'required|min:1',
            'project_duration_format' => 'required',
            'project_price' => 'required|min:1'
        ]);

        $project = Project::find($project_id);

        $project->project_title = $request->project_title;
        $category = Category::where('category_id', $request->project_category)->first();
        $project->project_category = $category->category_name;
        $project->category_id = $request->project_category;
        $project->project_description = $request->project_description;
        $project->project_duration = $request->project_duration;
        $project->project_duration_format = $request->project_duration_format;
        $project->project_price = $request->project_price;
        // $project->buyer_username = $buyer->buyer_username;
        // $project->buyer_id = $buyer->buyer_id;

        $projectQuery = $project->update();

        if ($projectQuery) {
            return redirect('projects')->with('success', 'Your Project has been updated');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }
}
