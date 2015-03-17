<div class="col-md-5 col-xs-5 remind-question-exp">
    <span style="float:right;padding-top:5px;">
        <a href="{{URL::to('/parents/explore/completeExplore/'.$question->id)}}" style="color:#1d5c2e;font-size:40px">
            <i class="fa fa-check-circle-o"></i>
        </a>
    </span>

    <div class="remind-text">
        <p class="text-center">{{$question->exploreQuestion->question}}</p>
        <p class="text-center">REMIND ME TO EXPLORE </p>
    </div>
</div>