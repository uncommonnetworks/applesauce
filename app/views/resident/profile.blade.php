@extends('layouts.master')


@section('body-tag')
<body class="theme-clean main-menu-right page-profile">
@stop

@section('page')

<div class="profile-full-name">
    <h1 class="text-semibold">{{ $resident->display_name }}</h1>
    <div class="panel-heading-controls">

        <div class="btn-group">

            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">New Note <i class="fa fa-caret-down"></i></button>
            <ul class="dropdown-menu">
                @foreach( Note::flagsAvailableForResident($resident) as $flag => $flagName )
                <li><a href="{{ route('note-new', [$flag, $resident->id]) }}"><i class="fa fa-plus-square"></i> {{ $flagName }}</a></li>
                @endforeach
            </ul>
        </div>


    </div>
</div>
<div class="profile-row">
<div class="left-col">
    <div class="profile-block">
        <div class="panel profile-photo">
            <a href="#" data-toggle="modal" data-target="#viewpic">{{ $resident->getThumbImg() }}</a>

            <div id="viewpic" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">{{ $resident->display_name }}: {{ Resident::$states[$resident->status] }}</h4>
                        </div>
                        <div class="modal-body">
                            {{ $resident->getPictureImg() }}
                        </div>
                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div>

<!--            <img src="assets/demo/avatars/5.jpg" alt="">-->
        </div><br>
        <span class="{{ Resident::$stateBadgeClass[ $resident->status ] }}">{{ Resident::$states[ $resident->status ] }}</span>
            &nbsp;&nbsp;
<!--        <a href="#" class="btn"><i class="fa fa-comment"></i></a>-->
    </div>

    <div class="panel panel-transparent">
        <div class="panel-heading">
            <span class="panel-title">{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}</span>

        </div>
        <div class="panel-body list-group">

            <p><strong>DOB</strong> {{ $resident->date_of_birth }}<br />
            @if( $resident->marital_status != MARITALSTATUS_UNKNOWN )
            {{ $resident->marital_status }}
            @endif
            </p>


        </div>
    </div>

    <div class="panel panel-transparent">

        <div class="panel-heading">
            <span class="panel-title">Identification</span>
            {{--
            <span class="pull-right"><button type="button" class="btn btn-xs-info">
                    <i class="fa fa-pencil"></i></button></span>
            --}}
        </div>
        <div class="panel-body">

            @if( $resident->sin )
        <div class="list-group">
            <strong>SIN</strong> <button type="button" class="btn btn-outline" data-toggle="modal" data-target="#viewsin">{{ $resident->sin }}</button>

            <div id="viewsin" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">{{ $resident->display_name }}: SIN CARD</h4>
                        </div>
                        <div class="modal-body">
                            {{ $resident->idSin->getPictureImg(IDENTIFICATION_BIG) }}
                        </div>
                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div>
        </div>
            @endif

            @if( $resident->health_card_number )
        <div class="list-group">
            <strong>Health</strong> <button type="button" class="btn btn-outline" data-toggle="modal" data-target="#viewhealth">{{ $resident->health_card_number }}</button>

            <div id="viewhealth" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">{{ $resident->display_name }}: HEALTH CARD</h4>
                        </div>
                        <div class="modal-body">
                            @if($resident->idHealth)
                            {{ $resident->idHealth->getPictureImg(IDENTIFICATION_BIG) }}
                            @endif
                        </div>
                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div>
        </div>
            @endif

        </div>
    </div>
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <span class="panel-title">Emergency Contact </span><span class="pull-right"><button type="button" class="btn btn-xs-info" id="edit-contact-button">
                    <i class="fa fa-pencil"></i></button></span>
        </div>
@if( $resident->contact_name )
        <div class="panel-body">



            <div class="well well-sm" id="show-contact-div">
                <h4>
                    {{ $resident->contact_name }}
                    @if( isset($resident->relationship) )
                    ({{ $resident->relationship }})
                    @endif
                </h4>
                <p>
                @if($resident->contact_street1)
                {{ $resident->contact_street1 }}<br />
                @endif
                @if($resident->contact_street2)
                {{ $resident->contact_street2 }}<br />
                @endif
                @if($resident->contact_city)
                {{{ $resident->contact_city }}}<br />
                @endif
                </p>
                @if($resident->contact_phone)
                <span class="label">{{ $resident->contact_phone }}</span>
                @endif
            </div>

            <div id="edit-contact-div" style="display: none">
<h4>
                <a id="edit-contact_name" class="editable-click" href="#" data-name="contact_name">{{ $resident->contact_name }}</a>
</h4>
                <p>
                    <a id="edit-contact_street1" class="editable-click" href="#" data-name="contact_street1">{{ $resident->contact_street1 }}</a><br />
                    <a id="edit-contact_street2" class="editable-click" href="#" data-name="contact_street2">{{ $resident->contact_street2 }}</a><br />
                    <a id="edit-contact_city" class="editable-click" href="#" data-name="contact_city">{{ $resident->contact_city }}</a><br />
                    <a id="edit-contact_phone" class="editable-click" href="#" data-name="contact_phone">{{ $resident->contact_phone }}</a>
                </p>

            </div>



        </div>
@endif
    </div>


    <div class="panel panel-transparent">
        <div class="panel-heading">
            <span class="panel-title">Medical </span>
            <span class="pull-right">
<!--                <a href='#profile-tabs-edit' data-toggle="tab" class="btn btn-xs-info" id="editDoctorButton">-->
<!--                    <i class="fa fa-pencil"></i>-->
<!--                </a>-->
            </span>
        </div>

@if( $resident->doctor_name )
        <div class="panel-body">

            <div class="well well-sm">
                <h4>Doctor</h4>
                <p>
                    {{ $resident->doctor_name }}
                </p>
                <span class="label">{{ $resident->doctor_phone }}</span>
            </div>
        </div>
@endif

@if( $count = $resident->allergies()->count() )
        <div class="panel-body">

            <div class="well well-sm">
                <h4>{{ $count == 1 ? 'Allergy' : 'Allergies' }}</h4>
<p>
@foreach( $resident->allergies()->get() as $allergy )
            <span class="label label-primary">{{ $allergy }}</span>
@endforeach
</p>
            </div>
        </div>
@endif
    </div>




@if($resident->previousAddress)
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <span class="panel-title">Previous Addresses</span><span class="pull-right"><button type="button" class="btn btn-xs-info">
                    <i class="fa fa-chevron-circle-right"></i></button></span>
        </div>

        @if($resident->previousAddress->street1 != '201 Glenridge Ave')
        <div>
            <span class="label">
            @if(isset($resident->previousAddress->start_date))
                From {{ $resident->previousAddress->start_date->format(Config::get('format.date')) }}
            @endif
            @if(isset($resident->previousAddress->end_date))
                Until {{ $resident->previousAddress->end_date->format(Config::get('format.date')) }}
            @endif
            </span>
            <div class="well well-sm">
            @if($resident->previousAddress->street1)
            {{ $resident->previousAddress->street1 }}<br />
            @endif
            @if($resident->previousAddress->street2)
            {{ $resident->previousAddress->street2 }}<br />
            @endif
            @if($resident->previousAddress->city)
            {{ $resident->previousAddress->city }}<br />
            @endif
            {{{ $resident->previousAddress->region }}} {{{ $resident->previousAddress->postal }}}
            </div>
        </div>
        @endif
    </div>
@endif
    <div class="">
@foreach($resident->otherAddresses()->get() as $address)

            <span class="label">

                @if(isset($address->start_date))
                From {{ $address->start_date->format(Config::get('format.date')) }}
                @endif
                @if(isset($address->end_date))
                Until {{ $address->end_date->format(Config::get('format.date')) }}
                @endif
            </span>
            <div class="well well-sm">
            @if($address->street1)
            {{ $address->street1 }}<br />
            @endif
            @if($address->street2)
            {{ $address->street2 }}<br />
            @endif
            @if($address->city)
            {{{ $address->city }}},
            @endif
            {{{ $address->region }}} {{{ $address->postal }}}
            </div>

@endforeach
    </div>
</div>
<div class="right-col">

<hr class="profile-content-hr no-grid-gutter-h">

<div class="profile-content">

<ul id="profile-tabs" class="nav nav-tabs">
    <li class="active">
        <a href="#profile-tabs-board" data-toggle="tab">PROFILE</a>
    </li>

    <li>
        <a href="#profile-tabs-residencies" data-toggle="tab">PREVIOUS RESIDENCIES</a>
    </li>
    <li>
        <a href="#profile-tabs-edit" data-toggle="tab">EDIT</a>
    </li>
    <li>
        <a href="#profile-tabs-id" data-toggle="tab">ID</a>
    </li>

</ul>

<div class="tab-content tab-content-bordered panel-padding">
<div class="widget-article-comments tab-pane panel no-padding no-border fade in active" id="profile-tabs-board">


@if( $suspension = Suspension::forResident($resident)->current()->first() )
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon fa fa-warning"></i> {{ $resident->display_name }} currently has a</span>
        <span class="{{ Resident::$stateBadgeClass[$resident->status] }}">{{ Suspension::$durations[$suspension->duration] }}
            {{ Suspension::$types[$suspension->type] }} Suspension</span>
    </div>



    <div class="panel-body">
        <div class="col-lg-6">
            <div class="stat-panel panel-body-colorful panel-danger">




                <!-- Success background, bordered, without top and bottom borders, without left border, without padding, vertically and horizontally centered text, large text -->
                <a href="#" class="stat-cell col-xs-5 {{ Resident::$stateBackgroundClass[RESIDENTSTATUS_SUSPENDED] }} darker bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
                    as of <br />
                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<strong>{{ $resident->residencies()->orderBy('end_date', 'DESC')->first()->end_date->format('M d') }}</strong>
                </a> <!-- /.stat-cell -->
                <!-- Without padding, extra small text -->
                <div class="stat-cell col-xs-7 no-padding valign-middle">
                    <!-- Add parent div.stat-rows if you want build nested rows -->
                    <div class="stat-rows">
                        <div class="stat-row">
                            <!-- Success darken background, small padding, vertically aligned text -->
                            <a href="#" class="stat-cell bg-default padding-sm valign-middle">
                                until {{ $suspension->end_date->format('M d') }}
                                <i class="fa fa-warning pull-right"></i>
                            </a>
                        </div>
                        <div class="stat-row">
                            <!-- Success darker background, small padding, vertically aligned text -->
                            <a href="#" class="stat-cell bg-default padding-sm valign-middle">
                                {{ $suspension->end_date->diffInDays(null, true) }} days left
                                <i class="fa fa-users pull-right"></i>
                            </a>
                        </div>
                        <div class="stat-row">
                            <!-- Success background, small padding, vertically aligned text -->
                            <a href="#" class="stat-cell bg-default padding-sm valign-middle">
                                {{ $resident->suspensions()->count() -1 }} previous suspensions
                                <i class="fa fa-sign-in pull-right"></i>
                            </a>
                        </div>

                    </div> <!-- /.stat-rows -->
                </div> <!-- /.stat-cell -->

            </div>




        </div>
        <div class="col-lg-6">
            <div class="stat-panel">

                <!-- Success background, bordered, without top and bottom borders, without left border, without padding, vertically and horizontally centered text, large text -->
                <div class="widget-profile-text stat-cell darker  panel-danger" style="padding: 0;">
@if(Auth::user()->can('notes.detail-view'))
                    {{{ $suspension->detail_note }}}
@else
                    {{{ $suspension->shift_note }}}
@endif
                    <span class="pull-right"><img class="comment-avatar" src="{{ $suspension->detail_note->author->initialUrl }}" /></span>

                </div>

            </div>
        </div>

    </div>
</div>
@endif

@if( $residency = $resident->residency )
<div class="panel panel-default">
<div class="panel-heading">
    <span class="panel-title"><i class="panel-title-icon fa fa-building"></i> Residency </span>
    <span class="{{ Resident::$stateBadgeClass[$resident->status] }}">{{ Resident::$states[$resident->status] }}</span>

    @if( $resident->status == RESIDENTSTATUS_OWP )
    <div class="panel-heading-controls">
        <a class="pull-right btn btn-success" href="{{ route('note-new', [NOTEFLAG_OWPR, $resident->id]) }}"><i class="fa fa-sign-in"></i> OWP Return</a>
    </div>
    @endif
</div>
    <div class="panel-body">
        <div class="row">
    <div class="col-lg-6">
        <div class="stat-panel">
            <!-- Success background, bordered, without top and bottom borders, without left border, without padding, vertically and horizontally centered text, large text -->
            <a href="#" class="stat-cell col-xs-5 bg-primary darker bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<strong>{{ $residency->start_date->format('M d') }}</strong>
            </a> <!-- /.stat-cell -->
            <!-- Without padding, extra small text -->
            <div class="stat-cell col-xs-7 no-padding valign-middle">
                <!-- Add parent div.stat-rows if you want build nested rows -->
                <div class="stat-rows">
                    <div class="stat-row">
                        <!-- Success background, small padding, vertically aligned text -->
                        <a data-toggle="modal" class="stat-cell bg-default padding-sm valign-middle" id="incomeSummary" data-target="#incomeDetail">
                            monthly income: &dollar;{{ $residency->income_total }}
                            <i class="fa fa-money pull-right"></i>
                        </a>
                    </div>
                    <div class="stat-row">
                        <!-- Success darken background, small padding, vertically aligned text -->
                        <a href="#" class="stat-cell bg-default padding-sm valign-middle">
                            {{ Strike::forResident($resident->id)->current()->count() }} strikes
                            <i class="fa fa-warning pull-right"></i>
                        </a>
                    </div>
                    <div class="stat-row">
                        <!-- Success darker background, small padding, vertically aligned text -->
                        <a href="#" class="stat-cell bg-default padding-sm valign-middle">
                            {{ $residency->start_date->diffInDays() }} nights here
                            <i class="fa fa-users pull-right"></i>
                        </a>
                    </div>
                </div> <!-- /.stat-rows -->
            </div> <!-- /.stat-cell -->

        </div>
    </div>
    <div class="col-lg-6">
        <div class="stat-panel">
            <!-- Success background, bordered, without top and bottom borders, without left border, without padding, vertically and horizontally centered text, large text -->
            <a href="#" class="stat-cell col-xs-2 bg-primary darker bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
                <i class="fa fa-building"></i>
            </a> <!-- /.stat-cell -->
            <!-- Without padding, extra small text -->
            <div class="stat-cell col-xs-10 no-padding valign-middle">
                <!-- Add parent div.stat-rows if you want build nested rows -->
                <div class="stat-rows">
                    <div class="stat-row">
                        <div class="col-xs-3 bg-default valign-middle text-right padding-sm stat-cell">
                            <span class="text-xs">BED</span>
                        </div>
                        <div class="col-xs-9 bg-default valign-middle padding-sm stat-cell">

                            <span class="text-sm">{{ $resident->bed }}</span>
                            <i class="fa fa-{{ $resident->gender == 'M' ? 'male' : 'female' }} pull-right"></i>

                        </div>
                    </div>
                    <div class="stat-row">
                        <div class="col-xs-3 bg-default valign-middle text-right padding-sm stat-cell">
                            <span class="text-xs">LOCKER</span>
                        </div>
                        <div class="col-xs-9 bg-default valign-middle padding-sm stat-cell">

                            <span class="text-sm">{{ $resident->locker }}</span>
                            <i class="fa fa-bolt pull-right"></i>
                        </div>
                    </div>
                    <div class="stat-row">
                        <div class="col-xs-3 bg-default valign-middle text-right padding-sm stat-cell">
                            <span class="text-xs">LOCK</span>
                        </div>
                        <div class="col-xs-9 bg-default valign-middle padding-sm stat-cell">
                            @if( $resident->locker )
                            <span class="text-sm">{{ $resident->locker->lock }}</span>
                            @endif
                            <i class="fa fa-lock pull-right"></i>

                        </div>
                    </div>
                </div> <!-- /.stat-rows -->
            </div> <!-- /.stat-cell -->

        </div>
    </div>
        </div> <!-- stat row -->


        <div class="modal fade modal-alert modal-info" id="incomeDetail" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="modal-title">
                        {{ $resident->display_name }}: &dollar;<strong>{{ $residency->income_total }}</strong>/month
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped table-condensed">
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Type</th>-->
<!--                                <th>Source</th>-->
<!--                                <th>Amount</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
                        <tbody>
                        @foreach( $residency->incomes()->get() as $income )
                            <tr>
                                <td><span class="badge">{{ $income->type }}</span></td>
                                <td>{{ $income->source }}</td>
                                <td>&dollar;{{ $income->amount }}</td>

                            </tr>


                        @endforeach
                        </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>

</div>
</div>
@endif


@if(Auth::user()->can('notes.detail-view'))

<div class="panel panel-default widget-comments" id="dashboard-support-tickets">

    <div class="panel-heading bordered">
        <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Recent Notes</span>


        <div class="panel-heading-controls">

            <!-- Tabs -->
            <ul class="nav nav-tabs bs-tabdrop">
                <li class="active"><a href="#bs-tabdrop-all" data-toggle="tab">All Notes</a></li>
                @foreach( $flagsForResident = Note::flagsFoundForResident($resident, NOTETYPE_DETAIL) as $flag => $count )
                <li><a href="#bs-tabdrop-{{ $flag }}" data-toggle="tab">{{ Note::$flags[$flag] }} ({{$count}})</a></li>
                @endforeach
            </ul>

        </div>
    </div> <!-- / .panel-heading -->




    <div class="tab-content tab-content-bordered">
        <div class="tab-pane active" id="bs-tabdrop-all">
            @include('notes.list', ['notes' => $resident->notes()->ofType(NOTETYPE_DETAIL)->get()])
        </div>
        @foreach( $flagsForResident as $flag => $count )
        <div class="tab-pane" id="bs-tabdrop-{{ $flag }}">
            @include('notes.list', ['notes' => $resident->notes()->ofType(NOTETYPE_DETAIL)->withFlag($flag)->get()])
        </div>
        @endforeach
    </div>

</div>

@endif


</div> <!-- / .tab-pane -->




<div class="tab-pane fade widget-followers" id="profile-tabs-residencies">

<div class=" text-primary valign-middle text-center-lg panel-heading">
    This page has been intentionally left blank.
</div>
</div> <!-- / .tab-pane -->



<div class="tab-pane fade widget-followers" id="profile-tabs-edit">

<!--    <div class=" text-primary valign-middle text-center-lg panel-heading">-->
<!--        -->
<!--    </div>-->
    <div id="edit-tab-body" class="panel-body bordered"></div>
</div> <!-- / .tab-pane -->




<div class="tab-pane fade widget-followers" id="profile-tabs-id">
<div class="panel-body bordered">
@include('resident.id', ['resident'=>$resident])
</div>
</div> <!-- / .tab-pane -->





</div> <!-- / .tab-content -->
</div>
</div>
</div>



<!-- modals for editing -->

{{--
<!--  edit doctor form -->
<div id="editDoctor" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="edit-doctor-body"></div>
            <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
--}}



@stop

@section('footer-scripts')

<script>


    init.push(function () {


        $('ul.bs-tabdrop').tabdrop();


//        $.fn.modal.Constructor.prototype.enforceFocus = function() {};

        $('[data-toggle=popover]').popover();

        $('#incomeSummary').click(function () {
            $('#incomeDetails').fadeIn('slow');
        });

        $('#edit-contact-button').on('click', function()
        {
            $('#show-contact-div').hide();

            $('#edit-contact-div').show();



            $('#edit-contact-div').editable({
                ajaxOptions: { 'type': 'POST' },
                selector: 'a',
                url: '/resident/edit/contacts/{{ $resident->id }}',
                pk: "{{ $resident->id }}",
                placement: 'top',
                mode: 'inline',
                success: function(response, newValue) {
                    if(response.success)
                        $()
                    else
                        return response.msg;
                }
            });

            $(this).hide();
        });
        /*
        $('#edit-contact-button').on('click', function()
        {
            $.ajax({
                url: "/resident/edit/{{ $resident->id }}",

                success: function(data) {
                    $('#edit-tab-body').html(data);
                }
            });

            $('#profile-tabs-edit').tab('show');
        });
        */

        $('#profile-tabs').on('shown.bs.tab', function(event){

            if($(event.target).attr('href') == '#profile-tabs-edit')
            {


            $.ajax({
                url: "/resident/edit/{{ $resident->id }}",

                success: function(data) {
                    $('#edit-tab-body').html(data);
                }
            });






            }

        });

    });


    setInterval( function(){
        $("#profile-tabs-activity").load("/notes/resident/{{ $resident->id }}")
    }, 5000 );

</script>

@stop