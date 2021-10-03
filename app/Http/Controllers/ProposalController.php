<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use App\Models\Proposal;
use App\Models\User;
use App\Models\Category;
use App\Models\Seller;
use App\Models\UserRole;
use App\Notifications\ProposalReject;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class ProposalController extends Controller
{
    function writeProposal($project_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = Project::find($project_id);
        $project_category = Category::where('category_id', $project->category_id)->first();
        $pageName = 'Project';
        $title = 'Send Proposal';
        return view('proposal.write-proposal', $data, compact('project', 'project_category', 'title', 'pageName'));

    }

    function sendProposal(Request $request, $project_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $request->validate([
            'duration'=>'required',
            'price'=>'required',
            'cover_letter'=>'required|max:1000'
        ]);

        $project = Project::find($project_id);
        $seller = Seller::where('user_id', $user->user_id)->first();
        $proposal = new Proposal;
        $proposal->project_id = $project_id;
        $proposal->project_title = $project->project_title;
        $proposal->buyer_id = $project->buyer_id;
        $proposal->buyer_username = $project->buyer_username;
        $proposal->seller_id = $seller->seller_id;
        $proposal->seller_username = $seller->seller_username;
        $proposal->duration = $request->duration;
        $proposal->duration_format = $request->duration_format;
        $proposal->price = $request->price;
        $proposal->cover_letter = $request->cover_letter;

        $query = $proposal->save();

        if ($query) {
            return redirect('projectsfeed')->with('success', 'Your Proposal has been sent to buyer. Wait for response.');
        } else {
            return back()->with('fail', 'Something went wrong.');

        }


    }


    function proposals()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $seller = Seller::where('user_id', $user->user_id)->first();
        $proposals = Proposal::where('seller_id', $seller->seller_id)->orderBy('proposal_id', 'DESC')->get();

        $pageName = 'Proposals';
        $title = 'Proposals';
        return view('proposal.proposals', $data, compact('proposals','title', 'pageName'));

    }

    function projectProposals($project_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = Project::find($project_id);
        $proposals = Proposal::where('project_id', $project_id)->get()->sortByDesc('proposal_id');

        $pageName = $project->project_title.' Proposals';
        $title = 'Proposals';
        return view('proposal.project-proposals', $data, compact('proposals','title', 'pageName'));

    }

    function rejectProposal($proposal_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $proposal = Proposal::find($proposal_id);
        $seller = User::where('username', $proposal->seller_username)->first();

        $proposal->status = 'reject';

        $proposalReject = [
            'body'=>'You have got a news about your proposal.',
            'rejectText' => 'Your proposal for this project has been rejected by '.$proposal->buyer_username.'.',
            'url'=> url('/'),
            'thankyou'=> 'Try sending a winning proposal next time.'
        ];

       $seller->notify(new ProposalReject($proposalReject));
       $query = $proposal->update();

        if ($query) {
            return back()->with('success', 'Proposal has been rejected.');
        } else {
            return back()->with('fail', 'Something went wrong.');
        }

    }

    function acceptProposal($proposal_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $proposal = Proposal::find($proposal_id);

        $seller = User::where('username', $proposal->seller_username)->first();

        $project = Project::where('project_id', $proposal->project_id)->first();
        $pageName = 'Project Payment';
        $title = 'Project Payment';
        return view('payment.projectpayment', $data, compact('project', 'proposal','title', 'pageName'));


    }
}
