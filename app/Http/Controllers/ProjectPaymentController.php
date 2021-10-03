<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\PaidProject;
use App\Models\Project;
use App\Models\ProjectPayment;
use App\Models\Proposal;
use App\Models\Seller;
use App\Models\User;
use App\Models\UserRole;
use App\Notifications\ProposalAccept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe;

class ProjectPaymentController extends Controller
{
    public function acceptAndPay(Request $request, $proposal_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $proposal = Proposal::find($proposal_id);
        $seller = User::where('username', $proposal->seller_username)->first();
        $project = Project::where('project_id', $proposal->project_id)->first();

        $project->status = 'active';


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

        $query = $paidProject->save();

        $proposal->status = 'accept';



        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
       $charge =  Stripe\Charge::create([
            'amount' => $proposal->price * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            // 'customer' => 'Test',
            'description' => $proposal->buyer_username . ' Paid for the project with Project ID: ' . $paidProject->project_id . ' to ' . $proposal->seller_username,
        ]);

        // return $charge->id;

        $project_payment = new ProjectPayment;
        $project_payment->card_holder = $request->card_holder;
        $project_payment->project_id = $proposal->project_id;
        $project_payment->paid_project_id = $paidProject->id;
        $project_payment->payment_intent_id = $charge->id;
        $project_payment->card_number = $request->card_number;
        $project_payment->cvc = Hash::make($request->cvc);
        $project_payment->exp_month = $request->month;
        $project_payment->exp_year = $request->year;
        $project_payment->status = 'paid';

        // return $project_payment;
        $query2 = $project_payment->save();
        $project->update();
        $proposal->update();


        $proposalAccept = [
            'body' => 'You have got a news about your proposal.',
            'acceptText' => 'Congratulations !! Your proposal for this project has been accepted by ' . $proposal->buyer_username . '.',
            'url' => url('/'),
            'thankyou' => 'Visit Projects section and start working on this project.'
        ];

        $seller->notify(new ProposalAccept($proposalAccept));


        if ($query && $query2) {
            return redirect('projects')->with('success', 'You accepted the proposal and paid for the project. Wait for the seller to complete the project.');
        } else {
            return back()->with('fail', 'Something went wrong!!');
        }
    }

    function approveProject($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $project = PaidProject::find($id);
        $project->status = 'awaiting for feedback';
        $seller = Seller::where('seller_id', $project->seller_id)->first();
        $seller->increment('total_projects');
        $seller->amount_for_withdrawals = $seller->amount_for_withdrawals + $project->price;
        $project->update();
        $seller->update();
        $buyer = Buyer::where('buyer_id', $project->buyer_id)->first();
        $buyer->increment('total_projects');
        $buyer->update();

        return redirect('projects')->with('success', 'Project has been approved, give feedback and rate this project.');
    }

    public function cancel($id)
    {
        $project = PaidProject::find($id);
        $payment = ProjectPayment::where('paid_project_id', $project->id)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        Stripe\Refund::create([
            'charge' => $payment->payment_intent_id,
            // 'description' => $project->buyer_username.' cancelled the project with Project ID: '. $project->project_id . ' with '. $project->seller_username,
        ]);
        $payment->status = 'refund';
        $query1 = $payment->update();
        $query2 = $project->delete();
        if ($query1 && $query2) {
            return redirect('projects')->with('success', 'You have cancelled the project and your amount has been refunded to your bank account.');
        } else {
            return back()->with('fail', 'Something went wrong....Try Again !!');
        }
    }
}
