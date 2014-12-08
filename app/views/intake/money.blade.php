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

        $.validator.addMethod("money", function (value, element) {
            return this.optional(element) ||  /^\$?(\d{1,3}(\,\d{3})*|(\d+))(\.\d{2})?$/.test(value);
        }, "Please specify a valid dollar amount");


        $("#jq-validation-form").validate({
            rules: {
                'exp_rent': {
                    required: false,
                    money: true
                },

                'exp_mortgage': {
                    required: false,
                    money: true
                },
                'exp_room_and_board': {
                    required: false,
                    money: true
                },

                'exp_fire_insurance': {
                    required: false,
                    money: true
                },

                'exp_taxes': {
                    required: false,
                    money: true
                },

                'exp_fuel': {
                    required: false,
                    money: true
                }
            }
        });



    });

</script>

    <!-- / Javascript -->

<div class="panel">
<div class="panel-heading">
    <span class="panel-title">Financial Details</span> for <?php echo $resident->display_name; ?>
</div>
<div class="panel-body">
<!--<div class="note note-info">&nbsp;</div>-->

<?php echo Form::open(array('action' => 'IntakeController@intakeMoney', 'class'=>'form-horizontal', 'id' => 'jq-validation-form')); ?>

<?php echo Form::hidden('id', $resident->id); ?>

<?php $residency = $resident->residency; ?>

<div class="form-group">
    <?php echo Form::label('exp_rent', 'Rent', array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-3">
        <?php echo Form::text('exp_rent', $residency->exp_rent,
            array('id' => 'exp_rent', 'class' => 'form-control')); ?>

    </div>
</div>
<div class="form-group">
    <?php echo Form::label('exp_taxes', 'Taxes', array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-3">
        <?php echo Form::text('exp_taxes', $residency->exp_taxes,
            array('id' => 'exp_taxes', 'class' => 'form-control')); ?>

    </div>
</div>
    <div class="form-group">
        <?php echo Form::label('exp_room_and_board', 'Room and Board', array('class' => 'col-sm-3 control-label')); ?>

        <div class="col-sm-3">
            <?php echo Form::text('exp_room_and_board', $residency->exp_room_and_board,
                array('id' => 'exp_room_and_board', 'class' => 'form-control')); ?>

        </div>
    </div>

<div class="form-group">
    <?php echo Form::label('exp_fire_insurance', 'Fire Insurance', array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-3">
        <?php echo Form::text('exp_fire_insurance', $residency->exp_fire_insurnace,
                    array( 'id' => 'exp_fire_insurance', 'class' => 'form-control' ) ); ?>

    </div>

</div>

<div class="form-group">
    <?php echo Form::label('exp_mortgage', 'Mortgage', array( 'class' => 'control-label col-sm-3')); ?>
    <div class="col-sm-3">
        <?php echo Form::text('exp_mortgage', $residency->mortgage,
            array('id' => 'exp_mortgage',  'class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo Form::label('exp_fuel', 'Fuel', array( 'class' => 'col-sm-3 control-label' )); ?>
    <div class="col-sm-3">
        <?php echo Form::text('exp_fuel', $residency->fuel,
                                array( 'id' => 'exp_fuel', 'class' => 'form-control' )); ?>

    </div>
</div>

    <hr class="panel-wide">

<div class="form-group">
    <?php echo Form::label('assets_of_value', 'Assets of Value', array( 'class' => 'col-sm-3 control-label' )); ?>

    <div class="col-sm-6">
        <?php echo Form::textarea('assets_of_value', $residency->assets_of_value,
            array('id' => 'assets_of_value', 'class' => 'form-control', 'placeholder' => 'Specify asset and approximate value')); ?>

    </div>
</div>

    <div class="form-group">
        <?php echo Form::label('sources_of_income', 'Sources of Income', array( 'class' => 'col-sm-3 control-label' )); ?>

        <div class="col-sm-6">
            <?php echo Form::textarea('sources_of_income', $residency->sources_of_income,
                array('id' => 'sources_of_income', 'class' => 'form-control', 'placeholder' => 'Identify source and amount')); ?>

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
        <li>
            <a tabindex="-1" href="{{ route('intake-contacts', $resident->id) }}"><span class="mm-text">Emergency Contacts</span></a>
        </li>
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Financial Details</span></a>
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
            <a tabindex="-1" href="#"><span class="mm-text">Cancel Intake</span></a>
        </li>
    </ul>
</li>
@stop