{{-- provide $strikes, $showResident, $editable --}}

<table class="table">
    <thead>
    <tr>
@if($showResident)
        <th>Resident</th>
@endif
        <th>Reason</th>
        <th>Date</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody class="valign-middle">

    @foreach( $strikes as $strike )
    <tr>
@if($showResident)
        <td>
            <img src="{{ $strike->resident->thumbUrl }}" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;
            <a href="{{ $strike->resident->url }}" title="">{{ $strike->resident->display_name }}</a>
            ( {{ Strike::current()->forResident( $strike->resident->id )->count() }} )
        </td>
@endif
        <td>

@if(Auth::user()->can('notes.detail-view'))
            <button type="button" class="btn btn-info popover-info" data-toggle="popover" data-placement="right"
                    data-content="{{{ $strike->detail_note->text }}} &nbsp; &mdash; {{ $strike->createdBy->initials }}"
                    data-title="{{ $strike->resident->display_name }} {{ $strike->created_at }}" data-original-title="" title="">
                {{{ $strike->reason }}}
            </button>
@else
            {{{ $strike->reason }}}
@endif


        </td>
        <td class="text-xs text-info">

            {{ $strike->created_at->format('M d') }}
            @if( $strike->duration )
            &mdash;
            {{ $strike->end_date->format('M d') }}


            <div class="progress">
                <div class="progress-bar progress-bar-danger" style="width: {{ ($strike->created_at->diffInHours()*4.1666 / $strike->duration) }}%;"></div>
            </div>

            @endif
        </td>
        <td>
            <img src="{{ $strike->createdBy->initialUrl }}" class="comment-avatar" alt="">
            <!--                            <a href="{{ route('warning-delete',$strike->id) }}" class="btn btn-danger btn-xs" title="Forget This Warning"><i class="fa fa-undo"></i></a>-->
        </td>
    </tr>
    @endforeach
    </tbody>
</table>