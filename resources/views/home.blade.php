@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
    </style>
@endsection
@section('content')
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

        <!-- The Grid -->
        <div class="w3-row-padding">
            <!-- Left Column -->
            <div class="w3-third">
                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        <img src="{{$personal?URL::to($personal->photo):"'https://ui-avatars.com/api/?background=1C88FD&color=ffffff&name='.Auth::user()->name"}}" style="width:100%;height: 250px;" alt="Avatar">
                        <div class="w3-display-bottomleft w3-container w3-text-black">
                            <h2>{{$personal?$personal->f_name:''}}  {{$personal?$personal->l_name:''}}</h2>
                        </div>
                    </div>
                    <div class="w3-container">
                        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$personal?$personal->designation:""}}</p>
                        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$personal?$personal->email:''}}</p>
                        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$personal?$personal->mobile:''}}</p>
                        <hr>

                        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
                        @foreach($skills as $skill)
                        <p>{{$skill->skill}}</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:{{$skill->skill_label}}%">{{$skill->skill_label}}%</div>
                        </div>
                        @endforeach

                        <br>
                    </div>
                </div><br>

                <!-- End Left Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-twothird">

                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience</h2>
                    @foreach($employments as $emp)
                    <div class="w3-container">
                        <h5 class="w3-opacity"><b>{{$emp->designation}}</b></h5>
                        <h5 class="w3-opacity"><b>{{$emp->company}}</b></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{date('d M Y',strtotime($emp->from_year))}}- {{date('d M Y',strtotime($emp->to_year))}}</h6>
                        <p>{{$emp->desc}}</p>
                        <hr>
                    </div>
                    @endforeach

                </div>

                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
                    @foreach($educations as $edu)
                    <div class="w3-container">
                        <h5 class="w3-opacity"><b>{{$edu->degree}}</b></h5>
                        <p class="w3-opacity"><b>{{$edu->institute}}</b></p>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{$edu->passing_year}}</h6>
                        <hr>
                    </div>
                    @endforeach

                </div>

                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Projects</h2>
                    @foreach($projects as $p)
                        <div class="w3-container">
                            <img src="{{URL::to($p->image)}}" style="height: 100px;width: 100px;">
                            <h5 class="w3-opacity"><b>{{$p->title}}</b></h5>
                            <p class="w3-opacity"><b>{{$p->type}}</b></p>
                            <h6 class="w3-text-teal"><span class=" fa-fw"></span>{{$p->sort_des}}</h6>
                            <hr>
                        </div>
                    @endforeach

                </div>

                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>

    <footer class="w3-container w3-teal w3-center w3-margin-top">
        <p>Find me on social media.</p>
        <a href="{{$social?$social->facebook:''}}"> <i class="fa fa-facebook-official w3-hover-opacity"></i></a>
        <a href="{{$social?$social->twitter:''}}"> <i class="fa fa-twitter w3-hover-opacity"></i></a>
        <a href="{{$social?$social->linked_in:''}}"><i class="fa fa-linkedin w3-hover-opacity"></i></a>
    </footer>
@endsection
