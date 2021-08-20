<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\PaidProject;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Seller;
use App\Models\User;
use App\Notifications\ProposalAccept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PaidProjectController extends Controller
{
    function acceptAndPay($proposal_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }
        $proposal = Proposal::find($proposal_id);
        $seller = User::where('username', $proposal->seller_username)->first();
        $project = Project::where('project_id', $proposal->project_id)->first();

        $project->status = 'active';
        $project->update();

        $paidProject = new PaidProject;

        $paidProject->project_id = $project->project_id;
        $paidProject->project_title = $project->project_title;
        $category = Category::where('category_id', $project->category_id)->first();
        $paidProject->project_category = $category->category_name;
        $paidProject->proposal_id = $proposal->proposal_id;
        $paidProject->buyer_id = $project->buyer_id;
        $paidProject->buyer_username = $project->buyer_username;
        $paidProject->seller_id = $proposal->seller_id;
        $paidProject->seller_username = $proposal->seller_username;
        $paidProject->duration = $proposal->duration;
        $paidProject->duration_format = $proposal->duration_format;
        $paidProject->price = $proposal->price;
        $paidProject->status = 'active';

             $proposal->status = 'accept';

        $proposalAccept = [
            'body'=>'You have got a news about your proposal.',
            'acceptText' => 'Congratulations !! Your proposal for this project has been accepted by '.$proposal->buyer_username.'.',
            'url'=> url('/'),
            'thankyou'=> 'Visit Projects section and start working on this project.'
        ];

       $seller->notify(new ProposalAccept($proposalAccept));

        $proposal->update();

        $query = $paidProject->save();

        if ($query) {
            return redirect('projects')->with('success', 'You accepted the proposal and paid for the project. Wait for the seller to complete the project.');
        } else {
            return back()->with('fail', 'Something went wrong!!');
        }

    }

    function projectsstatus()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $seller = Seller::where('user_id', $user->user_id)->first();

        $project = PaidProject::where('seller_id', $seller->seller_id)->get();
        $projects = $project->sortByDesc('id');
        $pageName = 'Projects Status';
        $title = 'Projects Status';

        return view('userprofile.projectsstatus', $data, compact('projects', 'title', 'pageName'));
    }

    function sendProject($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
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
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $project = PaidProject::find($id);

        $request->validate([
            'message'=>'required',
            'project_file'=>'required|max:120000'
        ]);

        $project->message = $request->message;

        if($request->hasFile('project_file'))
        {
            $destination = 'assets/users/projects/'.$project->project_file;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $projectFile =  $request->file('project_file');
            $projectFileName = $project->buyer_username.'-'.$project->seller_username.'-'.$project->project_title.'.'.$projectFile->extension();
            $projectFile->move(public_path('assets\users\userprofile'),  $projectFileName);
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

    function approveProject($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $project = PaidProject::find($id);
        $project->status = 'awaiting for feedback';
        $seller = Seller::where('seller_id', $project->seller_id)->first();
        $seller->increment('total_projects');
        $seller->earnings = $seller->earnings + $project->price;
        $project->update();
        $seller->update();
        $buyer = Buyer::where('buyer_id', $project->buyer_id)->first();
        $buyer->increment('total_projects');
        $buyer->update();

        return redirect('projects')->with('success', 'Project has been approved, give feedback and rate this project.');
    }

    function buyerFeedback(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $project = PaidProject::find($id);

        $request->validate([
            'buyer_feedback'=>'required',
            'project_rating'=>'required'
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
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $project = PaidProject::find($id);

        $request->validate([
            'seller_feedback'=>'required',
            'buyer_project_rating'=>'required'
        ]);

        $project->seller_feedback = $request->seller_feedback;
        $project->buyer_project_rating = $request->buyer_project_rating;


        $buyer = Buyer::where('buyer_id', $project->buyer_id)->first();

        $projects = PaidProject::where('buyer_id', $buyer->buyer_id)->get();



        $buyer->rating = $projects->sum('`buyer_project_rating') / ($buyer->total_projects);
        $query1 = $project->update();
        $query2 = $buyer->update();

        if ($query1 && $query2) {
            return redirect('projectsstatus')->with('success', 'You have provided the feedback.');
        } else {
            return back()->with('fail', 'something went wrong.');
        }


    }


}
