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


        $.validator.addMethod(
            "min_age",
            function(value, element) {


                    var today = new Date();
                    var numbers = value.split("/");
                    if(numbers.length != 3)
                        return false;

                    var birthday = new Date(numbers[2],numbers[1]-1,numbers[0],0,0,0,0);
//
//                    var age = today.getFullYear() - birthDate.getFullYear();
//                    var m = today.getMonth() - birthDate.getMonth();
//                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
//                        age--;
//                    }


                     // don't think about this too hard... it works.
                     var age = (
                     (today.getMonth() > birthday.getMonth())
                     ||
                     (today.getMonth() == birthday.getMonth() && today.getDate() >= birthday.getDate())
                     ) ? today.getFullYear() - birthday.getFullYear() : today.getFullYear() - birthday.getFullYear()-1;

                    // return age;


                return age >= <?php echo RESIDENT_AGEMIN; ?>
            },
            "New residents must be at least <?php echo RESIDENT_AGEMIN; ?>"
        );

        // Setup validation
        $("#jq-validation-form").validate({

            focusInvalid: false,
            rules: {
                'first_name': {
                    required: true,
                    minlength: 1
                },


                'last_name': {
                    required: false,
                    minlength: 2
                },

                'date_of_birth': {
                    required: true,
                    dateITA: true,
                    min_age: true

                },

                'gender': {
                    required: true
                },

                // three number, 100-999, separated by space, hypen, or period
                'sin': {
                    required: false,
                    pattern: "[1-9][0-9][0-9][- \.]?[0-9][0-9][0-9][- \.]?[0-9][0-9][0-9]"
                }
            }
        });
    });
</script>
<!-- / Javascript -->

<div class="panel">
<div class="panel-heading">
    <span class="panel-title">Basic Intake Questions</span>
</div>
<div class="panel-body">
<!--<div class="note note-info">&nbsp;</div>-->

<?php echo Form::open(array('action' => 'IntakeController@intakeBegin', 'class'=>'form-horizontal', 'id' => 'jq-validation-form')); ?>

<?php echo Form::hidden('id', $resident->id); ?>
<div class="form-group">
<!--    <div class="col-sm-2">-->
<!--        <?php //echo Form::select('title', Resident::$titleOptions, PERSONTITLE_MR, array('class'=>'form-control')); ?> -->
<!--    </div>-->
    <div class="col-sm-4">
        <?php echo Form::text('first_name', $resident->first_name, array('id'=>'first_name', 'class' =>'form-control', 'placeholder' => 'First Name')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo Form::text('middle_name', $resident->middle_name, array('id'=>'middle_name', 'class' =>'form-control', 'placeholder' => 'Middle Name')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo Form::text('last_name', $resident->last_name, array('id'=>'last_name', 'class' =>'form-control', 'placeholder' => 'Last Name')); ?>
    </div>
</div>


<hr class="panel-wide">


<div class="form-group">
    <?php echo Form::label('goes_by_name', 'Goes By', array('class' => 'col-sm-3 control-label')); ?>
<!--    <label for="jq-validation-password" class="col-sm-2 control-label">Password</label>-->
    <div class="col-sm-3">
        <?php echo Form::text('goes_by_name', $resident->goes_by_name, array('id' => 'goes_by_name', 'class' => 'form-control')); ?>
<!--        <input type="password" class="form-control" id="jq-validation-password" name="jq-validation-password" placeholder="Password">-->

    </div>
</div>
<div class="form-group">
    {{ Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label')) }}
    <div class="col-sm-3">
        {{ Form::radio('gender', 'M', $resident->gender == 'M') }} Male <br />
        {{ Form::radio('gender', 'F', $resident->gender == 'F') }} Female
    </div>
</div>
<div class="form-group">
    <?php echo Form::label('date_of_birth', 'Date of Birth', array('class' => 'col-sm-3 control-label')); ?>
    <!--    <label for="jq-validation-password" class="col-sm-2 control-label">Password</label>-->
    <div class="col-sm-3">
        <?php echo Form::text('date_of_birth', $resident->date_of_birth_dmy,
                    array( 'id' => 'date_of_birth', 'class' => 'form-control', 'placeholder' => 'DD/MM/YYYY' ) ); ?>
<!--        --><?php //echo Form::text('date_of_birth', $resident->, array('id' => 'goes_by_name', 'class' => 'form-control')); ?>
<!--        <a  id="dob" data-type="combodate" --><?php //if( $resident->date_of_birth ) echo 'data-value="' . $resident->date_of_birth . '"'; ?>
<!--           data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"-->
<!--           data-title="Select Date of birth" class="editable editable-click" data-original-title="" title="Enter Date of Birth">--><?php //echo $resident->date_of_birth; ?><!--</a>-->
        <!--        <input type="password" class="form-control" id="jq-validation-password" name="jq-validation-password" placeholder="Password">-->
<!--        --><?php //echo Form::hidden('date_of_birth', $resident->dob); ?>
        <p class="help-block">Enter the birth date as DD/MM/YYYY.</p>
    </div>

</div>

<div class="form-group hidden" id="age-hider">
    <?php echo Form::label('age', 'Age: ', array( 'class' => 'control-label col-sm-3')); ?>
    <div class="col-sm-3">
        <?php echo Form::text('age', $resident->age, array('id' => 'age',  'class' => 'form-control', 'disabled' => 'true')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo Form::label('marital_status', 'Marital Status', array( 'class' => 'col-sm-3 control-label' )); ?>
<!--    <label for="jq-validation-select2" class="col-sm-3 control-label">Select2</label>-->
    <div class="col-sm-3">
        <?php echo Form::select('marital_status', Resident::$maritalStatusOptions, $resident->marital_status,
                                array( 'class' => 'form-control' )); ?>

    </div>
</div>

<div class="form-group">
    <?php echo Form::label('sin', 'Social Insurance Number', array( 'class' => 'col-sm-3 control-label' )); ?>
    <!--    <label for="jq-validation-select2" class="col-sm-3 control-label">Select2</label>-->
    <div class="col-sm-3">
        <?php echo Form::text('sin', $resident->sin, array('id' => 'sin', 'class' => 'form-control')); ?>

    </div>
</div>

<div class="form-group">
    <?php echo Form::label('health_card_number', 'Health Card Number', array( 'class' => 'col-sm-3 control-label' )); ?>
    <!--    <label for="jq-validation-select2" class="col-sm-3 control-label">Select2</label>-->
    <div class="col-sm-3">
        <?php echo Form::text('health_card_number', $resident->health_card_number,
            array( 'class' => 'form-control' )); ?>

    </div>
</div>


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

/*
    init.push(function () {
        $('#dob').editable({
            combodate: {
                minYear: <?php echo Resident::getDobMinYear(); ?>,
                maxYear: <?php echo Resident::getDobMaxYear(); ?>,
                smartDays: true,
                required: true,
            },
            validate: function(value){ return value ? false : 'this field is required' },

            success: function(response, newValue) {
                $('#date_of_birth').val(newValue);
                $('#age').val(calculateAge(newValue));
            }
        });
    });
*/

    var calculateAge = function(dob) {
        var today = new Date();
        var birthday = new Date(dob);

        // don't think about this too hard... it works.
        var age = (
            (today.getMonth() > birthday.getMonth())
                ||
                (today.getMonth() == birthday.getMonth() && today.getDate() >= birthday.getDate())
            ) ? today.getFullYear() - birthday.getFullYear() : today.getFullYear() - birthday.getFullYear()-1;

        return age;
    };
//
//    $('#jq-validation-form').submit(function(){
//        if(! $('#age').val )
//        {
//            alert( 'You must specify the date of birth to continue.');
//            return false;
//        }
//        return true;
//    });

</script>
@stop


@section('context-menu')

<li class="mm-dropdown open active">
    <a href="#"><i class="menu-icon fa fa-sign-in"></i><span class="mm-text">INTAKE</span><span class="label label-info">in-progress</span></a>
    <ul>
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Name &amp; ID</span></a>
        </li>
@if( $resident )
        <li>
            <a tabindex="-1" href="{{ route('intake-bed', $resident->id) }}"><span class="mm-text">Bed</span></a>
        </li>
@endif

        <li>
            <a tabindex="-1" href="#"><span class="mm-text">Cancel Intake</span></a>
        </li>
    </ul>
</li>

@stop