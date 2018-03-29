@extends('auth.master_admin')

@section('header')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a href="/work_shop"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="/images/picture.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{$shop->own_name}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i>   {{$shop->address}}</li>
                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{$shop->work_name}}
                        </li>
                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{$shop->phone_no}}
                        </li>
                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a target="_blank"> {{$shop->email}}</a>
                        </li>
                      </ul>

                      <a href="/admin/edit/{{$shop->tow_id}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <a href="/profile/delete/{{$shop->tow_id}}" onClick="return confirm('Are you sure to delete this user?');" class="btn btn-danger"><i class="fa fa-edit m-right-xs"></i>
                      Delete</a>
                      <br />
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h5>Workshop Information</h5>
                        </div>
                      </div>
                      <!-- start of user-activity-graph -->
                      <div>
                      		</br>
                      		<p>{{$shop->info}}</p>
                      </div>
                      <!-- end of user-activity-graph -->

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script>
		$('.con').on('click',function()
			{
				return confirm('Are you sure to delete this user?')
			});
		</script>
        <!-- /page content -->

        <!-- footer content -->
        <!-- /footer content -->
@endsection


        