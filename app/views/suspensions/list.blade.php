{{-- provide $suspensions, $showResident, $editable --}}

<table class="table">
    <thead>
    <tr>
        @if($showResident)
        <th>Resident</th>
        @endif
        <th>Reason</th>
        <th>Date</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody class="valign-middle">

@foreach( $suspensions as $suspension )
<tr>
    @if($showResident)
    <td>
        <img src="{{ $suspension->resident->thumbUrl }}" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;
        <a href="{{ $suspension->resident->url }}" title="">{{ $suspension->resident->display_name }}</a>

    </td>
    @endif
    <td>

@if(Auth::user()->can('notes.detail-view'))
        <button type="button" class="btn btn-info popover-info" data-toggle="popover" data-placement="right"
                data-content="{{{ $suspension->detail_note->text }}} &nbsp; &mdash; {{ $suspension->createdBy->initials }}"
                data-title="{{ $suspension->resident->display_name }} {{ $suspension->created_at }}" data-original-title="" title="">
            {{ Suspension::$durations[$suspension->duration] }}
        </button>
@else
        {{ Suspension::$durations[$suspension->duration] }}
@endif


    </td>
    <td class="text-xs text-info">

        {{ $suspension->created_at->format('M d') }}
        @if( $suspension->duration )
        &mdash;
        {{ $suspension->end_date->format('M d') }}


        <div class="progress">
            <div class="progress-bar progress-bar-danger" style="width: {{ ($suspension->created_at->diffInHours()*4.1666 / $suspension->duration) }}%;"></div>
        </div>

        @endif
    </td>
    <td>
        <img src="{{ $suspension->createdBy->initialUrl }}" class="comment-avatar" alt="">

    </td>
    <td>
<!--        <a href="{{ route('suspension-edit',$suspension->id) }}" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit"></i></a>-->
        <button type="button" class="btn btn-default btn-sm" id="edit-suspension-{{ $suspension->id }}" data-suspensionid="{{ $suspension->id }}"
                data-toggle="modal" data-target="#suspensionEdit" data-label="Edit suspension for {{ $suspension->resident->display_name }}:">
            <i class="fa fa-edit"></i>
        </button>
        <button type="button" class="btn btn-default btn-sm" id="delete-suspension-{{ $suspension->id }}"><i class="fa fa-close"></i></button>
    </td>
</tr>

<script type="text/javascript">
    init.push(function() {

        $('#edit-suspension-{{ $suspension->id }}').on('click', function() {
            var button = $('#edit-suspension-{{ $suspension->id }}');
            $('#suspensionEditLabel').text(button.data('label')); // Extract info from data-* attributes

                $.ajax({
                    url: "/suspension/edit/" + button.data('suspensionid'),
//                    data: { id: button.data('suspensionid') },
                    success: function(data) {
                        $('#suspensionEditBody').html(data);
                    }
                });

        });

        $('.modal-body').editable({
            selector: '#bs-x-editable-enddate',
            datepicker: {
                todayBtn: 'linked',
                clear: false,
                startDate: new Date()
//                endDate: '+90 days'
            },
            clear: false,
            format: 'M d, yyyy',
            success: function(response, newValue){
                $('#suspension-enddate').val(newValue);
            }
        });





        $('#delete-suspension-{{ $suspension->id }}').on('click', function () {
            bootbox.confirm({
                message: "You want to end this suspension and move {{ $suspension->resident->display_name }} back in?",
                callback: function(result) {
                    if(result)
                    {
                        window.location.href = "{{ route('suspension-delete', $suspension->id) }}";
                    }
                },
                className: "bootbox-sm"
            });
        });


    });
</script>


    @endforeach
    </tbody>
</table>

<!-- suspension edit form -->
<div id="suspensionEdit" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="suspensionEditBody">
            </div> <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

