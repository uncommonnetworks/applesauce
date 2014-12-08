@extends('layouts.master')


@section('body-tag')
<body class="theme-clean main-menu-right page-search">
@stop

@section('page')


<div class="page-header">
    <h1><i class="fa fa-building page-header-icon"></i>&nbsp;&nbsp;NOTES</h1>
</div> <!-- / .page-header -->




<div class="panel">
<!--    <div class="panel-heading">-->
<!--        <span class="panel-title">New Shelter Note</span>-->
<!--    </div>-->
    <div class="panel-body">
        <ul id="tabs" class="nav nav-tabs nav-justified tab-content-bordered">
            <li class="active">
                <a href="#tabs-home" data-toggle="tab">Recent</a>
            </li>

@foreach ( Note::$flags as $flag => $flagName )

            <li class="">
                <a href="#tabs-{{ $flag }}" data-toggle="tab">{{ $flagName }} <span class="badge badge-primary">+</span></a>
            </li>
@endforeach

        </ul>

        <div class="tab-content tab-content-bordered">
            <div class="tab-pane fade active in" id="tabs-home">
            </div>

@foreach( Note::$flags as $flag => $flagName )
            <div class="tab-pane fade in" id="tabs-{{ $flag }}">


                <div class="col-lg-6">

                    {{ Form::open(array( 'url' => "/note-new/{$flag}", 'class' => 'panel form-horizontal', 'id' => "form{$flag}" )) }}

                    <div class="panel-heading"><div class="row">

                        <div class="col-lg-8">
                            <h4>{{ $flagName }} Note</h4>
                        </div>
                        <div class="col-lg-4 text-right">
                            <p class="text-xs">
                            <span class="text-info">{{ Auth::user()->name }}</span> <i class="fa fa-comment-o" ></i><br />
                            <span class="text-info">{{ Carbon\Carbon::now()->format(Config::get('format.date)) }} at <span class="clock"></span></span> <i class="fa fa-clock-o"></i>
                            </p>
                        </div>

                    </div></div>

                    <div class="panel-body">

    @if( Note::$residentsByFlag[ $flag ] > 0 )
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset1">
                                <div class="form-group no-margin-hr">
                                    <label class="control-label">Resident</label>


        @if( Note::$residentsByFlag[ $flag ] == 1 )


                                    {{ Form::text( 'resident', null, array('id' => "{$flag}-resident" )) }}




        @elseif( Note::$residentsByFlag[ $flag ] == 2 )


                                    {{ Form::text( 'residents', null, array('id' => "{$flag}-resident" )) }}

        @endif

                                </div>
                            </div>
                        </div><!-- row -->
    @endif

    @foreach( Note::$typesByFlag[ $flag ] as $type )

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset1">
                                <div class="form-group no-margin-hr">
                                    <label class="control-label">{{ Note::$types[ $type ] }}</label>
                                    {{ Form::textarea( "{$flag}-{$type}", null, array( 'id' => "{$flag}-{$type}", 'rows' => '3', 'class' => 'form-control', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 68px;' )) }}

                                </div>
                            </div><!-- col-sm-6 -->

                            <script>
                                init.push(function () {
                                    $("#{{ $flag }}-{{ $type }}").autosize();
                                    $("#{{ $flag }}-{{ $type }}").rules("add", {
                                        required: true
                                    });
                                });


                            </script>

                        </div><!-- row -->
    @endforeach

    @if( Note::$bedsByFlag[ $flag ] > 0 )

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset1">
                                <div class="form-group no-margin-hr">
                                    <label class="control-label">Bed</label>


                                    {{ Form::select( 'bed', array(), null, array( 'id' => "{$flag}-bed", 'class' => 'form-control' )) }}
                                </div>
                            </div><!-- col-sm-6 -->



                        </div><!-- row -->
    @endif

                    </div>


                    <div class="panel-footer text-right">


                        <button class="btn btn-{{ Note::$flagClass[$flag] }}">{{ strtoupper($flagName) }} NOTED! <i class="fa {{ Note::$flagIcon[$flag] }}"></i></button>

                    </div>
                    {{ Form::close() }}


                </div>


                <div class="col-lg-6">

                    <div class="well">Instructions here?</div>
                </div>

            </div> <!-- / .tab-pane -->


@endforeach

        </div> <!-- / .tab-content -->
    </div>
</div>


@stop


@section('footer-scripts')


<script>





    setInterval( function(){
        $("#tabs-home").load("/notes/recent")
    }, 2000 );




@foreach( Note::$flags as $flag => $flagName )


    @if( count(Note::$typesByFlag[ $flag ]) )

    $("#form{{ $flag }}").validate();

    @endif


    @if( Note::$residentsByFlag[ $flag ] > 0 )

    // populate resident selector with scope from note flag (eg: former for intake)
    $("#{{ $flag }}-resident").select2({
        placeholder: "Search {{ Note::$residentScopeByFlag[ $flag ] }} residents...",
        minimumInputLength: 1,
        ajax: {
            url: "/api/residents/search",
            dataType: 'json',
            data: function (term, page) {
                return {
                    q: term, // search term
                    scope: "{{ Note::$residentScopeByFlag[ $flag ] }}"
                };
            },

            // display name and d-o-b in dropdown
            results: function(data, page){
                $.each( data, function( key, value ) {
                    value.text = value.first_name + " " + value.last_name + "  (" + value.date_of_birth + ")";
                });

                return { results: data }
            }
        },

        text: name,

    // other note flags might allow multiple residents
    @if( Note::$residentsByFlag[ $flag ] == 2 )

        multiple: true,

    @endif

        dropdownCssClass: "bigdrop" // apply css that makes the dropdown taller

    });


    // if we have both a resident and a bed, we have to populate the bed drop-down
    // using the selected resident's gender
    @if( Note::$residentsByFlag[ $flag ] == 1 && Note::$bedsByFlag[ $flag ] == 1 )


    // start out with bed select disabled (and empty)
    $("#{{ $flag }}-bed").prop('disabled', true);


    $("#{{ $flag }}-resident").on("select2-selecting", function(e){

        // after a resident is selected, fetch data on that resident
        $.getJSON( "/api/resident", { id: e.val }, function(data){


            $("#{{ $flag }}-bed").empty();
            $("#{{ $flag }}-bed").prop('disabled', true);

            // then fetch vacant bed list using resident's gender
            $.getJSON( "/api/beds/vacant", { gender: data.gender }, function(data){
                var html;
                $.each( data, function( key, bed ){
                    html += '<option value="' + bed.id + '">' + bed.room_id + ' :: ' + bed.name + '</option>';
                });

                $("#{{ $flag }}-bed").append(html);
            });

            // automatically select first bed so user doesn't have to
            $("#{{ $flag }}-bed").val($("#{{ $flag }}-bed option:first").val());
            $("#{{ $flag }}-bed").prop('disabled', false);
        });
    });


    @endif


    @endif
@endforeach




function updateClock ( )
{
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;

    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

    $(".clock").html(currentTimeString);
}

$(document).ready(function()
{
    setInterval('updateClock()', 1000);
});
</script>

@stop