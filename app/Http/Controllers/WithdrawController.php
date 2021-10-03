<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Trainer;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Stripe;
class WithdrawController extends Controller
{
    public function withdrawal_form()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $pageName = ' Withdraw Earnings';
        $title = 'Withdraw Earnings';

        if($user->user_role == 'Seller')
        {
            $withdrawal_user = Seller::where('user_id', $user->user_id)->first();

        }
        else if($user->user_role == 'Trainer')
        {
            $withdrawal_user = Trainer::where('user_id', $user->user_id)->first();

        }

        return view('payment.withdraw', $data, compact('withdrawal_user','title', 'pageName'));
    }

    public function withdraw_earnings(Request $request)
    {
        // return $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        // Stripe\Transfer::create([
        //     'amount' => $request->withdrawal_amount * 100,
        //     'currency' => 'usd',
        //     'destination' => $request->stripe_account,
        //     // 'transfer_group' => 'ORDER_95',
        // ]);
        $account = \Stripe\Account::create([
            'country' => 'US',
            'type' => 'custom',
            'capabilities' => [
              'card_payments' => [
                'requested' => true,
              ],
              'transfers' => [
                'requested' => true,
              ],
            ],
          ]);

          return $account;

        return redirect('sellerearnings')->with('success', 'Withdrawal Successfully Completed!!');
    }
}
