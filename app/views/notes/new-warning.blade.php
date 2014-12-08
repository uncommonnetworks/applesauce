{{-- to be included in new note form --}}





<div class="row">
    <div class="col-sm-10 col-sm-offset1">
        <div class="form-group no-margin-hr">
            <label class="control-label">Reason for Warning:</label>


            {{ Form::text( NOTEFLAG_WARNING . '-reason', null,
                array( 'id' => NOTEFLAG_WARNING . '-reason', 'class' => 'form-control', 'placeholder' => 'Eg. Not Participating in Crazy Hair Day' )) }}
        </div>
    </div>
</div>

