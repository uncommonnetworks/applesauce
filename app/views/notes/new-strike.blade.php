{{-- to be included in new note form --}}



<div class="row">
    <div class="col-sm-10 col-sm-offset1">
        <div class="form-group no-margin-hr">
            <label class="control-label">Reason for Strike:</label>


            {{ Form::text( NOTEFLAG_STRIKE . '-reason', null,
            array( 'id' => NOTEFLAG_STRIKE . '-reason', 'class' => 'form-control', 'placeholder' => 'Eg. Swearing' )) }}
        </div>
    </div>
</div>


{{ Form::hidden( NOTEFLAG_STRIKE.'-duration', Strike::$default_duration ) }}
{{-- in this config, all strikes last 30 days

<div class="row">
    <div class="col-sm-10 col-sm-offset1">
        <div class="form-group no-margin-hr">
            <label class="control-label">Duration</label>


            {{ Form::select( NOTEFLAG_STRIKE . '-duration', Strike::$durations, STRIKE_30DAY,
            array( 'id' => NOTEFLAG_STRIKE . '-duration', 'class' => 'form-control' )) }}
        </div>
    </div>
</div>

--}}




@if( $resident->strikes()->count() == 2 )
<div class="alert alert-danger alert-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Yikes!</strong> This will be {{ $resident->display_name }}'s 3rd strike.
</div>
@endif

@if( $resident->strikes()->count() > 0 )
<div class="panel-group panel-group-danger" id="strike-history">
    <div class="panel">
        <div class="panel-heading">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#strike-history" href="#strike-history-current">
                {{ $resident->display_name }}'s current strikes
            </a>
        </div> <!-- / .panel-heading -->
        <div id="strike-history-current" class="panel-collapse collapse" style="height: 0px;">
            <div class="panel-body">
@include('strikes.list', ['strikes' => $resident->strikes()->current()->get(), 'showResident' => false ])
            </div> <!-- / .panel-body -->
        </div> <!-- / .collapse -->
    </div> <!-- / .panel -->

    <div class="panel">
        <div class="panel-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="strike-history" href="#strike-history-past">
                {{ $resident->display_name }}'s strike history
            </a>
        </div> <!-- / .panel-heading -->
        <div id="strike-history-past" class="panel-collapse collapse" style="height: auto;">
            <div class="panel-body">
@include('strikes.list', ['strikes' => $resident->strikes()->complete()->get(), 'showResident' => false ])
            </div> <!-- / .panel-body -->
        </div> <!-- / .collapse -->
    </div> <!-- / .panel -->

</div>

@endif

