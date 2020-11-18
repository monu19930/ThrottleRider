@foreach($result as $question)
<div class="form-group">
    <h4 class="feedback-quest">{{$i++}}. {{$question['title']}}</h4>
    <ul>
        @foreach($question['options'] as $key => $option)
        <li style="list-style-type:lower-alpha;">
            <input type="radio" name="question_{{$question['id']}}" value="{{$key}}">{{$option}}
        </li>
        @endforeach
    </ul>
</div>
@endforeach