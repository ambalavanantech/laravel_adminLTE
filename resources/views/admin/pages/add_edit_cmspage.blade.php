  
  @extends('admin.layout.layout');
  @section('cms_page','active');
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


              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error: </strong>{{Session::get('error_message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
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

              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" @if(empty($cmspage['id'])) action="{{url('admin/add-edit-cms-page')}}" @else action="{{url('admin/add-edit-cms-page/'.$cmspage['id'])}}" @endif>@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title*</label>
                    <input type="text" name="title" class="form-control" id="title" @if(!empty($cmspage['title'])) value="{{$cmspage['title']}}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description*</label>
                    <textarea name="description" class="form-control" id="description">@if(!empty($cmspage['description'])) {{$cmspage['description']}} @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">URL*</label>
                    <input type="text" name="url" class="form-control" id="url" placeholder="url" @if(!empty($cmspage['url'])) value="{{$cmspage['url']}}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="meta_title" @if(!empty($cmspage['meta_title'])) value="{{$cmspage['meta_title']}}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Meta Description</label>
                    <textarea name="meta_description" class="form-control" id="meta_description"> @if(!empty($cmspage['meta_description'])) {{$cmspage['meta_description']}} @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" placeholder="meta_keywords" @if(!empty($cmspage['meta_keywords'])) value="{{$cmspage['meta_keywords']}}" @endif>
                  </div>
  
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