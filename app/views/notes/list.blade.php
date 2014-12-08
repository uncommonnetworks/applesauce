<div class="panel-body tab-content-padding">
    <!-- Panel padding, without vertical padding -->
    <div class="panel-padding no-padding-vr" id="notes-dashboard">

@foreach( $notes as $note )



<div class="comment">
    @if( $note->important )
    <div class="alert alert-info text-default">
    @endif

    @if( count($note->residents) )
    @foreach( $note->residents as $referred )
        <img src="{{ $referred->thumbUrl }}" alt="" class="comment-avatar">
    @endforeach
    @endif
    <div class="comment-body">
        <div class="comment-by">
            <a href="#" title="">{{ $note->author->name }}</a> noted
            @if( $note->title )
            on <span class="text-bg"><a href="#" title="">{{ $note->title }}</a></span>
            @endif
            @if( count($note->residents) )
            re: <span class="text-bg">
                @foreach( $note->residents as $referred )
                <a href="{{ route('resident', $referred->id) }}" title="">{{ $referred->display_name }}
<!--                    <span class="{{ Resident::$stateBadgeClass[$referred->status] }}">{{ Resident::$states[$referred->status] }}</span>-->
                    &raquo;</a>
                &nbsp;&nbsp;
                @endforeach
            </span>
            @endif
            <span class="pull-right"><img src="{{ $note->author->initialUrl }}" alt="" class="comment-avatar"></span>
        </div>
        <div class="comment-text">
            {{ $note->text }}
        </div>
        <div class="comment-actions">
            <a href="#"><i class="fa text-{{ Note::$flagClass[$note->flag] }} {{ Note::$flagIcon[$note->flag] }}"></i>{{ Note::$flags[$note->flag] }}</a>

            @if($note->important)
            <a href="{{ route('note-unimportant', $note->id) }}"><i class="fa fa-volume-down"></i> Not Important</a>
            @else
            <a href="{{ route('note-important', $note->id) }}"><i class="fa fa-volume-up"></i> Make Important</a>
            @endif

            <span class="pull-right">{{ $note->created_at->format(NOTE_DATEFORMAT) }}</span>
        </div>
    </div> <!-- / .comment-body -->


    @if($note->important)
    </div>
    @endif
</div> <!-- / .comment -->




@endforeach



    </div>
</div> <!-- / .panel-body -->