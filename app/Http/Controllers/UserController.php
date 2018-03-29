<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;

class UserController extends Controller
{	
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
    public function viewProfile($id = null) {
        if($id!=null){
			return view('auth/profile',['data'=>['act'=>'admin','name'=>Auth::user()->name,'email'=>Auth::user()->email]]);
		}
		else {
			return view('auth/profile',['data'=>['act'=>'view','name'=>Auth::user()->name,'email'=>Auth::user()->email]]);
		}
    }
	
	public function editProfile($id = null) {
		if($id!=null){
			$users = DB::table('users')->where('id','=',$id)->get();
			return view('auth/profile',['data'=>['act'=>'admin','id'=>$users[0]->id,'name'=>$users[0]->name,'email'=>$users[0]->email]]);
		}
		else {
			return view('auth/profile',['data'=>['act'=>'update','name'=>Auth::user()->name,'email'=>Auth::user()->email]]);
		}
	}
	
	public function updateProfile(Request $request,$id=null) {
		$data = $request->all();
		$this->validate($request, [
					'name' => 'required|max:255',
				]);
		if($id!=null){
			$users = DB::table('users')->where('id','=',$id)->get();
				if($data['email'] != $users[0]->email){
					$this->validate($request, [
						'email' => 'required|email|max:255|unique:users',
					]);
				}
				$this->getUserData($id,$data);
				
			return redirect('/manage/user')->withErrors(['msg'=>'User profile updated']);
		}
		else {
				if($data['email'] != Auth::user()->email){
					$this->validate($request, [
						'email' => 'required|email|max:255|unique:users',
					]);
				}
				$this->getUserData(Auth::user()->id,$data);
				
				return redirect('/profile')->withErrors(['msg'=>'Your profile updated']);
			}
	}
	
	public function getUserData($id,$data) {
		DB::table('users')
			->where('id', $id)
			->update(['name' => $data['name'],
			'email' => $data['email']]);
			
	}
	
	public function delProfile($id) {
		if($id != null) {
			DB::table('users')
				->where('id', '=' ,$id)
				->delete();
			return redirect('/manage/user')->withErrors(['msg'=>'User deleted']);
		} else {
			return redirect('/');
		}
	}
}
