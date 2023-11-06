@extends('layouts.master')
@section('title','Admin|Profile')
@section('content')
<div >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/AdminLTELogo.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{Auth::guard('admin')->user()->name}}</h3>

               

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Mã thẻ</b> <a class="float-right">{{Auth::guard('admin')->user()->Ma_the}}</a>
                  </li>
                </ul>

                <a href="{{ route('checklogout') }}" style="text-align: center"  onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
                  <form action="{{ route('checklogout') }}"  id="logout-form" method="post">@csrf</form>
                  <button class="btn btn-outline-primary">Đăng xuất</button>
                </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Deatail</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" >Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" readonly value="{{Auth::guard('admin')->user()->name}}" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" readonly value="{{Auth::guard('admin')->user()->email}}" placeholder="Email">
                        </div>
                      </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          {{-- <button type="submit" class="btn btn-danger">Submit</button> --}}
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection