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



    <div class="panel">

<div class="panel-body">


<?php echo Form::open(array('action' => 'IntakeController@intakeBed', 'class'=>'form-horizontal')); ?>

<?php echo Form::hidden('id', $resident->id); ?>

<div class="panel-heading">
    <span class="panel-title">Select a Bed</span>  for <?php echo $resident->display_name; ?>
</div>
<div class="form-group">&nbsp;</div>
<div class="form-group">
<?php

$beds = Bed::vacant()->where( 'gender', $resident->gender )->get();
$select = array();
foreach($beds as $bed)
    $select[$bed->id] = $bed->__toString();


?>
    <div class="col-sm-3 col-sm-offset-1">
@if( $resident->bed )
        {{ Form::text('bed_id', $resident->bed, array('class'=>'form-control', 'disabled' => 'true')) }}
@else
        {{ Form::select('bed_id', $select, array('class' => 'form-control')) }}
@endif
    </div>
</div>
<!--<div class="form-group">-->
<!--    --><?php //echo Form::label('street2', '...', array( 'class' => 'control-label col-sm-3' )); ?>
<!--    <div class="col-sm-3">-->
<!---->
<!--    </div>-->
<!--</div>-->

<div class="panel-heading">
    <span class="panel-title">Intake Date</span>
</div>

<div class="form-group">&nbsp;</div>
<div class="form-group">
    <div class="col-sm-3 col-sm-offset-1">
    <?php echo Form::text( 'intake_date', Carbon\Carbon::create()->format(Config::get('format.datetime')), array('class'=>'form-control', 'disabled' => 'true')); ?>

        <p class="help-block">Continuing will reserve this bed and record <?php echo $resident->display_name; ?> moved in as of today.</p>
    </div>
</div>

<hr class="panel-wide" />

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo Form::button('Save and Continue Intake <i class="fa fa-sign-in"></i>', array( 'class' => 'btn btn-lg btn-info', 'type' => 'submit' )); ?>
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
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Bed</span></a>
        </li>


@if( $resident->residency )
        <li>
            <a tabindex="-1" href="{{ route('intake-money', $resident->id) }}"><span class="mm-text">Financial Details</span></a>
        </li>
        <li>
            <a tabindex="-1" href="{{ route('intake-background', $resident->id) }}"><span class="mm-text">Background Info</span></a>
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
@endif


        <li>
            <a tabindex="-1" href="#"><span class="mm-text">Cancel Intake</span></a>
        </li>
    </ul>
</li>

@stop