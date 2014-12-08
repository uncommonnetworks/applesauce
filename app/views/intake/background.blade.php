@extends('layouts.master')


@section('head-tags')
<!--<link href="css/bootstrap-editable.css" rel="stylesheet">-->
<!--<script src="js/bootstrap-editable.js"></script>-->
@stop

@section('body-tag')

<body class="theme-clean main-menu-right">
@stop

@section('page')
<div class="page-header">
    <h1><span class="text-light-gray">Intake / </span>Background Info</h1>
</div> <!-- / .page-header -->

<div class="row">
<div class="col-sm-12">


<!-- Javascript -->
<script>

    init.push(function () {

        // Setup validation
        $("#jq-validation-form").validate({

            focusInvalid: false,
            rules: {
                'postal': {
                    required: false,
                    minlength: 6,
                    pattern: "[A-Za-z][0-9][A-Za-z] ?[0-9][A-Za-z][0-9]"
                },


                'city': {
                    required: false,
                    minlength: 2
                },


                'region': {
                    required: false,
                    minlength: 3
                }


            }
        });
    });
</script>
<!-- / Javascript -->


    <div class="panel">

<div class="panel-body">


<?php echo Form::open(array('action' => 'IntakeController@intakeBackground', 'class'=>'form-horizontal', 'id' => 'jq-validation-form')); ?>

<?php echo Form::hidden('id', $resident->id); ?>

<?php

// address is either:
// a returning resident's current address,
// or unknown

if( $resident->status == RESIDENTSTATUS_FORMER )
    $address = $resident->currentAddress;

else if( $resident->status == RESIDENTSTATUS_INTAKE )
    $address = $resident->previousAddress;

if(!$address)
    $address = new PreviousAddress();


?>

@if($resident->status == RESIDENTSTATUS_INTAKE)
    {{ Form::hidden('previousAddressId', $address->id) }}
@endif

<div class="panel-heading">
    <span class="panel-title">Previous Address</span>  for <?php echo $resident->display_name; ?>
</div>
<div class="form-group">&nbsp;</div>
<div class="form-group">
    <?php echo Form::label('street1', 'Street Address', array( 'class' => 'control-label col-sm-3' )); ?>
    <div class="col-sm-3">
        {{ Form::text('street1', $address->street1, array('class'=>'form-control')) }}<br />
        {{ Form::text('street2', $address->street2, array('class'=>'form-control')) }}
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

    <div class="col-sm-3">
        {{ Form::text('city', $address->city, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('postal', 'Postal Code', array( 'class' => 'control-label col-sm-3' )) }}

    <div class="col-sm-3">
        {{ Form::text('postal', $address->postal, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('Region', 'Region', array( 'class' => 'control-label col-sm-3' )) }}

    <div class="col-sm-3">
        {{ Form::text('region', $address->region, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('start_date_m', 'From', array('class' => 'col-sm-3 control-label')) }}
    <div class="col-sm-3">
        {{ Form::selectMonth( 'start_date_m', date( 'm', strtotime( $address->start_date )) ) }}
        {{ Form::select( 'start_date_y', PreviousAddress::startDateYears(), date( 'Y', strtotime( $address->start_date)) ) }}
        <?php //echo Form::text('start_date', $resident->previousAddress->startDate, array( 'class'=>'form-control col-sm-2')); ?>
        <p class="help-block">

            Until <?php echo date( 'M Y' ); ?>
        </p>

    </div>
</div>

<div class="panel-heading">
    <span class="panel-title">Regional History</span>
</div>

<div class="form-group">&nbsp;</div>
<div class="form-group">
    {{ Form::label('previous_region', 'Previously Living In', array( 'class' => 'control-label col-sm-3' )) }}
    <div class="col-sm-5">
        {{ Form::textarea( 'previous_region', $resident->previous_region, array( 'class' => 'form-control', 'placeholder' => 'Niagara May/2013 through Dec/2013' )) }}
    </div>
</div>

<hr class="panel-wide" />

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {{ Form::button('Save and Continue Intake <i class="fa fa-arrow-right"></i>', array( 'class' => 'btn btn-lg btn-info', 'type' => 'submit' )) }}
        <!--        <button type="submit" class="btn btn-primary">Save and Continue Intake <i class="fa fa-sign-in"></i></button>-->
    </div>
</div>
<?php echo Form::close(); ?>
</div>
</div>

</div>
</div>


@stop


@section('context-menu')
<li class="mm-dropdown open active">
    <a href="#"><i class="menu-icon fa fa-sign-in"></i><span class="mm-text">INTAKE</span><span class="label label-info">in-progress</span></a>
    <ul>
        <li>
            <a tabindex="-1" href="{{ route('intake-begin', $resident->id) }}"><span class="mm-text">Name &amp; ID</span></a>
        </li>
        <li>
            <a tabindex="-1" href="{{ route('intake-bed', $resident->id) }}"><span class="mm-text">Bed</span></a>
        </li>
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Background Info</span></a>
        </li>
        <li>
            <a tabindex="-1" href="{{ route('intake-contacts', $resident->id) }}"><span class="mm-text">Emergency Contacts</span></a>
        </li>

@if( $resident->residency->detailNote )
        <li>
            <a tabindex="-1" href="{{ route('intake-notes', $resident->id) }}"><span class="mm-text">Notes</span></a>
        </li>

        <li>
            <a tabindex="-1" href="{{ route('intake-finish', $resident->id) }}"><span class="mm-text">Pictures</span></a>
        </li>
@endif
        <li>
            <a tabindex="-1" href="#">
                <i class="menu-icon fa fa-trash"></i> &nbsp;
                <span class="mm-text">Cancel Intake</span>
            </a>
        </li>
    </ul>
</li>
@stop