@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <?php if(Session::has('message')) { ?>
                <div class="alert <?php if(Session::has('messageClass')) echo Session::get('messageClass'); ?>">
                    {{ Session::get('message') }}
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    @include('frontend.includes.student_menu')
                </div>
                <div class="col-sm-12">
                  <div class="tabCont">
                    <h1>My Account</h1>
                    <div class="row">
                    <form class="form" action="{{route('account-update',['id'=>Hasher::encode(@$result[0]->id)])}}" method="post" name="stud_form" id="stud_form">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="id" value="{{$result[0]->id}}">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>First name:</label>
                          <input type="text" class="form-control" name="firstname" id="firstname" value="{{$result[0]->firstname}}">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Last name:</label>
                          <input type="text" class="form-control" name="lastname" id="lastname" value="{{$result[0]->lastname}}">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Email:</label>
                          <input type="text" class="form-control" name="email" id="email" value="{{$result[0]->email}}">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Phone No.:</label>
                          <input type="text" class="form-control" name="phn_no" id="phn_no" value="{{$result[0]->contactnumber}}">
                        </div>
                      </div>
                      <div class="col-sm-12">
                          <button type="submit" class="submitbutdash">Update</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection