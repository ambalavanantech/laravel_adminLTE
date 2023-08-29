  
  @extends('admin.layout.layout');
  @section('content');
  @section('setting','menu-open');
  @section('setting','active');
  @section('subadmins','active');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sub Admin</li>
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


              <div class="card-header">
                <h3 class="card-title">Sub Admins</h3>
                <a style="max-width:150px; float:right; display:inline-block" class="btn btn-block btn-primary" href="{{url('admin/add-edit-subadmins')}}">Add Sub Admin</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="cms_page" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Created On</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($subadmins as $page)
                    <tr>
                        <td>{{$page['id']}}</td>
                        <td>{{$page['name']}}</td>
                        <td>{{$page['mobile']}}</td>
                        <td>{{$page['email']}}</td>
                        <td>{{date('Y-m-d', strtotime($page['created_at']))}}</td>
                        <td>
                          @if($page['status'] == 1)
                          <a class="updateSubadminStatus" id="page-{{$page['id']}}" page_id="{{$page['id']}}" href="javascript:void(0);"><i class="fas fa-toggle-on" status="Active"></i></a>
                          @else
                          <a class="updateSubadminStatus" id="page-{{$page['id']}}" page_id="{{$page['id']}}" href="javascript:void(0);" style="color: grey;"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                          @endif
                          &nbsp;&nbsp;
                          <a class="" href="{{url('admin/add-edit-subadmins/'.$page['id'])}}"><i class="fas fa-edit"></i></a>
                          &nbsp;&nbsp;
                          <!-- <a class=" confirmDelete" name="CMS_Page" title="Delete" href="{{url('admin/delete-cms-page/'.$page['id'])}}"><i class="fas fa-trash"></i></a> -->
                          <a class="SubadminconfirmDelete" name="subadmin" title="Delete" href="javascript:void(0)" record="subadmin" recordid="{{$page['id']}}"><i class="fas fa-trash"></i></a>
                          &nbsp;&nbsp;
                          <a class="" name="subadmin"  href="{{url('admin/update-role/'.$page['id'])}}" record="subadmin" recordid="{{$page['id']}}"><i class="fas fa-unlock"></i></a>
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