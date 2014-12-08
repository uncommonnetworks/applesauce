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



<?php if( $resident->sin ): ?>

    <div class="panel">

        <div class="panel-heading">
            <span class="panel-title">Identification: SIN Card ({{{ $resident->sin }}})</span>
        </div>
        <div class="panel-body">



            <div class="form-group">


                <div class="col-sm-4">
                    <?php if( $resident->idSin ) echo $resident->idSin->getPictureImg( 'style="height: 278px"'); ?>
                </div>
                <div class="col-sm-6">


                    <!-- 14. $DROPZONEJS_FILE_UPLOADS ==================================================================

                                    Dropzone.js file uploads
                    -->
                    <!-- Javascript -->
                    <script>
                        init.push(function () {
                            $("#dropzonejs-sin").dropzone({
                                url: "/upload-resident-sin/{{ $resident->id }}/{{{ $resident->sin }}}",
                                paramName: "file", // The name that will be used to transfer the file
                                maxFilesize: 5, // MB

                                addRemoveLinks : true,
                                dictResponseError: "Can't upload file!",
                                autoProcessQueue: true,
                                thumbnailWidth: 800,
                                thumbnailHeight: 600,
                                maxFiles: 1,
                                acceptedFiles: "image/*",

                                previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

                            });
                        });


                    </script>
                    <!-- / Javascript -->

                    <div id="dropzonejs-sin" class="dropzone-box">
                        <div class="dz-default dz-message">
                            <i class="fa fa-cloud-upload"></i>
                            Drop files in here<br><span class="dz-text-small">or click to pick manually</span>
                        </div>
                        <form action="/upload-resident-sin/<?php echo $resident->id; ?>">

                        </form>
                    </div>
                </div>
            </div>
            <!-- /14. $DROPZONEJS_FILE_UPLOADS -->


        </div>
    </div>


<?php endif; ?>
<?php if( $resident->health_card_number ): ?>

    <div class="panel">

        <div class="panel-heading">
            <span class="panel-title">Identification: Health Card ({{{ $resident->health_card_number }}})</span>
        </div>
        <div class="panel-body">



            <div class="form-group">


                <div class="col-sm-4">
                    <?php if( $resident->idHealth ) echo $resident->idHealth->getPictureImg( 'style="height: 278px"'); ?>
                </div>
                <div class="col-sm-6">


                    <!-- 14. $DROPZONEJS_FILE_UPLOADS ==================================================================

                                    Dropzone.js file uploads
                    -->
                    <!-- Javascript -->
                    <script>
                        init.push(function () {
                            $("#dropzonejs-healthcard").dropzone({
                                url: "/upload-resident-healthcard/{{ $resident->id }}/{{{ $resident->health_card_number }}}",
                                paramName: "file", // The name that will be used to transfer the file
                                maxFilesize: 5, // MB

                                addRemoveLinks : true,
                                dictResponseError: "Can't upload file!",
                                autoProcessQueue: true,
                                thumbnailWidth: 800,
                                thumbnailHeight: 600,
                                maxFiles: 1,
                                acceptedFiles: "image/*",

                                previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

                            });
                        });


                    </script>
                    <!-- / Javascript -->

                    <div id="dropzonejs-healthcard" class="dropzone-box">
                        <div class="dz-default dz-message">
                            <i class="fa fa-cloud-upload"></i>
                            Drop files in here<br><span class="dz-text-small">or click to pick manually</span>
                        </div>
                        <form action="/upload-resident-healthcard/<?php echo $resident->id; ?>">

                        </form>
                    </div>
                </div>
            </div>
            <!-- /14. $DROPZONEJS_FILE_UPLOADS -->

        </div>
    </div>





<?php endif; ?>




<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Identification: Photo</span>
    </div>
    <div class="panel-body">

        <div class="form-group">

            <div class="col-sm-4">
                <?php echo $resident->getPictureImg( 'style="height: 278px"'); ?>
            </div>
            <div class="col-sm-6">


                <!-- 14. $DROPZONEJS_FILE_UPLOADS ==================================================================

                                Dropzone.js file uploads
                -->
                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $("#dropzonejs-photo").dropzone({
                            url: "/upload-resident-photo/{{ $resident->id }}",
                            paramName: "file", // The name that will be used to transfer the file
                            maxFilesize: 5, // MB

                            addRemoveLinks : true,
                            dictResponseError: "Can't upload file!",
                            autoProcessQueue: true,
                            thumbnailWidth: 800,
                            thumbnailHeight: 600,
                            maxFiles: 1,
                            acceptedFiles: "image/*",

                            previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

                        });
                    });


                </script>
                <!-- / Javascript -->

                <div id="dropzonejs-photo" class="dropzone-box">
                    <div class="dz-default dz-message">
                        <i class="fa fa-cloud-upload"></i>
                        Drop files in here<br><span class="dz-text-small">or click to pick manually</span>
                    </div>
                    <form action="/upload-resident-photo/{{ $resident->id }}">

                    </form>
                </div>
            </div>
        </div>
        <!-- /14. $DROPZONEJS_FILE_UPLOADS -->

    </div> <!-- panel-body -->
</div> <!-- panel -->





<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {{ Form::open(array('action' => 'IntakeController@intakeFinish', 'method' => 'post')) }}
        {{ Form::hidden('id', $resident->id) }}
        {{ Form::button('Complete Intake <i class="fa fa-sign-in"></i>', array( 'class' => 'btn btn-lg btn-info', 'type' => 'submit' )) }}
        {{ Form::close() }}
    </div>
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
        <li>
            <a tabindex="-1" href="{{ route('intake-money', $resident->id) }}"><span class="mm-text">Financial Details</span></a>
        </li>
        <li>
            <a tabindex="-1" href="{{ route('intake-notes', $resident->id) }}"><span class="mm-text">Notes</span></a>
        </li>
        <li class="active">
            <a tabindex="-1" href="#"><span class="mm-text">Pictures</span></a>
        </li>
        <li>
            <a tabindex="-1" href="#"><span class="mm-text">Cancel Intake</span></a>
        </li>
    </ul>
</li>
@stop