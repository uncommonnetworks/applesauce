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
                'doctor_phone': {
                    required: false,
                    phoneUS: true
                },


                'contact_phone': {
                    required: false,
                    phoneUS: true
                }

            }
        });


        $("#resallergies").select2({tags:["<?php echo implode('","',$allergies); ?>"]});

        $("#resallergies").select2({
            initSelection : function (element, callback) {
                var data = [];
                $(element.val().split(",")).each(function () {
                    data.push({id: this, text: this});
                });
                callback(data);
            }
        });

        $("#resallergies").val(["<?php echo implode('","',$resident->allergies->lists('name','id')); ?>"]).select2();

    });

</script>

    <!-- / Javascript -->

<div class="panel">
<div class="panel-heading">
    <span class="panel-title">Emergency Contacts</span> for <?php echo $resident->display_name; ?>
</div>
<div class="panel-body">
<!--<div class="note note-info">&nbsp;</div>-->

<?php echo Form::open(array('action' => 'IntakeController@intakeContacts', 'class'=>'form-horizontal', 'id' => 'jq-validation-form')); ?>

<?php echo Form::hidden('id', $resident->id); ?>



<div class="form-group">
    <?php echo Form::label('contact_name', 'Emergency Contact Name', array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-3">
        <?php echo Form::text('contact_name', $resident->contact_name,
            array('id' => 'contact_name', 'class' => 'form-control')); ?>

    </div>
</div>
    <div class="form-group">
        <?php echo Form::label('contact_relationship', 'Relationship to ' . $resident->first_name, array('class' => 'col-sm-3 control-label')); ?>

        <div class="col-sm-3">
            <?php echo Form::text('contact_relationship', $resident->contact_relationship,
                array('id' => 'contact_relationship', 'class' => 'form-control')); ?>

        </div>
    </div>

<div class="form-group">
    <?php echo Form::label('contact_street1', 'Street Address', array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-3">
        <?php echo Form::text('contact_street1', $resident->contact_street1,
                    array( 'id' => 'contact_street1', 'class' => 'form-control' ) ); ?><br />
        <?php echo Form::text('contact_street2', $resident->contact_street2,
            array( 'id' => 'contact_street2', 'class' => 'form-control' ) ); ?>
    </div>

</div>

<div class="form-group">
    <?php echo Form::label('contact_city', 'City', array( 'class' => 'control-label col-sm-3')); ?>
    <div class="col-sm-3">
        <?php echo Form::text('contact_city', $resident->contact_city,
            array('id' => 'contact_city',  'class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo Form::label('contact_phone', 'Phone #', array( 'class' => 'col-sm-3 control-label' )); ?>
    <div class="col-sm-3">
        <?php echo Form::text('contact_phone', $resident->contact_phone,
                                array( 'id' => 'contact_phone', 'class' => 'form-control' )); ?>

    </div>
</div>

    <hr class="panel-wide">

<div class="form-group">
    <?php echo Form::label('doctor_name', 'Doctor Name', array( 'class' => 'col-sm-3 control-label' )); ?>

    <div class="col-sm-3">
        <?php echo Form::text('doctor_name', $resident->doctor_name,
            array('id' => 'doctor_name', 'class' => 'form-control')); ?>

    </div>
</div>

<div class="form-group">
    <?php echo Form::label('doctor_phone', 'Doctor Phone #', array( 'class' => 'col-sm-3 control-label' )); ?>

    <div class="col-sm-3">
        <?php echo Form::text('doctor_phone', $resident->doctor_phone,
            array( 'id' => 'doctor_phone', 'class' => 'form-control' )); ?>

    </div>
</div>

<hr />
    <div class="form-group">
        <?php echo Form::label('resallergies', 'Known Allergies?', array( 'class' => 'col-sm-3 control-label' )); ?>
<?php //dd($resident->allergies->lists('name')); ?>
        <div class="col-sm-3">
            <?php echo Form::text('resallergies', '' ,
                array( 'id' => 'resallergies', 'class' => 'form-control')); ?>

        </div>
    </div>

<hr />

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo Form::button('Save and Continue Intake <i class="fa fa-sign-in"></i>', array( 'class' => 'btn btn-lg btn-info', 'type' => 'submit' )); ?>
<!--        <button type="submit" class="btn btn-primary">Save and Continue Intake <i class="fa fa-sign-in"></i></button>-->
    </div>
</div>
<?php echo Form::close(); ?>
</div>
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
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Emergency Contacts</span></a>
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