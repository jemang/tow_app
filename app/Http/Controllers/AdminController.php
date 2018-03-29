<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use App\workshop;
use App\police;

class AdminController extends Controller
{	
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('admin');
    }

    public function viewtow() 
    {
    	$shop = workshop::get();
        return view('auth/workshop', ['shop' => $shop]);
    }

    public function viewPolice() 
    {
        $shop = police::get();
        return view('auth/p_station', ['shop' => $shop]);
    }

    public function profile($id = null) 
    {
    	if($id!=null)
        {
    		$shop = DB::table('workshop')->where('tow_id','=',$id)->first();
        	return view('auth/profile', ['shop' => $shop]);
        }
         else
         {
         	return redirect('/admin_view');
         }
    }


    public function AdminProfile($id = null) 
    {
    	if($id!=null)
        {
    		$shop = DB::table('users')->where('id','=',$id)->first();
        	return view('/auth/profileAD', ['shop' => $shop]);
        }
         else
         {
         	return redirect('/admin_view');
         }
    }


    public function EditProfile($id) 
    {
        if($id != null) 
        {
			$shop = DB::table('workshop')->where('tow_id', '=' ,$id)->first();
			if($shop)
    		{
    			return view('auth/edit_profile', ['shop' => $shop]);
    		}
    		else
    		{
    			return redirect('/work_shop')->withErrors(['msg'=>'User Not Found!!']);
    		}	
		} 
		else 
		{
			return redirect('/admin_view');
		}
    }


    public function add() 
    {
        return view('auth/add_police');
    }


    public function newStation(Request $request) 
    {

        $validation = Validator::make($request->all(), 
        array(
            's_name'      => 'required|max:50',
            's_phone'      => 'required|numeric|min:8',
            's_add'     => 'required|max:100',
            )
        ); //close validation

        //If validation fail send back the Input with errors
        if($validation->fails()) 
        {
            return redirect('/add/police')->withInput()->withErrors($validation->messages());
        } 
        else 
        {

            //$id = $request->input('id');
            $s_name = $request->input('s_name');
            $phone = $request->input('s_phone');
            $addr =  $request->input('s_add');
            
            $police = new police;
            $police-> station_name = $s_name;
            $police-> phone_no = $phone;
            $police-> address = $addr;
            $police-> save();

            return redirect('/police')->withErrors(['msg'=>'success add new data']);
        }

    }


    public function upStation(Request $request) 
    {

        $validation = Validator::make($request->all(), 
        array(
            's_name'      => 'required|max:50',
            's_phone'      => 'required|numeric|min:8',
            's_add'     => 'required|max:100',
            )
        ); //close validation

        //If validation fail send back the Input with errors
        if($validation->fails()) 
        {
            return redirect('/edit/police'. $request->input('id'))->withInput()->withErrors($validation->messages());
        } 
        else 
        {

            $id = $request->input('id');
            $s_name = $request->input('s_name');
            $phone = $request->input('s_phone');
            $addr =  $request->input('s_add');

            police::where('station_id', $id)->update(array(
            'station_name' => $s_name,
            'phone_no' => $phone,
            'address' => $addr,
            ));

            return redirect('/police')->withErrors(['msg'=>'success update data']);
        }

    }


    public function EditAdmin($id) 
    {
        if($id != null) 
        {
			$shop = DB::table('users')->where('id', '=' ,$id)->first();
			if($shop)
    		{
    			return view('auth/edit_admin', ['shop' => $shop]);
    		}
    		else
    		{
    			return redirect('/work_shop')->withErrors(['msg'=>'User Not Found!!']);
    		}	
		} 
		else 
		{
			return redirect('/admin_view');
		}
    }

    public function EditPolice($id) 
    {
        if($id != null) 
        {
            $shop = DB::table('police_station')->where('station_id', '=' ,$id)->first();
            if($shop)
            {
                return view('auth/edit_police', ['shop' => $shop]);
            }
            else
            {
                return redirect('/police')->withErrors(['msg'=>'User Not Found!!']);
            }   
        } 
        else 
        {
            return redirect('/admin_view');
        }
    }

    public function SearchProfile(Request $request) 
    {
    	 $name=$request->input('username');
    	 if($request->input('username')!=null)
    	 {
    		$shop = DB::table('workshop')->where('own_name','=',$name)->first();
    		if($shop)
    		{
    			return view('auth/profile', ['shop' => $shop]);
    		}
    		else
    		{
    			return redirect('/work_shop')->withErrors(['msg'=>'User Not Found!!']);
    		}	
         }
         else
         {
         	return redirect('/work_shop')->withErrors(['msg'=>'enter username first']);
         }

    }

    public function delProfile($id) 
    {
		if($id != null) 
        {
			DB::table('workshop')
				->where('tow_id', '=' ,$id)
				->delete();
			return redirect('/work_shop')->withErrors(['msg'=>'User deleted']);
		} 
        else 
        {
			return redirect('/admin_view');
		}
	}

    public function delPolice($id) 
    {
        if($id != null) 
        {
            DB::table('police_station')
                ->where('station_id', '=' ,$id)
                ->delete();
            return redirect('/police')->withErrors(['msg'=>'Police Station Deleted']);
        } 
        else 
        {
            return redirect('/admin_view');
        }
    }

	public function updateProfile(Request $request) 
    {
        $validation = Validator::make($request->all(), 
        array(
            'ownname'      => 'required|max:20',
            'workname'      => 'required|max:30',
            'phoneNo'     => 'required|numeric|min:8',
            'email'     => 'required|email',
            'password'     => 'required|min:4',
            'add'   => 'required|max:30',
            'info'   => 'required|max:100'
            )
        ); //close validation

        //If validation fail send back the Input with errors
        if($validation->fails()) 
        {
            return redirect('/admin/edit/' . $request->input('id'))->withInput()->withErrors($validation->messages());
        } 
        else 
        {
            $id = $request->input('id');
            $oname = $request->input('ownname');
            $wname = $request->input('workname');
            $phone = $request->input('phoneNo');
            $email = $request->input('email');
            $password =$request->input('password');
            $addr =  $request->input('add');
            $info = $request->input('info');


            workshop::where('tow_id', $id)->update(array(
            'own_name' => $oname,
            'work_name' => $wname,
            'phone_no' => $phone,
            'email' => $email,
            'pwd' => $password,
            'address' => $addr,
            'info' => $info
            ));

            return redirect('/work_shop')->withErrors(['msg'=>'Your profile updated']);
        }
    }//close update


    public function updateAdmin(Request $request) 
    {
        $validation = Validator::make($request->all(), 
        array(
            'name'      => 'required|max:20',
            'email'     => 'required|email',
            'password'     => 'required|min:4',
            )
        ); //close validation

    //If validation fail send back the Input with errors
        if($validation->fails()) 
        {
            return redirect('/edit/admin/' . $request->input('id'))->withInput()->withErrors($validation->messages());
        } 
        else 
        {
            $id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $password =$request->input('password');

            DB::table('users')->where('id', $id)->update(array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            ));

            return redirect('/admin/profile/'. $request->input('id'))->withErrors(['msg'=>'Your profile updated']);
        }
    }//close update
}
