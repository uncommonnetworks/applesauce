@extends('layouts.master')


@section('body-tag')
<body class="theme-clean main-menu-right page-search">
@stop

@section('page')




<div class="page-header">
    <h1><i class="fa fa-building page-header-icon"></i>&nbsp;&nbsp;BEDDING</h1>
</div> <!-- / .page-header -->


<!-- Tabs -->
<div class="search-tabs">
    <ul class="nav nav-tabs">

        <li class="active">
            <a href="#bedding-tab-all" data-toggle="tab">All <span class="label label-success">{{ Bed::vacant()->count() }}  / {{ Bed::count() }}</span></a>
        </li>
        <li>
            <a href="#bedding-tab-men" data-toggle="tab">Male <span class="label label-success">{{ Bed::vacant()->men()->count() }}  / {{ Bed::men()->count() }}</span></a>
        </li>
        <li>
            <a href="#bedding-tab-women" data-toggle="tab">Female <span class="label label-success">{{ Bed::vacant()->women()->count() }} / {{ Bed::women()->count() }}</span></a>
        </li>

    </ul> <!-- / .nav -->
</div>
<!-- / Tabs -->

<!-- Panel -->
<div class="panel">




<div class="panel-body tab-content">


<!-- ALL tab -->
    <div class="tab-pane fade in active" id="bedding-tab-all">


        <div class="pane-body">


@foreach( Bedroom::active()->ordered()->get() as $i => $bedroom )

{{-- new row every 3 rooms --}}
    @if( $i % 3 == 0 )
            <div class="row">
    @endif

            <div class="col-sm-4">


<a name="bedroom{{ $bedroom->id }}"></a>

                <div class="stat-panel">
                    <div class="stat-row">
                        <!-- Success darker background -->
                        <div class="stat-cell  darker">
                            <!-- Stat panel bg icon -->
                            <i class="fa fa-{{ $bedroom->gender }} bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                            <!-- Big text -->
                            <span class="text-bg">{{{ $bedroom->name }}}</span><br>
{{--                            <!-- Small text -->
                            <span class="text-sm">{{{ $bedroom->id }}}</span>
                            --}}
                        </div>
                    </div> <!-- /.stat-row -->



                    <div class="stat-row">
                        <!-- Success background, without bottom border, without padding, horizontally centered text -->
                        <div class="stat-counters bg-default no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->occupied->count() }}</strong> / {{ $bedroom->beds->count() }}</span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_OCCUPIED ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->notready->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_NOTREADY ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->vacant->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_VACANT ] }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->

    @foreach( $bedroom->beds as $bed )


        <?php
            $background = $bed->resident && $bed->resident->status == RESIDENTSTATUS_OWP ?
                Resident::$stateBackgroundClass[ RESIDENTSTATUS_OWP ] :
                Bed::$stateBackgroundClass[ $bed->status ];
?>
                    <div class="stat-row">

                        <div class="stat-counters bordered  no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-1 padding-sm no-padding-hr  {{ $background }}">
                                <!-- Big text -->
                                <button class="btn btn-small " data-toggle="modal" data-target="#bedhistory-{{ $bed->id }}">{{ $bed->name }}</button>

        @if( $bed->status == BEDSTATUS_VACANT )
                                <a title="Begin Intake" class="btn btn-success btn-xs" href="{{ route('intake-begin') }}"><i class="fa fa-sign-in"></i></a>
        @endif
                                <br /><span class="text-bg">

                                        @if( $bed->resident )
                                            <strong><a href="{{ route('resident',$bed->resident->id) }}">{{ $bed->resident->display_name }}</a></strong>
                                        @endif
                                </span><br />
                                <!-- Extra small text -->
                                <span class="text-xs">{{ $bed->status }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->

                        @if( $bed->divider )

                        <hr />
                        @endif

                    </div> <!-- /.stat-row -->





    @endforeach
                </div> <!-- /.stat-panel -->
                <!-- /11. $EXAMPLE_ACCOUNT_OVERVIEW -->


            </div> <!-- /. col-4 -->


    @if( $i % 3 == 2 )
        </div>
    @endif

@endforeach

        </div>

    </div>
    <!-- / ALL tab -->



    <!-- MALE tab -->

    <div class="tab-pane fade in" id="bedding-tab-men">


        <div class="pane-body">


            @foreach( Bedroom::active()->male()->get() as $bedroom )

            <div class="col-sm-4">



                <div class="stat-panel">
                    <div class="stat-row">
                        <!-- Success darker background -->
                        <div class="stat-cell bg-info darker">
                            <!-- Stat panel bg icon -->
                            <i class="fa fa-{{ $bedroom->gender }} bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                            <!-- Big text -->
                            <span class="text-bg">{{{ $bedroom->name }}}</span><br>
                            <!-- Small text -->
                            <span class="text-sm">{{{ $bedroom->id }}}</span>
                        </div>
                    </div> <!-- /.stat-row -->



                    <div class="stat-row">
                        <!-- Success background, without bottom border, without padding, horizontally centered text -->
                        <div class="stat-counters bg-success no-border-b no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->occupied->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_OCCUPIED ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->notready->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_NOTREADY ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->vacant->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_VACANT ] }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->

                    @foreach( $bedroom->beds as $bed )

                    <div class="stat-row">
                        <!-- Success background, without bottom border, without padding, horizontally centered text -->
                        <div class="stat-counters no-border-b no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-10 col-xs-offset-1 padding-sm no-padding-hr  {{ Bed::$stateBackgroundClass[ $bed->status ] }}">
                                <!-- Big text -->
                                <span class="text-bg">
                                        @if( $bed->residency )
                                            <strong><a href="#">{{ $bed->residency->resident->display_name }}</a></strong><br />
                                        @endif
                                    {{ $bed->name }}
                                </span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ $bed->status }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->



                    @endforeach
                </div> <!-- /.stat-panel -->
                <!-- /11. $EXAMPLE_ACCOUNT_OVERVIEW -->


            </div> <!-- /. col-4 -->
            @endforeach

        </div>

    </div>



    <!-- FEMALE tab -->

    <div class="tab-pane fade in" id="bedding-tab-women">


        <div class="pane-body">


            @foreach( Bedroom::active()->female()->get() as $bedroom )

            <div class="col-sm-4">



                <div class="stat-panel">
                    <div class="stat-row">
                        <!-- Success darker background -->
                        <div class="stat-cell bg-danger darker">
                            <!-- Stat panel bg icon -->
                            <i class="fa fa-{{ $bedroom->gender }} bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                            <!-- Big text -->
                            <span class="text-bg">{{{ $bedroom->name }}}</span><br>
                            <!-- Small text -->
                            <span class="text-sm">{{{ $bedroom->id }}}</span>
                        </div>
                    </div> <!-- /.stat-row -->



                    <div class="stat-row">
                        <!-- Success background, without bottom border, without padding, horizontally centered text -->
                        <div class="stat-counters bg-success no-border-b no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->occupied->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_OCCUPIED ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->notready->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_NOTREADY ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $bedroom->vacant->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Bed::$states[ BEDSTATUS_VACANT ] }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->

                    @foreach( $bedroom->beds as $bed )

                    <div class="stat-row">
                        <!-- Success background, without bottom border, without padding, horizontally centered text -->
                        <div class="stat-counters no-border-b no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-10 col-xs-offset-1 padding-sm no-padding-hr  {{ Bed::$stateBackgroundClass[ $bed->status ] }}">
                                <!-- Big text -->
                                <span class="text-bg">
                                        @if( $bed->residency )
                                            <strong><a href="#">{{ $bed->residency->resident->display_name }}</a></strong><br />
                                        @endif
                                    {{ $bed->name }}
                                </span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ $bed->status }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->



                    @endforeach
                </div> <!-- /.stat-panel -->
                <!-- /11. $EXAMPLE_ACCOUNT_OVERVIEW -->


            </div> <!-- /. col-4 -->
            @endforeach

        </div>

    </div>




</div>


</div>
<!-- / Panel -->


@foreach( Bed::vacant()->get() as $bed )
<div id="bedhistory-{{ $bed->id}}" class="modal modal-alert modal-info fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-book"></i>
            </div>
            <div class="modal-title">Bed History: {{ $bed->name }}</div>
            <div class="modal-body">// TODO: Display bed history</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
@endforeach


@foreach( Bed::occupied()->get() as $bed )
<div id="bedhistory-{{ $bed->id}}" class="modal modal-alert modal-info fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <i class="fa fa-book"></i>
            </div>
            <div class="modal-title">Bed History: {{ $bed->name }}</div>
            <div class="modal-body">// TODO: Display bed history</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
@endforeach


@foreach( Bed::notready()->get() as $bed )
<div id="bedhistory-{{ $bed->id}}" class="modal modal-alert modal-info fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <i class="fa fa-paint-brush"></i>
            </div>
            <div class="modal-title">Bed {{ $bed->name }} needs stripping</div>
            <div class="modal-body">

                {{ Form::open(array('route' => array('bed-clean'))) }}
                {{ Form::hidden('bedId', $bed->id) }}
                {{ Form::submit('I stripped it!', array('class' => 'btn btn-success', 'data-dismiss' => 'modal')) }}

                {{ Form::close() }}

            </div>
            <div class="modal-footer">
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
@endforeach





@stop