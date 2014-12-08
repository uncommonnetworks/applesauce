{{-- to be included in new note form --}}



<div class="row">
    <div class="col-sm-10 col-sm-offset1">
        <div class="form-group no-margin-hr">
            <label class="control-label">Full Name of individual awaiting intake:</label>


            {{ Form::text( NOTEFLAG_PENDINGINTAKE . '-person', null, ['id' => NOTEFLAG_PENDINGINTAKE . '-person', 'class' => 'form-control']) }}
        </div>
    </div>
</div>
