

@foreach( $residents as $resident )



<div class="comment">
    <img src="{{ $resident->thumbUrl }}" alt="" class="comment-avatar">
    <div class="comment-body">
        <div class="comment-by">
            <i class="fa fa-{{ Resident::$stateIcon[$resident->status] }}"></i>
            <span class="text-bg"><a href="{{ route('resident',$resident->id) }}">{{ $resident->display_name }}</a></span>
            {{ $resident->date_of_birth }}
            <span class="pull-right">
                <button type="button"><a href="#"><i class="fa fa-plus"></i> Note</a></button>
            </span>
        </div>
        <div class="comment-text">
details here?
        </div>
        <div class="comment-actions">


@if($resident->status == RESIDENTSTATUS_OWP)

            <a href="{{ route('note-new', NOTEFLAG_OWPR, $resident->id) }}"
                class="title {{ Note::$flagClass[NOTEFLAG_OWPR] }}"><i class="fa {{ Note::$flagIcon[NOTEFLAG_OWPR] }}"></i> {{ Note::$flags[NOTEFLAG_OWPR] }}</a>
@endif
            <span class="pull-right">{{ $resident->updated_at->toDateTimeString() }}</span>
        </div>
    </div> <!-- / .comment-body -->
</div> <!-- / .comment -->




@endforeach