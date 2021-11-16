
@if ($link == 1)
    <iframe allowfullscreen='' frameborder='0' height='360' id='myframe' scrolling='no' src='{{ $episode->link1 }}' width='640'></iframe>
@endif
@if ($link == 2)
    <iframe allowfullscreen='' frameborder='0' height='360' id='myframe' scrolling='no' src='{{ $episode->link2 }}' width='640'></iframe>
@endif
@if ($link == 3)
    <iframe allowfullscreen='' frameborder='0' height='360' id='myframe' scrolling='no' src='{{ $episode->link3 }}' width='640'></iframe>
@endif
@if ($link == 4)
    <iframe allowfullscreen='' frameborder='0' height='360' id='myframe' scrolling='no' src='{{ $episode->link4 }}' width='640'></iframe>
@endif