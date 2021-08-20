<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Categories;
use App\SubCategory;
use App\ChildCategory;
use App\Slider;
use App\CategorySlider;
use Illuminate\Support\Carbon;
use App\Course;
use App\Order;
use App\Wishlist;
use DB;
use App\BundleCourse;
use App\Testimonial;
use App\Trusted;
use App\FaqStudent;
use App\FaqInstructor;
use App\Blog;
use Validator;
use Hash;
use App\Cart;
use App\Setting;
use App\Page;
use App\Adsense;
use App\SliderFacts;
use App\ReviewRating;
use App\CourseChapter;
use App\CourseClass;


class MainController extends Controller
{

	public function home(Request $request){

		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $settings = Setting::findOrFail(1);
        $adsense = Adsense::first()->toArray();

	    return response()->json(array('settings'=>$settings, 'adsense' => $adsense ), 200); 
	}

    public function slider(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $slider = Slider::all()->toArray();
        return response()->json(array('slider'=>$slider), 200);
    }

    public function sliderfacts(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $sliderfacts = SliderFacts::all()->toArray();
        return response()->json(array('sliderfacts'=>$sliderfacts), 200);
    }

  	public function main(){
    	return response()->json(array('ok'), 200);
  	}

  	public function course(Request $request){

  		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

	    $course = Course::where('status', 1)->with('include')->with('whatlearns')->get();
	    return response()->json(array('course'=>$course), 200);       
	}

	public function featuredcourse(Request $request){

		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

	    $featured = Course::where('status', 1)->where('featured', 1)->with('include')->with('whatlearns')->get();
	    return response()->json(array('featured'=>$featured), 200);       
	}


	


	public function categories(Request $request)
	{

		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

		$cate = Categories::where('status', 1)->orderBy('position', 'asc')->get();

	    return response()->json(array('cate'=>$cate), 200); 
	}

    public function subcategories(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        
        $sub = SubCategory::where('status', 1)->get();
        return response()->json(array('sub'=>$sub), 200); 
    }

    public function childcategories(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        
        $child = ChildCategory::where('status', 1)->get();
        return response()->json(array('child'=>$child), 200); 
    }

	public function featuredcate(Request $request)
	{

		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

		$cate = Categories::where('status', 1)->where('featured', 1)->get();
	    return response()->json(array('cate'=>$cate), 200); 
	}

	public function bundle(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

		$bundle = BundleCourse::where('status', 1)->get();
	    return response()->json(array('bundle'=>$bundle), 200);
	}

	public function testimonial(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

		$testimonial = Testimonial::where('status', 1)->get();
	    return response()->json(array('testimonial'=>$testimonial), 200);
	}

	public function trusted(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }
        
		$trusted = Trusted::where('status', 1)->get();
	    return response()->json(array('trusted'=>$trusted), 200);
	}

    public function studentfaq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }
        
        $faq = FaqStudent::where('status', 1)->get();
        return response()->json(array('faq'=>$faq), 200);
    }

    public function instructorfaq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }
        
        $faq = FaqInstructor::where('status', 1)->get();
        return response()->json(array('faq'=>$faq), 200);
    }

    public function blog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }
        
        $blog = Blog::where('status', 1)->get();
        return response()->json(array('blog'=>$blog), 200);
    }

	
    public function showwishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        
        $user = Auth::user();
        
        $wishlist = Wishlist::where('user_id',$user->id)->with('courses')->get();
        
        return response()->json(array('wishlist' =>$wishlist), 200);

        

    }

    public function addtowishlist(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $orders = Order::where('user_id', $auth->id)->where('course_id', $request->course_id)->first();


        $wishlist = Wishlist::where('course_id', $request->course_id)->where('user_id', $auth->id)->first();

        if(isset($orders)){

            return response()->json('You Already purchased this course !', 401);
        }
        else{


            if(!empty($wishlist)){
                
                return response()->json('Course is already in wishlist !', 401);
            }
            else{

                $wishlist = Wishlist::create([

                    'course_id' => $request->course_id,
                    'user_id'   => $auth->id,
                ]);

                return response()->json('Course is added to your wishlist !', 200);
            }
            
        }
        
        
    }

    public function removewishlist(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $wishlist = Wishlist::where('course_id', $request->course_id)->where('user_id', $auth->id)->delete();
        
        if($wishlist == 1){
          return response()->json(array('1'), 200); 
        }
        else{
          return response()->json(array('error'), 401);       
        }
    }

    

    public function userprofile(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user(); 
        return response()->json(array('user' =>$user), 200); 
    } 

    

    public function updateprofile(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $request->validate([
          'email' => 'required',
          'current_password' => 'required',
        ]);
        $input = $request->all();

        if (Hash::check($request->current_password, $auth->password)){
          if ($file = $request->file('user_img')) {
            if ($auth->user_img != null) {      
              $image_file = @file_get_contents(public_path().'/images/user_img/'.$auth->user_img);
              if($image_file){            
                unlink(public_path().'/images/user_img/'.$auth->user_img);
              }
            }
            $name = time().$file->getClientOriginalName();
            $file->move('images/user_img', $name);
            $input['user_img'] = $name;
          }
          $auth->update([        
            'fname' => isset($input['fname']) ? $input['fname'] : $auth->fname,
            'lname' => isset($input['lname']) ? $input['lname'] : $auth->lname,
            'email' => $input['email'],
            'password' => isset($input['password']) ? bcrypt($input['password']) : $auth->password,
            'mobile' => isset($input['mobile']) ? $input['mobile'] : $auth->mobile,
            'dob' => isset($input['dob']) ? $input['dob'] : $auth->dob,
            'user_img' =>  isset($input['user_img']) ? $input['user_img'] : $auth->user_img,
            'address' =>  isset($input['address']) ? $input['address'] : $auth->address,
          ]);
          $auth->save();
          return response()->json(array('auth' =>$auth), 200);
        } 
        else {
          return response()->json('error: password doesnt match', 400);
        }

        
    } 

    public function mycourses(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();

        $enroll = Order::where('user_id', $user->id)->where('status', 1)->with('courses')->get();

        return response()->json(array('course' =>$enroll), 200); 
    } 


    public function addtocart(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $auth = Auth::user();

        $courses = Course::where('id', $request->course_id)->first();

        $orders = Order::where('user_id', $auth->id)->where('course_id', $request->course_id)->first();
        $cart = Cart::where('course_id', $request->course_id)->where('user_id', $auth->id)->first();

        if(isset($courses))
        {
            if($courses->type == 1)
            {
                if(isset($orders))
                {
                    return response()->json('You Already purchased this course !', 401);
                }
                else{

                    if(!empty($cart))
                    {
                        return response()->json('Course is already in cart !', 401);
                    }
                    else
                    {
                        $cart = Cart::create([

                            'course_id' => $request->course_id,
                            'user_id'   => $auth->id,
                            'category_id' => $courses->category_id,
                            'price' => $courses->price,
                            'offer_price' => $courses->discount_price
                        ]);

                        return response()->json('Course is added to your cart !', 200);
                    }
                }
            }
            else{
                return response()->json('Course is free', 401);
            }
        }
        else{
            return response()->json('Invalid Course ID', 401);
        }
        
        
    }


    public function removecart(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $cart = Cart::where('course_id', $request->course_id)->where('user_id', $auth->id)->delete();
        
        if($cart == 1){
          return response()->json(array('1'), 200); 
        }
        else{
          return response()->json(array('error'), 401);       
        }
    }


    public function showcart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        
        $user = Auth::user();
        
        $cart = Cart::where('user_id',$user->id)->with('courses')->get();
        
        return response()->json(array('cart' =>$cart), 200);

        

    }

    public function removeallcart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $cart = Cart::where('user_id', $auth->id)->delete();
        
        if(isset($cart)){
          return response()->json(array('1'), 200); 
        }
        else{
          return response()->json(array('error'), 401);       
        }
    }


    public function addbundletocart(Request $request)
    {

        $this->validate($request, [
            'bundle_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $bundle_course = BundleCourse::where('id', $request->bundle_id)->first();

        $orders = Order::where('user_id', $auth->id)->where('bundle_id', $request->bundle_id)->first();


        $cart = Cart::where('bundle_id', $request->bundle_id)->where('user_id', $auth->id)->first();

        if(isset($bundle_course))
        {
            if($bundle_course->type == 1)
            {
                if(isset($orders)){

                    return response()->json('You Already purchased this course !', 401);
                }
                else{


                    if(!empty($cart)){
                        
                        return response()->json('Bundle Course is already in cart !', 401);
                    }
                    else{

                        $cart = Cart::create([

                            'bundle_id' => $request->bundle_id,
                            'user_id'   => $auth->id,
                            'type' => '1',
                            'price' => $bundle_course->price,
                            'offer_price' => $bundle_course->discount_price,
                            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        return response()->json('Bundle Course is added to your cart !', 200);
                    }
                    
                }
            }
            else{
                return response()->json('Bundle course is free !', 401);
            }
            
        }
        else
        {
            return response()->json('Invalid Bundle Course ID !', 401);
        }

        
        
        
    }

    public function removebundlecart(Request $request)
    {
        $this->validate($request, [
            'bundle_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $auth = Auth::user();

        $cart = Cart::where('bundle_id', $request->bundle_id)->where('user_id', $auth->id)->delete();
        
        if($cart == 1){
          return response()->json(array('1'), 200); 
        }
        else{
          return response()->json(array('error'), 401);       
        }
    }

    public function detailpage(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $course = Course::where('id', $id)->with('include')->with('whatlearns')->with('related')->with('review')->with('review')->with('language')->with('user')->with('order')->with('chapter')->with('courseclass')->get();
        return response()->json(array('course'=>$course), 200);
    }


    public function pages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $pages = Page::get();

        return response()->json(array('pages'=>$pages), 200);
    }


    
    


    public function allnotification(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();
        $notifications = $user->unreadnotifications;

        if($notifications){
            return response()->json(array('notifications' => $notifications), 200);
        }else {
            return response()->json(array('error'), 401);
        }
    }


    public function notificationread(Request $request, $id)
    {  

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $userunreadnotification=Auth::user()->unreadNotifications->where('id',$id)->first();
         
        if ($userunreadnotification) {
           $userunreadnotification->markAsRead();
            return response()->json(array('1'), 200);
        }
        else{
            return response()->json(array('error'), 401);            
        }
    }


    public function readallnotification(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $notifications = Auth()->User()->notifications()->delete();

         
        if($notifications) {
          
            return response()->json(array('1'), 200);
        }
        else{
            return response()->json(array('error'), 401);            
        }
    }


    public function instructorprofile(Request $request)
    {
        $this->validate($request, [
            'instructor_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = User::where('id', $request->instructor_id)->first();
        $course_count = Course::where('user_id', $user->id)->count();
        $enrolled_user = Order::where('instructor_id', $user->id)->count();
        $course = Course::where('user_id', $user->id)->get();
         
        if($user) {
          
            return response()->json(array('user'=>$user, 'course'=>$course, 'course_count'=>$course_count, 'enrolled_user'=>$enrolled_user ), 200);
        }
        else{
            return response()->json(array('error'), 401);            
        }
    }


    public function review(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $review = ReviewRating::where('course_id', $request->course_id)->with('user')->get();

        $review_count = ReviewRating::where('course_id', $request->course_id)->count();
         
        if($review) {
          
            return response()->json(array('review'=>$review ), 200);
        }
        else{
            return response()->json(array('error'), 401);            
        }
    }


    public function duration(Request $request)
    {
        $this->validate($request, [
            'chapter_id' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $chapter = CourseChapter::where('course_id', $request->chapter_id)->first();

        if($chapter) {
        
            $duration =  CourseClass::where('coursechapter_id', $chapter->id)->sum("duration");
        }
        else{
            return response()->json(['Invalid Chapter ID !'], 401);
        }
         
        if($chapter) {
          
            return response()->json(array( 'duration'=>$duration ), 200);
        }
        else{
            return response()->json(array('error'), 401);            
        }
    }




    





}