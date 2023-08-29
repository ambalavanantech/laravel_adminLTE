<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\AdminRule;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.layout.dashboard');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $rule = [
                'email'     => 'required|email|max:255',
                'password'  => 'required|max:30'
            ];
            $custom_message = [
                'email.required'    => 'Email is Required!',
                'email.email'       => 'Valid Email is Required!',
                'password.required' => 'Password is Required!'
            ];
            $this->validate($request,$rule,$custom_message);
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect("admin/dashboard");
            }else{
                return redirect()->back()->with("error_message","Invalid Email or Password");
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                if($data['new_pwd'] == $data['confirm_pwd']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with("error_success","Password has been updated successfully");
                }else{
                    return redirect()->back()->with("error_message","New password & Confirm Password not match");
                }
            }
            else{
                return redirect()->back()->with("error_message","Your current password is incorrect");
            }
        }
        return view('admin.layout.update_password');
    }

    public function updateDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rule = [
                'name'    => 'required',
                'mobile'  => 'required|numeric',
                //'image'   => 'required|image'
            ];
            $custom_message = [
                'name.required'      => 'Name is Required!',
                'mobile.required'    => 'Mobile is Required!',
                //'image.required'     => 'Image is Required!'
            ];
            $this->validate($request,$rule,$custom_message);

            if($request->hasFile('image')){ 
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $exe = $img_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999).'.'.$exe;
                    $imagePath = 'admin/images/photos/'.$imgName;
                    Image::make($img_tmp)->save($imagePath);

                } 
            }
            elseif(!empty($data['current_img'])){
                $imgName = $data['current_img'];
            }
            else{
                $imgName = "";
            }

            Admin::where('email',Auth::guard('admin')->user()->email)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'image' => $imgName,
            ]);

            return redirect()->back()->with("error_success","Admin details has been updated successfully");
        }
        return view('admin.layout.update_details');
    }

    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password))
        {
            return "true";
        }
        else
        {
            return "false";
        }
    }

    public function subadmins(){
        $subadmins = Admin::where('type','subadmin')->get();
        return view('admin.pages.subadmins')->with(compact('subadmins'));
    }

    public function update(Request $request, Admin $Admin)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active")
                $status = 0;
            else
                $status = 1;
             
            Admin::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }

    public function destroy($id)
    {
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('success_message',"Sub admin Deleted");
    }

    public function edit(Request $request, $id=null)
    {
        //dd($request->all());
        if($id==""){
            $title = "Add Sub Admin";
            $subadmin = new Admin;
            $message = "CMS Page added successfully";
        }
        else{
            $title = "Edit Sub Admin";
            $subadmin = Admin::find($id);
            $message = "CMS Page update successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $rule = [
                'name'    => 'required',
                'mobile'  => 'required|numeric',
                'email'   => 'required'
            ];
            $custom_message = [
                'name.required'      => 'Name is Required!',
                'mobile.required'    => 'Mobile is Required!',
                'email.required'     => 'Email is Required!'
            ];
            $this->validate($request,$rule,$custom_message);

            if($request->hasFile('image')){ 
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $exe = $img_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999).'.'.$exe;
                    $imagePath = 'admin/images/photos/'.$imgName;
                    Image::make($img_tmp)->save($imagePath);

                } 
            }
            elseif(!empty($data['current_img'])){
                $imgName = $data['current_img'];
            }
            else{
                $imgName = "";
            }

            if($id == null)
            {
                $count = Admin::where('email',$data['email'])->count();
                if($count != 0){
                    return redirect()->back()->with("error_message","Sub admin already exist!..."); 
                }
            }

                $subadmin->email        = $data['email'];
                $subadmin->password     = $data['password'] ? Hash::make($data['password']) : '123456' ;
                $subadmin->name         = $data['name'];
                $subadmin->mobile       = $data['mobile'];
                $subadmin->type         = 'subadmin';
                $subadmin->image        = $imgName;
                $subadmin->save();
           
            return redirect()->back()->with("error_success","Admin details has been updated successfully");
        }


        return view('admin.pages.add_edit_subadmin')->with(compact('title','subadmin'));
    }

    public function updateRole($id, Request $request){

        $title = "Update Subadmin Role/Permission";
        $cms_page_view = $cms_page_edit = $cms_page_full = 0;

        $roleData = AdminRule::where('admin_id',$id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            AdminRule::where('admin_id',$id)->delete();

            if(isset($data['cms_page']['view'])){
                $cms_page_view =  $data['cms_page']['view'];
            }
            if(isset($data['cms_page']['edit'])){
                $cms_page_edit =  $data['cms_page']['edit'];
            }
            if(isset($data['cms_page']['full'])){
                $cms_page_full =  $data['cms_page']['full'];
            }

            $role = new AdminRule();
            $role->admin_id     = $data['admin_id'];
            $role->module       = 'cms_page';
            $role->view_access  = $cms_page_view;
            $role->edit_access  = $cms_page_edit;
            $role->full_access  = $cms_page_full;
            $role->save();
            $message = "Subadmin Role updated";
            return redirect()->back()->with("error_success",$message);

        }
        return view('admin.pages.update_roles')->with(compact('title','id','roleData'));
    }
    
}
