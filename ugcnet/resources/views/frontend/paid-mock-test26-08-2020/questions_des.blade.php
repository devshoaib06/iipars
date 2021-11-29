@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')

@section('page_content')
<?php 
    $myLibrary=new \App\library\myFunctions();
?>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                {{-- <li><a href="{{ route('home') }}">Home</a></li> --}}
                <li>Mock Test</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mcqTestHead">
                            <h3>Time Left: <span class="timer">{{trim(getMockTestSettings('mt_duration'))}}:00</span> </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <form action="{{route('submitAnwser')}}" method="POST"    id="mt_test" >
                            @csrf
                            @php 
                                $q_count=$opt_count=1;
                                
                            @endphp
                        <div class="questionCont">
                            <input type="hidden" name="question_id" value="{{$allquestions->question_id}}" id="question_id">

                            <div class="questionWrap">
                                <div class="question">
                                    <h1><span>1.</span>Which among the following is associated with instruction?</h1>
                                </div>
                                <label class="option"><span>A</span>
                                    <input type="radio" name="answer[15]" value="104"> 144
                                </label>
                                <label class="option"><span>B</span>
                                    <input type="radio" name="answer[15]" value="105"> 89
                                </label>
                                <label class="option"><span>C</span>
                                    <input type="radio" name="answer[15]" value="106"> 105
                                </label>
                                <label class="option"><span>D</span>
                                    <input type="radio" name="answer[15]" value="107"> 70
                                </label>
                            </div>
                            <div class="questionWrap">
                                <div class="question">
                                    <h1><span>1.</span>Choose the correct characteristic of effective teaching</h1>
                                </div>
                                <div class="qus_ref">
                                    <ul>
                                        <li><span>1.</span>Teaching is purposeful and directional.</li>
                                        <li><span>2.</span>Teaching is non-planned activity.</li>
                                        <li><span>3.</span>Teaching is a progressive process.</li>
                                        <li><span>4.</span>Teaching is based on the effectiveness teacher.</li>
                                    </ul>
                                </div>
                                <label class="option"><span>A</span>
                                    <input type="radio" name="answer[15]" value="104"> 1,2 and 3
                                </label>
                                <label class="option"><span>B</span>
                                    <input type="radio" name="answer[15]" value="105"> 2,3 and 4
                                </label>
                                <label class="option"><span>C</span>
                                    <input type="radio" name="answer[15]" value="106"> 4,3 and 1
                                </label>
                                <label class="option"><span>D</span>
                                    <input type="radio" name="answer[15]" value="107"> 1,2,3 and 4
                                </label>
                            </div>

                            <div class="questionWrap">
                                <div class="question">
                                    <h1><span>1.</span>Match the following</h1>
                                </div>
                                <div class="col-sm-6">
                                    <div class="column-1">
                                        <H4>Column-I</h4>
                                        <ul>
                                            <li><span>1.</span>Memory Level</li>
                                            <li><span>2.</span>Understanding Level</li>
                                            <li><span>3.</span>Reflective Level</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="column-2">
                                        <H4>Column-II</h4>
                                        <ul>
                                            <li><span>I.</span>Thoughtful Teaching</li>
                                            <li><span>II.</span>Upper thoughtful level</li>
                                            <li><span>III.</span>Thoughtless teaching </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cloumn-option">
                                    <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                <label class="option"><span>A</span>
                                                    <input type="radio" name="answer[15]" value="104">
                                                </label>
                                                </td>
                                                <td>I</td>
                                                <td>II</td>
                                                <td>II</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label class="option"><span>B</span>
                                                    <input type="radio" name="answer[15]" value="105">
                                                </label>
                                                </td>
                                                <td>III</td>
                                                <td>II</td>
                                                <td>I</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label class="option"><span>C</span>
                                                    <input type="radio" name="answer[15]" value="106">
                                                </label>
                                                </td>
                                                <td>III</td>
                                                <td>I</td>
                                                <td>II</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <label class="option"><span>D</span>
                                                    <input type="radio" name="answer[15]" value="107">
                                                </label>
                                                </td>
                                                <td>II</td>
                                                <td>I</td>
                                                <td>III</td>
                                            </tr>
                                        </tbody>

                                    </table>

                                </div>


                               
                               
                               
                                
                            </div>


                            <div class="btnDiv">
                                <button type="submit"  class="submitbtn mark-btn btn btn-draft">Mark</button>
                                <button type="submit"  class=" submitbtn skip-btn btn btn-default">Skip</button>
                                <button type="button"  class="submitbtn save-next  btn btn-primary">Save & Next</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="rightPanel">
                        <h4>{{$allquestions['subject']->subject_name}}</h4>
                            <ul class="answerType">
                                <li><span class="answered"></span><div class="ansText">0</div> answered</li>
                                <li><span class="mark"></span><div class="markText">0</div> mark</li>
                                <li><span class="unanswered"></span><div class="unansText">0</div> unanswered</li>
                            </ul>
                            <ul class="questionNum">
                                @php 
                                    $list_count=1;
                                @endphp
                                @foreach ($allquestions as $question)
                                    <li class="question_count" id="question_count_{{$list_count}}">{{$list_count}}</li>
                                @php 
                                    $list_count++;
                                @endphp 
                                @endforeach
                                
                            </ul>

                        </div>

                    </div>
                </div>

                              


        </div>
        <div class="testClock">
            <h3>Time Left: <span class="timer">{{trim(getMockTestSettings('mt_duration'))}}:00</span> </h3>
        </div>

    </section>
</section>
@endsection

@push('page_js')

       
   
@endpush