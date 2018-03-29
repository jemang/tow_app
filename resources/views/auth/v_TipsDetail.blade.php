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
              <div class="x_panel">
                <div class="x_title">
                  <h2>Tips Details</h2>
                  <center>
                  @if (count($errors) > 0)
                  @foreach ($errors->all() as $error)
                      <font color="green">{{ $error }}<br /></font>
                  @endforeach
                  @endif
                  </center>

                  {!! csrf_field() !!}
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a href="/tip/{{$shop->category}}" class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
              
                <div class="bs-example" data-example-id="simple-jumbotron">
                  <div class="jumbotron">
                    <center>
                      <b><h3>{{$shop->title}}</h3></b></br>
                      <p><img src="{{$shop->picture}}" width="700" height="400" /></p>
                    </center>
                    <span class="message">
                        {{$shop->author}} ,
                        {{$shop->date}}.
                    </span>
                      <br><br>
                        {!!html_entity_decode($shop->info)!!}
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection