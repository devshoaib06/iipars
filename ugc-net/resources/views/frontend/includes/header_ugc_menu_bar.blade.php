@php
$subjects = $myfunction->getPapers();
@endphp

@foreach ($subjects as $subject)

    <li>
        <a href="#">
            {!! $subject->paper_name == 'PAPER - I'
    ? "<h4 class='m-0'>Paper – I</h4>
                                    "
    : $subject->paper_name !!}
        </a>

        <ul class="dropdown" aria-labelledby="dropdownSubMenu1">
            <li>
                <h4 style="padding-left: 22px;">Courses</h4>
            </li>
            <li role="separator" class="divider bg-dark" style="height: 1px; background: #ccc;">
            </li>
            @php
                $allCourses=[];
                $allCourses=$myfunction->getCourses(1,$subject->id);

               
            @endphp
            @foreach ($allCourses as $course)
                @if (!empty($course->product))
                    
                    <li>
                        <a href="#">{{ $course->product->name }}</a>
                            <ul class="dropdown" aria-labelledby="dropdownSubMenu2">
                                @php
                                    $preview_course=$myfunction->getCoursePreview($course->product->product_id);
                                @endphp
                                @if ($preview_course)
                                    <li>
                                        <a href="<?= url('/') ?>/course/<?= $preview_course->slug ?>">Preview</a>
                                    </li>
                                @endif
                                
                                    <li>
                                        <a href="<?= url('/') ?>/course/<?= $course->product->slug ?>">Order Now</a>
                                    </li>
                                
                            </ul>    
                    </li>    


                @endif 
            @endforeach
            

        </ul>
    </li>
@endforeach
