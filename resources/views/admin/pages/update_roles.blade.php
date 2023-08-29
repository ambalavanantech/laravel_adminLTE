  
  @extends('admin.layout.layout');
  @section('setting','menu-open');
  @section('setting','active');
  @section('subadmins','active');
  @section('content');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{$title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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

              @if(Session::has('error_success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success: </strong>{{Session::get('error_success')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>
              @endif

              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{url('admin/update-role/'.$id)}}">@csrf
                <div class="card-body">
              <input type="hidden" name="admin_id" value="{{$id}}"> 
              <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Page</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Full</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>CMS Page</td>
                  <td><input type="checkbox" class="form-control" name="cms_page[view]" value="1" @if(isset($roleData['view_access']) && $roleData['view_access'] == '1') checked @endif></td>
                  <td><input type="checkbox" class="form-control" name="cms_page[edit]" value="1" @if(isset($roleData['edit_access']) && $roleData['edit_access'] == '1') checked @endif></td>
                  <td><input type="checkbox" class="form-control" name="cms_page[full]" value="1" @if(isset($roleData['full_access']) && $roleData['full_access'] == '1') checked @endif ></td>
                </tr>
                </tbody>
              </table>


               
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection