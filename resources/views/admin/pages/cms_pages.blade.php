  
  @extends('admin.layout.layout');
  @section('cms_page','active')
  @section('content');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">CMS Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CMS Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

            @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success: </strong>{{Session::get('success_message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>
              @endif


              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error: </strong>{{Session::get('error_message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>
              @endif


              <div class="card-header">
                <h3 class="card-title">CMS Pages</h3>
                <a style="max-width:150px; float:right; display:inline-block" class="btn btn-block btn-primary" href="{{url('admin/add-edit-cms-page')}}">Add CMS Page</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="cms_page" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Created On</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($CmsPages as $page)
                    <tr>
                        <td>{{$page['id']}}</td>
                        <td>{{$page['title']}}</td>
                        <td>{{$page['description']}}</td>
                        <td>{{$page['url']}}</td>
                        <td>{{date('Y-m-d', strtotime($page['created_at']))}}</td>
                        <td>
                          @if($pageModule['edit_access'] == 1 || $pageModule['full_access'] == 1)
                          @if($page['status'] == 1)
                          <a class="updateCmsPageStatus" id="page-{{$page['id']}}" page_id="{{$page['id']}}" href="javascript:void(0);"><i class="fas fa-toggle-on" status="Active"></i></a>
                          @else
                          <a class="updateCmsPageStatus" id="page-{{$page['id']}}" page_id="{{$page['id']}}" href="javascript:void(0);" style="color: grey;"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                          @endif
                          @endif
                          @if($pageModule['edit_access'] == 1 || $pageModule['full_access'] == 1)
                          &nbsp;&nbsp;
                          <a class="" href="{{url('admin/add-edit-cms-page/'.$page['id'])}}"><i class="fas fa-edit"></i></a>
                          &nbsp;&nbsp;
                          @endif
                          @if($pageModule['full_access'] == 1)
                          <!-- <a class=" confirmDelete" name="CMS_Page" title="Delete" href="{{url('admin/delete-cms-page/'.$page['id'])}}"><i class="fas fa-trash"></i></a> -->
                          <a class="confirmDelete" name="CMS_Page" title="Delete" href="javascript:void(0)" record="cms-page" recordid="{{$page['id']}}"><i class="fas fa-trash"></i></a>
                          @endif
                        </td>
                    </tr>
                    @endforeach
                  
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

  </div>
  <!-- /.content-wrapper -->
  @endsection