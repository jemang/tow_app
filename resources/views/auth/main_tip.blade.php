@extends('auth.master_admin')

@section('header')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')    

              <div class="right_col" role="main">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Tips</h2>
                    <center>
                    @if (count($errors) > 0)
                      @foreach ($errors->all() as $error)
                        <font color="green">{{ $error }}<br /></font>
                      @endforeach
                    @endif
                    </center>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="/scrap">Site 1</a>
                          </li>
                          <li><a href="/scrap2">Site 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="/admin_view" class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {!! csrf_field() !!}
                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">List of Tips Category</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Category</th>
                                  <th>Quantity</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <?php $total = 0; ?>
                              @foreach ($shop as $work)
                              <tbody>
                                <tr>
                                  <th scope="row">{{$total = $total + 1}}</th>
                                  <td>{{$work->category}}</td>
                                  <td>{{$work->count}}</td>
                                  <td><a href="/tip/{{$work->category}}" class="label label-success"></i>Open</a></td>
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