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
                        <form action="" method="" id="mt_test" >
                            <div class="questionCont">
                                <div class="questionWrap qactive">
                                    <div class="question">
                                        <h1><span>1.</span>What is the number of women matches officials across different International Cricket Council panels?</h1>
                                    </div>
                                    <input type="hidden" name="questions[24]" value="24">
                                    <label class="option"><span>A</span>
                                        <input type="radio" class="optionInp" name="name" value="140"> 10
                                    </label>
                                    <label class="option"><span>B</span>
                                        <input type="radio" class="optionInp" name="name" value="141"> 12
                                    </label>
                                    <label class="option"><span>C</span>
                                        <input type="radio" class="optionInp" name="name" value="142"> 14
                                    </label>
                                    <label class="option"><span>D</span>
                                        <input type="radio" class="optionInp" name="name" value="143"> 8
                                    </label>                                                                     
                                </div>
                                <div class="questionWrap qinactive">
                                    <div class="question">
                                        <h1><span>2.</span>Reserve bank of India extended the regulatory restrictions on Punjab and Maharashtra Cooperative Bank (PMC) Bank by how much time?</h1>
                                    </div>
                                    <input type="hidden" name="questions[24]" value="24">
                                    <label class="optionA"><span>A</span>
                                        <input type="radio" name="" value="140"> 6 Months
                                    </label>
                                    <label class="optionB checked"><span>B</span>
                                        <input type="radio" name="" value="141"> 1 Year
                                    </label>
                                    <label class="optionC"><span>C</span>
                                        <input type="radio" name="" value="142"> 1 Months
                                    </label>
                                    <label class="optionD"><span>D</span>
                                        <input type="radio" name="" value="143"> 3 Months
                                    </label>                                                           
                                </div>
                                
                            </div>
                                
                            <div class="btnDiv">
                                <button type="submit" id="draftBtn" class="submitTest btn btn-draft">Draft</button>
                                <button type="submit" id="skipBtn" class="submitTest btn btn-default">Skip</button>
                                <button type="submit" id="nextBtn" class="submitTest btn btn-primary">Next</button>
                            </div>
                            
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="rightPanel">
                            <h4>General Knowledge</h4>
                            <ul class="answerType">
                                <li><span class="answered"></span><div class="ansText">10 answered</div></li>
                                <li><span class="mark"></span><div class="markText">3 mark</div></li>
                                <li><span class="unanswered"></span><div class="unansText">7 unanswered</div></li>
                            </ul>
                            <ul class="questionNum">
                                <li class="answeredNum">1</li>
                                <li class="currentNum">2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                                <li>7</li>
                                <li class="answeredNum">8</li>
                                <li class="answeredNum">9</li>
                                <li class="answeredNum">10</li>
                                <li class="answeredNum">11</li>
                                <li class="markNum">12</li>
                                <li class="markNum">13</li>
                                <li>14</li>
                                <li class="markNum">15</li>
                                <li class="answeredNum">16</li>
                                <li class="answeredNum">17</li>
                                <li class="answeredNum">18</li>
                                <li class="answeredNum">19</li>
                                <li class="answeredNum">20</li>
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