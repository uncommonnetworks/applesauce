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
    <h1><span class="text-light-gray">Intake / </span>Name</h1>
</div> <!-- / .page-header -->

<div class="row">
<div class="col-sm-12">


<!-- Javascript -->
<script>



    init.push(function () {

        $("#jq-validation-form").validate({
            rules: {
                'detail_note': {
                    required: true
                },

                'shift_note': {
                    required: true
                }
            }
        });

    });


</script>

    <!-- / Javascript -->

<div class="panel">
<div class="panel-heading">
    <span class="panel-title">Intake Notes</span> for <?php echo $resident->display_name; ?>
</div>
<div class="panel-body">
<!--<div class="note note-info">&nbsp;</div>-->

<?php echo Form::open(array('action' => 'IntakeController@intakeNotes', 'class'=>'form-horizontal', 'id' => 'jq-validation-form', 'files'=>true)); ?>

<?php echo Form::hidden('id', $resident->id); ?>

<?php $residency = $resident->residency; ?>
<?php /*
<div class="form-group">
    <?php echo Form::label('govt_note', Note::$types[ NOTETYPE_GOVT ], array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-6">
        <?php echo Form::textarea('govt_note', $residency->governmentNote,
            array('id' => 'govt_note', 'class' => 'form-control')); ?>

    </div>

    <div class="col-sm-3 well-lg help-block note">
        Staff Instructions here?
    </div>
</div>
 */ ?>
<div class="form-group">
    <?php echo Form::label('detail_note', Note::$types[ NOTETYPE_DETAIL ], array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-6">
        <?php echo Form::textarea('detail_note', $residency->detailNote,
            array('id' => 'detail_note', 'class' => 'form-control')); ?>

    </div>


</div>
    <div class="form-group">
        <?php echo Form::label('shift_note', Note::$types[ NOTETYPE_SHIFT ], array('class' => 'col-sm-3 control-label')); ?>

        <div class="col-sm-6">
            <?php echo Form::textarea('shift_note', $residency->shiftNote ? $residency->shiftNote : "{$resident->display_name} has moved in.",
                array('id' => 'shift_note', 'class' => 'form-control')); ?>

        </div>


    </div>


</div>
</div>





<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo Form::button('Save and Continue Intake <i class="fa fa-sign-in"></i>', array( 'class' => 'btn btn-lg btn-info', 'type' => 'submit' )); ?>
    </div>
</div>
<?php echo Form::close(); ?>
</div>
</div>




</div>


<script>


</script>
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
        <li>
            <a tabindex="-1" href="{{ route('intake-background', $resident->id) }}"><span class="mm-text">Background Info</span></a>
        </li>
        <li>
            <a tabindex="-1" href="{{ route('intake-contacts', $resident->id) }}"><span class="mm-text">Emergency Contacts</span></a>
        </li>
        <li>
            <a tabindex="-1" href="{{ route('intake-money', $resident->id) }}"><span class="mm-text">Financial Details</span></a>
        </li>
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Notes</span></a>
        </li>

@if($resident->residency->detailNote)
        <li>
            <a tabindex="-1" href="{{ route('intake-finish', $resident->id) }}"><span class="mm-text">Pictures</span></a>
        </li>
@endif
        <li>
            <a tabindex="-1" href="#"><span class="mm-text">Cancel Intake</span></a>
        </li>
    </ul>
</li>
@stop