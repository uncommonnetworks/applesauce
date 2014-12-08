<div class="panel-heading bordered no-border-b">
    <span class="panel-title">Identification: Photo for {{ $resident->display_name }}</span>
</div>
<div class="panel-body bordered">

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
                //                    init.push(function () {
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
                //                    });


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