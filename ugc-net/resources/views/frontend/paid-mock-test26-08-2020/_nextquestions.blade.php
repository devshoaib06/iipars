<?php 
    $myLibrary=new \App\library\myFunctions();
?>
<div class="row">
    <div class="col-sm-12 col-md-7 col-lg-7">
                <div class="questionCont">
                        <input type="hidden" name="drafts[]" value="" class="draftclass">
                        <input type="hidden" name="question_id" value="{{$allquestions->questionDetails->question_id}}" id="question_id">
                        

                    
                            <div >
                                <div class="questionWrap">
                                    <div class="question">
                                        <h1><span id="question_no" data-val="{{$allquestions->question_no}}">{{$allquestions->question_no}}.</span>{!! $allquestions->questionDetails->questionMaster->question !!}</h1>
                                    </div>
                                    @if ($allquestions->questionDetails->questionMaster->option_type==0)
                                        
                                        @include('frontend.paid-mock-test._none')
                                    @endif
                                    @if ($allquestions->questionDetails->questionMaster->option_type==1)
                                        
                                        @include('frontend.paid-mock-test._simple')
                                    @endif
                                    @if ($allquestions->questionDetails->questionMaster->option_type==2)
                                        @include('frontend.paid-mock-test._conjugate')
                                        
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="btnDiv">
                                @php
                                    $class="";
                                    $getAnswerType=$myLibrary->getStudentMockAnswer($q_count,$mock_test_id);
                                    $markText="Mark";
                                    if($getAnswerType==1){
                                        $class="marked";
                                        $markText="Unmark";
                                    }
                                    
                                @endphp    
                                @if ($getAnswerType==1)
                                <button type="submit" id="draftBtn_{{$q_count}}"   class="submitbtn unmark-btn btn btn-draft {{$class}}">{{$markText}}</button>
                                    
                                @else
                                <button type="submit" id="draftBtn_{{$q_count}}"   class="submitbtn mark-btn btn btn-draft {{$class}}">{{$markText}}</button>
                                    
                                @endif
                                @if ($q_count==$noofques)
                                <button type="button" id="nextBtn_{{$q_count}}" class="submitbtn  btn btn-primary sbttest" data-toggle="modal" data-target="#submit_test">Submit</button>
                                
                                @else
                                    <button type="submit" id="skipBtn_{{$q_count}}" class=" submitbtn skip-btn btn btn-default">Skip</button>
                                    
                                    <button type="button" id="nextBtn_{{$q_count}}" class="submitbtn save-next  btn btn-primary ">Save & Next</button>
                                @endif
                            </div>
                            @php 
                                $q_count++;
                            @endphp  
                                
                    </div>
            
    </div>
    <div class="col-sm-12 col-md-5 col-lg-5">
        <div class="rightPanel">
        <h4>{{$subject}}</h4>
        
            <ul class="answerType">

                <li><span class="answered"></span><div class="ansText">{{$answeredQues}}</div> answered</li>
                <li><span class="mark"></span><div class="markText">{{$draftQues}}</div> mark</li>
                <li><span class="unanswered"></span><div class="unansText">{{$unanswered}}</div> unanswered</li>
            </ul>
            <ul class="questionNum">
               
                @for ($j=1;$j<=$noofques;$j++)
                    @php
                        $class="";
                        $getAnswerType=$myLibrary->getStudentMockAnswer($j,$mock_test_id);
                        
                        if($getAnswerType==1){
                            $class="markNum";
                        }
                        if($getAnswerType==2){
                            $class='answeredNum';
                        }
                        $curNum=$q_count-1;
                    @endphp    
                    
                    <li class="question_count {{$class}} {{$curNum==$j?'currentNum':''}}" data-val="{{$j}}" id="question_count_{{$j}}">{{$j}}</li>
            
                @endfor
                
            </ul>

        </div>

    </div>
</div>