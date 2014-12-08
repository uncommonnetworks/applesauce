{{-- to be included in new note form --}}





<div class="row waitForResident"
@if(!$resident)
    style="display: none"
@endif
    >
    <div class="col-sm-10 col-sm-offset1">
<div class="panel-heading">
    <span class="panel-title">New Address</span>  for
@if($resident)
    {{ $resident->display_name }}
@else
    <span class="residentName">&hellip;</span>
@endif;

</div>
<div class="form-group">&nbsp;</div>
<div class="form-group">
    <?php echo Form::label('street1', 'Street Address', array( 'class' => 'control-label col-sm-3' )); ?>
    <div class="col-sm-7">
        {{ Form::text('street1', null, array('class'=>'form-control')) }}<br />
        {{ Form::text('street2', null, array('class'=>'form-control')) }}
    </div>
</div>
<!--<div class="form-group">-->
<!--    --><?php //echo Form::label('street2', '...', array( 'class' => 'control-label col-sm-3' )); ?>
<!--    <div class="col-sm-3">-->
<!---->
<!--    </div>-->
<!--</div>-->
<div class="form-group">
    {{ Form::label('city', 'City', array( 'class' => 'control-label col-sm-3' )) }}

    <div class="col-sm-7">
        {{ Form::text('city', 'St. Catharines', array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('postal', 'Postal Code', array( 'class' => 'control-label col-sm-3' )) }}

    <div class="col-sm-7">
        {{ Form::text('postal', null, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('Region', 'Region', array( 'class' => 'control-label col-sm-3' )) }}

    <div class="col-sm-7">
        {{ Form::text('region', 'Niagara', array('class'=>'form-control')) }}
    </div>
</div>

    </div>
</div>