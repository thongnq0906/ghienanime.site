<div id="slide">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($slide as $key => $s)
                <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="@if ($key == 0)
                    active
                @endif"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox" id="slide1">
            @foreach($slide as $key => $c)
            <div class="item @if ($key == 0)
                active
            @endif">
                <img src="{{ asset($c->image) }}" alt="imgSlide" title="" id="wows1_0"
                class="img-responsive img100 " style="width:100%;" />
            </div>
            @endforeach
        </div>
        <li class="left carousel-control" data-target="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </li>
        <li class="right carousel-control" data-target="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </li>
    </div>
</div>
