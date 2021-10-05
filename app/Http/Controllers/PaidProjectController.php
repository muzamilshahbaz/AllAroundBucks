<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\PaidProject;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Seller;
use App\Models\User;
use App\Models\UserRole;
use App\Notifications\ProposalAccept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PaidProjectController extends Controller
{
    function projectsstatus()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $seller = Seller::where('user_id', $user->user_id)->first();

        $project = PaidProject::where('seller_id', $seller->seller_id)->get();
        $projects = $project->sortByDesc('id');

        $activeProjects = PaidProject::where('seller_id', $seller->seller_id)
            ->where('status', 'active')
            ->orderBy('id', 'DESC')->get();
        $completeProjects = PaidProject::where('seller_id', $seller->seller_id)
            ->where('status', 'completed')
            ->orderBy('id', 'DESC')->get();
        $awaitApproveProjects = PaidProject::where('seller_id', $seller->seller_id)
            ->where('status', 'awaiting for approval')
            ->orderBy('id', 'DESC')->get();

        $awaitFeedbackProjects = PaidProject::where('seller_id', $seller->seller_id)
            ->where('status', 'awaiting for feedback')
            ->orderBy('id', 'DESC')->get();

        $pageName = 'Projects Status';
        $title = 'Projects Status';

        return view('userprofile.projectsstatus', $data, compact('projects', 'title', 'pageName', 'activeProjects', 'awaitFeedbackProjects', 'awaitApproveProjects', 'completeProjects'));
    }

    function sendProject($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = PaidProject::find($id);

        $pageName = 'Send Project';
        $title = 'Send Project';

        return view('userprofile.send-project', $data, compact('project', 'title', 'pageName'));
    }

    function projectSend(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = PaidProject::find($id);

        $request->validate(
            [
                'message' => 'required',
                'project_file' => 'required|file|mimes:zip,rar',
            ]

        );

        $project->message = $request->message;

        if ($request->hasFile('project_file')) {
            $destination = 'assets/users/projects/' . $project->project_file;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $projectFile =  $request->file('project_file');
            $projectFileName = $projectFile->getClientOriginalName();
            $projectFile->move(public_path('assets\users\userprofile\projects'),  $projectFileName);
            $project->project_file = $projectFileName;
        }
        $project->status = 'awaiting for approval';
        $query = $project->update();

        if ($query) {
            return redirect('projectsstatus')->with('success', 'You have successfully send the project, wait for the buyer for approval.');
        } else {
            return back()->with('fail', 'Something went wrong....Try Again !!');
        }
    }
    public function changes($id, Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = PaidProject::find($id);
        $project->status = 'active';
        $project->buyer_feedback = $request->buyer_feedback;
        $query = $project->update();

        if ($query) {
            return redirect('projects')->with('success', 'You have asked buyer for changes.');
        } else {
            return back()->with('fail', 'Something went wrong....Try Again !!');
        }
    }


    function buyerFeedback(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = PaidProject::find($id);

        $request->validate([
            'buyer_feedback' => 'required',
            'project_rating' => 'required'
        ]);

        $project->buyer_feedback = $request->buyer_feedback;
        $project->project_rating = $request->project_rating;
        $project->status = 'completed';

        $query1 = $project->update();

        $seller = Seller::where('seller_id', $project->seller_id)->first();

        $projects = PaidProject::where('seller_id', $seller->seller_id)->get();



        $seller->rating = $projects->sum('project_rating') / ($seller->total_projects);

        $query2 = $seller->update();

        if ($query1 && $query2) {
            return redirect('projects')->with('success', 'Project has been completed.');
        } else {
            return back()->with('fail', 'something went wrong.');
        }
    }

    function sellerFeedback(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = PaidProject::find($id);

        $request->validate([
            'seller_feedback' => 'required',
            'buyer_project_rating' => 'required'
        ]);

        $project->seller_feedback = $request->seller_feedback;
        $project->buyer_project_rating = $request->buyer_project_rating;


        $buyer = Buyer::where('buyer_id', $project->buyer_id)->first();

        $projects = PaidProject::where('buyer_id', $buyer->buyer_id)->get();

        $buyer->rating = $projects->sum('buyer_project_rating') / ($buyer->total_projects);
        $query1 = $project->update();
        $query2 = $buyer->update();

        if ($query1 && $query2) {
            return redirect('projectsstatus')->with('success', 'You have provided the feedback.');
        } else {
            return back()->with('fail', 'something went wrong.');
        }
    }


}
