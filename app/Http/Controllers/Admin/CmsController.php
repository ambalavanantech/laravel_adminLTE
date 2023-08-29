<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRule;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Auth;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $CmsPages = CmsPage::get()->toArray();
        $AdminRule = AdminRule::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_page'])->count();
        if(Auth::guard('admin')->user()->type == 'admin'){
            $pageModule['view_access'] = 1;
            $pageModule['edit_access'] = 1;
            $pageModule['full_access'] = 1;
        }
        elseif($AdminRule == 0){
            return redirect()->back()->with("error_message","This feature is restricted for you!..."); 
        }
        else{
            $pageModule = AdminRule::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_page'])->first()->toArray();
        }
        // dd($pageModule);
        return view('admin.pages.cms_pages')->with(compact('CmsPages','pageModule'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        //dd($request->all());
        if($id==""){
            $title = "Add CMS Page";
            $cmspage = new CmsPage;
            $message = "CMS Page added successfully";
        }
        else{
            $title = "Edit CMS Page";
            $cmspage = CmsPage::find($id);
            $message = "CMS Page update successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $rule = [
                'title'         => 'required',
                'description'   => 'required',
                'url'           => 'required'
            ];
            $custom_message = [
                'title.required'        => 'Title is Required!',
                'description.required'  => 'Description is Required!',
                'url.required'          => 'URL is Required!'
            ];
            $this->validate($request,$rule,$custom_message);

            $cmspage->title             = $data['title'];
            $cmspage->description       = $data['description'];
            $cmspage->url               = $data['url'];
            $cmspage->meta_title        = $data['meta_title'];
            $cmspage->meta_description  = $data['meta_description'];
            $cmspage->meta_keywords     = $data['meta_keywords'];
            $cmspage->status            = 1;
            $cmspage->save();
            return redirect('admin/cms-page')->with('success_message',$message);

        }

        return view('admin.pages.add_edit_cmspage')->with(compact('title','cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active")
                $status = 0;
            else
                $status = 1;
             
            CmsPage::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success_message',"CMS Page Deleted");
    }
}
