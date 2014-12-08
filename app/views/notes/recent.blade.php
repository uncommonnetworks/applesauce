

<div class="timeline">
    <!-- Timeline header -->
    <div class="tl-header now">Now</div>


@foreach( Note::today()->get() as $note )


    <div class="tl-entry">
        <div class="tl-time">
            {{ $note->created_at->diffForHumans() }}
        </div>




        <div class="tl-icon bg-{{ Note::$flagClass[$note->flag] }} tooltip-{{ Note::$flagClass[$note->flag] }}"
             data-placement="bottom" title="{{ Note::$flags[$note->flag] }}: {{ Note::$types[$note->type] }}">

            @if( $note->type == NOTETYPE_DETAIL )
            <img src="assets/demo/avatars/2.jpg" alt="" style="opacity: 0.5" />
            @else
            <i style="padding-top: 13px" class="fa {{ Note::$typeIcon[$note->type] }}"></i>
            @endif

        </div>

        <div class="panel tl-body">
            @if( $note->title )
            <h4 class="text-{{ Note::$flagClass[$note->flag] }}">{{ $note->title }}</h4>
            @endif
            <div class="well well-sm" style="margin: 10px 0 0 0;">
                {{ $note->text }}
            </div>
            @if( count( $note->residents ) > 1 )

            @foreach( $note->residents as $notedResident )
            <a href="{{ route('resident', $notedResident->id) }}">
                <button class="btn btn-sm btn-labeled {{ Resident::$stateButtonClass[ $notedResident->status ] }}">
                    <span class="btn-label icon fa {{ Resident::$stateIcon[ $notedResident->status ] }}"></span>
                    {{ $notedResident->display_name }}
                </button></a>

            @endforeach

            @endif
        </div> <!-- / .tl-body -->
    </div> <!-- / .tl-entry -->


@endforeach

    <!-- Timeline header -->
    <div class="tl-header now">Yesterday</div>


    @foreach( Note::yesterday()->get() as $note )


    <div class="tl-entry">
        <div class="tl-time">
            {{ $note->created_at->toTimeString() }}
        </div>




        <div class="tl-icon bg-{{ Note::$flagClass[$note->flag] }} tooltip-{{ Note::$flagClass[$note->flag] }}"
             data-placement="bottom" title="{{ Note::$flags[$note->flag] }}: {{ Note::$types[$note->type] }}">

            @if( $note->type == NOTETYPE_DETAIL )
            <img src="assets/demo/avatars/2.jpg" alt="" style="opacity: 0.5" />
            @else
            <i style="padding-top: 13px" class="fa {{ Note::$typeIcon[$note->type] }}"></i>
            @endif

        </div>

        <div class="panel tl-body">
            @if( $note->title )
            <h4 class="text-{{ Note::$flagClass[$note->flag] }}">{{ $note->title }}</h4>
            @endif
            <div class="well well-sm" style="margin: 10px 0 0 0;">
                {{ $note->text }}
            </div>
            @if( count( $note->residents ) > 1 )

            @foreach( $note->residents as $notedResident )
            <a href="{{ route('resident', $notedResident->id) }}">
                <button class="btn btn-sm btn-labeled {{ Resident::$stateButtonClass[ $notedResident->status ] }}">
                    <span class="btn-label icon fa {{ Resident::$stateIcon[ $notedResident->status ] }}"></span>
                    {{ $notedResident->display_name }}
                </button></a>

            @endforeach

            @endif
        </div> <!-- / .tl-body -->
    </div> <!-- / .tl-entry -->


    @endforeach
</div> <!-- / .timeline -->

<script>


init.push(function () {
    if (true) { //window.JQUERY_UI_EXTRAS_LOADED) {
        $('.tl-icon').tooltip();
    }
});
</script>

