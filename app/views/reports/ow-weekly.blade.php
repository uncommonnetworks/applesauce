@extends('layouts.master')


@section('body-tag')
<body class="theme-clean main-menu-right page-search">
@stop

@section('page')
<div id="content-wrapper">

<div class="page-header bg-info">
    <h1><i class="fa fa-list-ol page-header-icon"></i>&nbsp;&nbsp;OW Weekly List</h1>
</div> <!-- / .page-header -->


<!-- Panel -->
<div class="panel search-panel">


{{ Form::open(['action' => 'ReportsController@postOwWeekly', 'class' => 'search-form']) }}
{{ Form::hidden('untilDate', Carbon\Carbon::now(), ['id' => 'untilDate']) }}

<div class="input-group input-group-lg">

<div id="enddate" data-name="enddate"></div>


<span class="input-group-btn">
    <button type="submit" class="btn btn-primary btn-flat btn-xs">Download 7 Days</button>
</span>
</div> <!-- / .input-group -->

{{ Form::close() }}

</div>



</div>
<!-- / Panel -->

</div>


<script type="text/javascript">
    init.push(function(){


    $('#enddate').datepaginator({
//        textSelected: 'MMM d, YYYY',
        size: 'large',
        endDate: new Date(),
        onSelectedDateChanged: function(event, date) {
            $('#untilDate').val(date);
        }
    });

    });

</script>
@stop