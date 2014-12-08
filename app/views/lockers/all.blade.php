@extends('layouts.master')


@section('body-tag')
<body class="theme-clean main-menu-right page-search">
@stop

@section('page')




<div class="page-header">
    <h1><i class="fa fa-building page-header-icon"></i>&nbsp;&nbsp;LOCKERS</h1>
</div> <!-- / .page-header -->


<!-- Panel -->
<div class="panel">




<div class="panel-body">




@foreach( Lockerroom::active()->ordered()->get() as $lockerroom )


    <div class="row">


<a name="lockerroom{{ $lockerroom->id }}"></a>
                <div class="stat-panel">
                    <div class="stat-row">
                        <!-- Success darker background -->
                        <div class="stat-cell darker">
                            <!-- Stat panel bg icon -->
                            <i class="fa fa-lock bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                            <!-- Big text -->
                            <span class="text-bg">{{{ $lockerroom->name }}}</span><br>
{{--                            <!-- Small text -->
                            <span class="text-sm">{{{ $lockerroom->id }}}</span>
                            --}}
                        </div>
                    </div> <!-- /.stat-row -->



                    <div class="stat-row">
                        <!-- Success background, without bottom border, without padding, horizontally centered text -->
                        <div class="stat-counters bg-default no-border-b no-padding text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $lockerroom->occupied->count() }}</strong> / {{ $lockerroom->lockers->count() }}</span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Locker::$states[ LOCKERSTATUS_OCCUPIED ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $lockerroom->dirty->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Locker::$states[ LOCKERSTATUS_DIRTY ] }}</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>{{ $lockerroom->vacant->count() }}</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs">{{ Locker::$states[ LOCKERSTATUS_VACANT ] }}</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->

    @foreach( range( 1, $lockerroom->rows ) as $row )
                    <div class="stat-row">

                        <div class="stat-counters bordered no-border-t no-padding text-center">

    @foreach( $lockerroom->row($row) as $locker )

                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-1 padding-sm no-padding-hr  {{ Locker::$stateBackgroundClass[ $locker->status ] }}">
                                <!-- Big text -->
                                <button class="btn btn-small" data-toggle="modal" data-target="#lockerup-{{ $locker->id }}">{{ $locker->name }}</button>

                                <br /><span class="text-bg">
                                        @if( $locker->resident )
                                            <strong><a href="{{ route('resident',$locker->resident->id) }}">{{ $locker->resident->display_name }}</a></strong>
                                        @endif
                                </span><br />
                                <!-- Extra small text -->
                                <span class="text-xs">{{ $locker->status }}</span>



                            </div>




    @endforeach


                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->
    @endforeach

                </div> <!-- /.stat-panel -->
                <!-- /11. $EXAMPLE_ACCOUNT_OVERVIEW -->



    </div>
@endforeach




@foreach( Locker::occupied()->get() as $locker )



<div id="lockerup-{{ $locker->id}}" class="modal modal-alert   fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <i class="fa fa-lock"></i>
            </div>
            <div class="modal-title">Locker {{ $locker->name }}</div>
            <div class="modal-body">
                {{ $locker->resident }}
            </div>
            <div class="modal-footer">
                @if( $locker->lock )
                {{ $locker->lock }}
                @else
                No lock is assigned.
                @endif
            </div>

        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

@endforeach

@foreach( Locker::dirty()->get() as $locker )



    <div id="lockerup-{{ $locker->id}}" class="modal modal-alert  fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <i class="fa fa-paint-brush"></i>
                </div>
                <div class="modal-title">Locker {{ $locker->name }} needs cleaning</div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    {{ Form::open(array('route' => array('locker-clean'))) }}
                    {{ Form::hidden('lockerId', $locker->id) }}
                    {{ Form::submit('I cleaned it!', array('class' => 'btn btn-success', 'data-dismiss' => 'modal')) }}

                    {{ Form::close() }}
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>

@endforeach

@foreach( Locker::vacant()->get() as $locker )


    <div id="lockerup-{{ $locker->id}}" class="modal modal-alert modal-info  fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <i class="fa fa-sign-in"></i>
                </div>
                <div class="modal-title">Assign Locker {{ $locker->name }}</div>
                <div class="modal-body">

<?php
// If there are no un-lockered residents, lets just say so
// If there are, let's show their names and dob
$unLockered = Resident::current()->noLocker()->get();
$options = array();
foreach($unLockered as $r)
    $options[ $r->id ] = "{$r->display_name} &nbsp; ({$r->date_of_birth})";
?>

@if( count($unLockered) )
                    {{ Form::open(array('route' => array('locker-assign'))) }}
                    {{ Form::hidden('lockerId', $locker->id) }}

                    {{ Form::label('residentId', 'Choose a resident who currently has no locker:' ) }}
                    {{ Form::select('residentId', $options, array('class' => "form-control" )) }}

                </div>


                <div class="modal-footer">

                    {{ Form::submit('Make it so!', array('class' => 'btn btn-success', 'data-dismiss' => 'modal')) }}

                    {{ Form::close() }}

@else
                    <em>Looks like all current residents already have a locker.</em>
@endif
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>


@endforeach



</div>


</div>
<!-- / Panel -->




@stop



