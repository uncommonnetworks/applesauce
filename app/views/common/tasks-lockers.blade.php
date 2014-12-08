@if( Locker::dirty()->count() > 0 )

<div class="menu-content">
        <a href="pages-invoice.html" class="btn btn-primary btn-block btn-outline dark">Lockers</a>

    <ul class="navigation">

@foreach( Locker::dirty()->get() as $locker )
        <li><a href="#"><i class="fa fa-paint-brush"></i> &nbsp;  {{ $locker }} </a></li>
@endforeach
    </ul>
</div>


@endif