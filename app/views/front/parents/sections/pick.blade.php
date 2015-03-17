<div class="col-md-5 col-xs-5 pick-strategy">
    <div class="pick-text">
        <p class="text-center ritual">{{$question->buildOption->option}}:</p>
        <br>
        <center>
            <div class="rate-container col-md-12">
                <p class="text-center">rate how it worked for you </p>
                <input class="rating" value="{{$question->score}}" data-answer-id="{{$question->id}}">
                <a href="{{URL::to('parents/build/pick/'.$sid.'/'.$question->explore_question_id)}}"><p class="text-center">PICK NEXT STRATEGY </p></a>
            </div>
        </center>
    </div>
</div>