<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CoursePayment;
use App\Models\PaidCourse;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Stripe;

class CoursePaymentController extends Controller
{
    public function payment_page($course_id)
    {
        if (session()->has('LoggedUser')) {
            $trainer = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $trainer,
                'roles' =>  UserRole::all()
            ];
        }

        $title =  'Course Payment';
        $pageName = 'Course Payment';

        $course = Course::find($course_id);
        return view('payment.coursepayment', $data, compact('title', 'pageName', 'course'));
    }

    public function course_payment(Request $request, $course_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $course = Course::find($course_id);
        $trainer = Trainer::where('trainer_id', $course->trainer_id)->first();
        $student = Student::where('user_id', $user->user_id)->first();

        $paid_course = new PaidCourse;
        $paid_course->course_id = $course->course_id;
        $paid_course->course_title = $course->course_title;
        $paid_course->course_description = $course->course_description;
        $category = Category::where('category_id', $course->category_id)->first();
        $paid_course->course_category = $category->category_name;
        $paid_course->category_id = $course->category_id;
        $paid_course->trainer_id = $course->trainer_id;
        $paid_course->trainer_username = $course->trainer;
        $paid_course->student_id = $student->student_id;
        $paid_course->student_username = $student->student_username;
        $paid_course->duration = $course->course_duration;
        $paid_course->price = $course->course_price;

        $query1 = $paid_course->save();

        $trainer->amount_for_withdrawals = $trainer->amount_for_withdrawals + $course->course_price;

        $trainer->update();
        $student->increment('courses_enrolled');
        $student->update();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $charge = Stripe\Charge::create([
            'amount' => $course->course_price * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            // 'customer' => 'Test',
            'description' => $student->student_username.' Paid for the Course with Course ID: '. $course->course_id .' to '.$trainer->trainer_username,
        ]);


        // Stripe\Transfer::create([
        //     'amount' => $course->course_price * 100,
        //     'currency' => 'usd',
        //     'source_transaction' => $charge->id,
        //     'destination' => 'acct_1JgEOpPtgu3XlORTs',
        //     // 'transfer_group' => 'ORDER_95',
        // ]);

        $course_payment = new CoursePayment;
        $course_payment->card_holder = $request->card_holder;
        $course_payment->course_id = $course->course_id;
        $course_payment->paid_course_id = $paid_course->id;
        $course_payment->payment_intent_id = $charge->id;
        $course_payment->card_number = $request->card_number;
        $course_payment->cvc = Hash::make($request->cvc);
        $course_payment->exp_month = $request->month;
        $course_payment->exp_year = $request->year;
        $course_payment->status = 'paid';

        // return $course_payment;
        $query2 = $course_payment->save();

        if($query1 && $query2){
            return redirect('student-courses')->with('success', 'Congratulations!! You have purchased the course.');
        }
        else{
            return back()->with('fail', 'Something went wrong!!.');

        }
    }
}
