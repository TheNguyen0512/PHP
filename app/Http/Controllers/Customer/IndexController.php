<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    // protected $slider;
    // protected $category;
    // protected $product;
    // protected $settings;
    protected $user;
    public function __construct(User $user,)
    {
        $this->user = $user;
    }
    public function index(){
        // $count = 0;
        // $slider = $this->slider::all();
        // $category = $this->category::all();
        // $product = $this->product::latest()->get();
        // $settings = $this->settings::all();
        // ,compact('slider', 'count', 'category', 'product', 'settings')
        Auth::user();
        Log::info('User is logged in: '.Auth::user());
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            Log::info('User is logged in.');
        } else {
            // Người dùng chưa đăng nhập
            Log::info('User is not logged in.');
        }
        return view('Customer.index');
    }


    // public function about_us(){
    //     $category = $this->category::all();
    //     $settings = $this->settings::all();
    //     return view('Home.aboutus', compact('category','settings'));
    // }
}