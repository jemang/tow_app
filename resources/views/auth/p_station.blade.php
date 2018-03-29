@extends('auth.master_admin')

@section('header')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    
	    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage <small>Police</small></h3>
              </div>

              @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                	<font color="green">{{ $error }}<br /></font>
                @endforeach
              @endif

              {!! csrf_field() !!}
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Police Station</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a href="/admin_view" class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Station ID </th>
                            <th class="column-title">Station Name </th>
                            <th class="column-title">Phone Number </th>
                            <th class="column-title">Address </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($shop as $work)
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">{{$work->station_id}}</td>
                            <td class=" ">{{$work->station_name}}</td>
                            <td class=" ">{{$work->phone_no}}</td>
                            <td class=" ">{{$work->address}}</td>
                            <td class=" last"><a href="/edit/Police/{{$work->station_id}}" class="btn btn-round btn-warning"></i>Edit</a>
                            				  <a href="/police/delete/{{$work->station_id}}" onClick="return confirm('Are you sure to delete this police station?');" class="btn btn-round btn-danger"></i>Delete</a></td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection
