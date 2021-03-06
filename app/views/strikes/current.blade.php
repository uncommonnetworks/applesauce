@extends('layouts.master')

@section('title')
  Strikes
@stop


@section('body-tag')
<body class="theme-clean main-menu-right page-search">
@stop

@section('page')




<div class="page-header">
    <h1><i class="fa fa-building page-header-icon"></i>&nbsp;&nbsp;STRIKES</h1>
</div> <!-- / .page-header -->




<!-- Panel -->
<div class="panel">

<script>
    init.push(function () {
        $('table button').popover();
    });
</script>


<div class="panel-body">

        <div class="pane-body">


        <div class="row">


            <div class="col-md-7">
                <div class="panel panel-dark panel-danger">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa {{ Note::$flagIcon[NOTEFLAG_STRIKE] }}"></i>Strikes</span>
                        <div class="panel-heading-controls">
                            <a href="{{ route('note-new', NOTEFLAG_STRIKE) }}"><button type="button" class="btn btn-sm btn-success">+ ADD</button></a>
                        </div> <!-- / .panel-heading-controls -->
                    </div> <!-- / .panel-heading -->
@include('strikes.list', ['strikes' => Strike::current()->get(), 'showResident' => true ])

                </div> <!-- / .panel -->
            </div>
            <!-- /12. $NEW_USERS_TABLE -->

            <!-- 13. $RECENT_TASKS =============================================================================

                        Recent tasks
            -->
            <div class="col-md-5">

                <div class="panel widget-tasks panel-dark-gray">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i>Recent tasks</span>
                        <div class="panel-heading-controls">
                            <button class="btn btn-xs btn-primary btn-outline dark" ><i class="fa fa-eraser text-success"></i> bleh</button>
                        </div>
                    </div> <!-- / .panel-heading -->
                    <?php /*
                <!-- Without vertical padding -->
                <div class="panel-body no-padding-vr ui-sortable">

                    <div class="task">
                        <span class="label label-warning pull-right">High</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A very important task<span>1 hour left</span></a>
                    </div> <!-- / .task -->

                    <div class="task completed">
                        <span class="label label-warning pull-right">High</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px" checked="checked"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A very important task<span>58 minutes left</span></a>
                    </div> <!-- / .task -->

                    <div class="task completed">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px" checked="checked"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <span class="label pull-right">Low</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">An unimportant task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <span class="label pull-right">Low</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">An unimportant task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <span class="label pull-right">Low</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">An unimportant task</a>
                    </div> <!-- / .task -->
                </div> <!-- / .panel-body --> */ ?>
                </div> <!-- / .panel -->
            </div>
            <!-- /13. $RECENT_TASKS -->

        </div>



        <div class="row">

            <script>
                init.push(function () {
                    $('#warnings-list .panel-body > div').slimScroll({ height: 250, alwaysVisible: true, color: '#888',allowPageScroll: true });
                })
            </script>
            <div class="col-md-7">
                <div class="panel panel-dark panel-light-green widget-comments" id="warnings-list">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa fa-smile-o"></i>Warnings</span>
                        <div class="panel-heading-controls">
                            <a href="{{ route('note-new', NOTEFLAG_WARNING) }}"><button type="button" class="btn btn-sm btn-success">+ ADD</button></a>
                        </div> <!-- / .panel-heading-controls -->
                    </div> <!-- / .panel-heading -->


                    @include('notes.list', array('notes' => Note::ofType(NOTETYPE_SHIFT)->withFlag(NOTEFLAG_WARNING)->get()))


                </div> <!-- / .panel -->
            </div>
            <!-- /12. $NEW_USERS_TABLE -->

            <!-- 13. $RECENT_TASKS =============================================================================

                        Recent tasks
            -->
            <div class="col-md-5">

                <div class="panel widget-tasks panel-dark-gray">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i>Recent tasks</span>
                        <div class="panel-heading-controls">
                            <button class="btn btn-xs btn-primary btn-outline dark" ><i class="fa fa-eraser text-success"></i> bleh</button>
                        </div>
                    </div> <!-- / .panel-heading -->
                    <?php /*
                <!-- Without vertical padding -->
                <div class="panel-body no-padding-vr ui-sortable">

                    <div class="task">
                        <span class="label label-warning pull-right">High</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A very important task<span>1 hour left</span></a>
                    </div> <!-- / .task -->

                    <div class="task completed">
                        <span class="label label-warning pull-right">High</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px" checked="checked"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A very important task<span>58 minutes left</span></a>
                    </div> <!-- / .task -->

                    <div class="task completed">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px" checked="checked"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <span class="label pull-right">Low</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">An unimportant task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <span class="label pull-right">Low</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">An unimportant task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">A regular task</a>
                    </div> <!-- / .task -->

                    <div class="task">
                        <span class="label pull-right">Low</span>
                        <div class="fa fa-arrows-v task-sort-icon"></div>
                        <div class="action-checkbox">
                            <label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label>
                        </div>
                        <a href="#" class="task-title">An unimportant task</a>
                    </div> <!-- / .task -->
                </div> <!-- / .panel-body --> */ ?>
                </div> <!-- / .panel -->
            </div>
            <!-- /13. $RECENT_TASKS -->

        </div>



        </div>




</div>


</div>
<!-- / Panel -->




@stop