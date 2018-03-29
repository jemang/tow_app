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
                <h3>News & Tips</h3>
              </div>
            </div>
          
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <font color="green">{{ $error }}<br /></font>
                @endforeach
                @endif

              {!! csrf_field() !!}
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail of Information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a href="/mtip" class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 35%">Title</th>
                          <th>Author</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Source</th>
                          <th style="width: 15%">#Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($shop as $work)
                        <tr>
                          <td>#</td>
                          <td>
                            <a>{{$work->title}}</a>
                          </td>
                          <td>
                            {{$work->author}}
                          </td>
                           <td>
                            {{$work->category}}
                          </td>
                          <td class="project_progress">
                            {{$work->date}}
                          </td>
                          <td>
                            {{$work->source}}
                          </td>
                          <td>
                            <a href="/view/tips/{{$work->tip_id}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="/tip/delete/{{$work->tip_id}}" onClick="return confirm('Are you sure to delete this information?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
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

@endsection
