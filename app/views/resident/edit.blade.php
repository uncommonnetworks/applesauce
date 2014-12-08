
<!-- Javascript -->
<script>




</script>
<!-- / Javascript -->




{{ Form::open(array('url' => "resident/edit/form/{$resident->id}", 'class'=>'form-horizontal', 'id' => 'edit-form')) }}
{{ Form::hidden('id', $resident->id) }}



<div class="panel-heading bordered no-border-b">
    <span class="panel-title">Personal Info for {{ $resident->display_name }}</span>
</div>
<div class="panel-body bordered" id="edit-contacts">



<div class="form-group">
    {{ Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('first_name', $resident->first_name, ['id' => 'first_name', 'class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('first_name', 'Middle Name', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('middle_name', $resident->middle_name, ['id' => 'middle_name', 'class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('first_name', 'Last Name', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-6">
        {{ Form::text('last_name', $resident->last_name, ['id' => 'last_name', 'class' => 'form-control']) }}
    </div>
</div>







<div class="form-group">
    <?php echo Form::label('goes_by_name', 'Goes By', array('class' => 'col-sm-3 control-label')); ?>

    <div class="col-sm-3">
        <?php echo Form::text('goes_by_name', $resident->goes_by_name, array('id' => 'goes_by_name', 'class' => 'form-control')); ?>
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
</div>

<div class="panel-heading bordered no-border-b">
    <span class="panel-title">Emergency/Medical Info for {{ $resident->display_name }}</span>
</div>
<div class="panel-body bordered" id="edit-contacts">






        <div class="form-group">
            {{ Form::label('contact_name', 'Emergency Contact Name', array('class' => 'col-sm-3 control-label')); }}

            <div class="col-sm-6">
                {{--<a id="edit-contact_name" class="editable-click" href="#" data-name="contact_name">{{ $resident->contact_name }}</a>--}}
                {{ Form::text('contact_name', $resident->contact_name, ['id' => 'contact_name', 'class' => 'form-control']) }}


            </div>
        </div>
        <div class="form-group">

            {{ Form::label('contact_relationship', 'Relationship to ' . $resident->first_name, ['class' => 'col-sm-3 control-label']) }}

            <div class="col-sm-6">
                {{--<a id="edit-contact_relationship" class="editable-click" href="#" data-name="contact_relationship">{{ $resident->contact_relationship }}</a>--}}
                {{ Form::text('contact_relationship', $resident->contact_relationship, ['id' => 'contact_relationship', 'class' => 'form-control']) }}

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


</div>





<hr />

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?php echo Form::button('Save Changes', array( 'class' => 'btn btn-lg btn-info', 'type' => 'submit' )); ?>
        <!--        <button type="submit" class="btn btn-primary">Save and Continue Intake <i class="fa fa-sign-in"></i></button>-->
    </div>
</div>
<?php echo Form::close(); ?>






<script>


    $("#resallergies").select2({tags:["{{ implode('","',Allergy::lists('name','id')) }}"]});

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

</script>
{{--

<script>


    $('#edit-contacts').editable({
        ajaxOptions: { 'type': 'POST' },
        selector: 'a',
        url: '/resident/edit/contacts/{{ $resident->id }}',
        pk: "{{ $resident->id }}",
        placement: 'right',
        mode: 'inline',
        success: function(response, newValue) {
            if(response.success)
                $()
            else
                return response.msg;
        }
    });

    $('#edit-contact_name').on('save', function( e, params ) {
        $('#resident-contact_name').text(params.newValue);
        $('#resident-contact_name').attr('data-title', params.newValue + " (" + $('#resident-contact_name').text() + ")");

    });

    $('#edit-contact_relationship').on('save', function( e, params ) {
//        $('#resident-contact_name').data('bs-popover').options.title = $('#resident-contact_name').text() + " (" + params.newValue+ ")";
        $('#resident-contact_name').popover({ title: 'hello, world' });
    });




</script>
--}}