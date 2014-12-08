@if( Bed::notready()->count() > 0 )

<div class="menu-content">
        <a href="pages-invoice.html" class="btn btn-primary btn-block btn-outline dark">Beds</a>

    <ul class="navigation">

@foreach( Bed::notready()->get() as $bed )
        <li><a href="#"><i class="fa fa-paint-brush"></i>&nbsp;  {{ $bed }} </a></li>
@endforeach
    </ul>
</div>


@endif