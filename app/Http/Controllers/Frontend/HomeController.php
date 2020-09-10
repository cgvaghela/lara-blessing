<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page as Page;
use App\Slider as Slider;
use App\Enquiry as Enquiry;
use App\Team;
use App\Service;
use App\Portfolio;
use App\Category;

use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\EnquiryMail;

class HomeController extends Controller {
    
    public function __construct() {
        $this->pageLimit = config('settings.pageLimit');
    }

    public function getIndex() {
        // Get all the slider images
        $sliders = Slider::where('status', '1')->get();
        $page = Page::slug('home')->where('status', '1')->first(array('title', 'content'));
        if($page){
            return view('frontend.index', compact('sliders','page'));
        }else{
            return response()->view('errors.404', array(), 404);
        }
    }
    
    public function getTeam() {
        $team = Team::active()->get();
        return view('frontend.team', compact('team'));
    }
    
    public function getServices() {
        $services = Service::active()->get();
        return view('frontend.services', compact('services'));
    }

    public function getPortfolio() {
        $portfolioCategory = Category::active()->get();
        $portfolio = Portfolio::whereIn('category_id',$portfolioCategory->pluck('id')->toArray())->active()->paginate(4);
        $portfolioAll = Portfolio::whereIn('category_id',$portfolioCategory->pluck('id')->toArray())->active()->get();
        return view('frontend.portfolio', compact('portfolioAll','portfolio','portfolioCategory'));
    }
    
    public function getPages($slug) {
        $page = Page::slug($slug)->active()->first(array('title', 'content'));
        if($page){
            return view('frontend.page', compact('page'));
        }else{
            return response()->view('errors.404', array(), 404);
        }
    }
    
    public function getContact() {
        return view('frontend.contact');
    }

    public function submitEnquiry(Request $request) {
        $data = $request->all();
        
        $rules = array(
            'fullname' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        );
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }
        
        $enquiry = new Enquiry;
        $enquiry->fullname = $data['fullname'];
        $enquiry->email = $data['email'];
        $enquiry->subject = $data['subject'];
        $enquiry->message = $data['message'];
        $enquiry->save();

        //send enquiry mail to admin
        Mail::to(config('settings.admin.email'))->send(new EnquiryMail($enquiry));
        
        $array = array();
        $array['success'] = true;
        $array['message'] = 'Your message has been submitted successfully!';
        return response()->json($array);
    }
}
