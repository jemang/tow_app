    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage <small>workshop</small></h3>
              </div>

              @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <font color="green">{{ $error }}<br /></font>
                @endforeach
                @endif


              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form action="/search" method="post">
                {!! csrf_field() !!}
                  <div class="input-group">
                    <input type="text" class="form-control" name="username" placeholder="Search for Username">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                  </div>
                </form>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Registered Workshop</h2>
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
                            <th class="column-title">Workshop ID </th>
                            <th class="column-title">Owner Name </th>
                            <th class="column-title">Workshop Name </th>
                            <th class="column-title">Phone Number </th>
                            <th class="column-title">Email </th>
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
                            <td class=" ">{{$work->tow_id}}</td>
                            <td class=" ">{{$work->own_name}}</td>
                            <td class=" ">{{$work->work_name}}</td>
                            <td class=" ">{{$work->phone_no}}</td>
                            <td class=" ">{{$work->email}}</td>
                            <td class=" last"><a href="/profile/{{$work->tow_id}}" class="btn btn-round btn-warning"></i>View</a></td>
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