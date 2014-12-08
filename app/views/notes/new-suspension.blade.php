{{-- to be included in new note form --}}





<div class="row">
    <div class="col-sm-10 col-sm-offset1">
        <div class="form-group no-margin-hr">
            <label class="control-label">Suspension Type</label>


            {{ Form::select( NOTEFLAG_SUSPENSION . '-type', Suspension::$types, SUSPENSION_OVERNIGHT, array( 'id' => NOTEFLAG_SUSPENSION . '-type', 'class' => 'form-control' )) }}
        </div>
    </div>
</div>




<div class="row">
    <div class="col-sm-10 col-sm-offset1">
        <div class="form-group no-margin-hr">
            <label class="control-label">Duration</label>


            {{ Form::select( NOTEFLAG_SUSPENSION . '-duration', Suspension::$durations, SUSPENSION_7DAY, array( 'id' => NOTEFLAG_SUSPENSION . '-duration', 'class' => 'form-control' )) }}
        </div>
    </div>
</div>