@extends('layouts.master')


@section('body-tag')
<body class="theme-clean main-menu-right page-search">
@stop

@section('page')




<div class="page-header">
    <h1><i class="fa fa-search page-header-icon"></i>&nbsp;&nbsp;Search results</h1>
</div> <!-- / .page-header -->

@if (isset($q))
<div class="search-text">
    <strong><?php echo count($residents); ?></strong> result<?php if(count($residents) != 1) echo 's'; ?>
    found for: <span class="text-primary">{{{ $q }}}</span>
</div> <!-- / .search-text -->
@endif

<!-- Tabs -->
<div class="search-tabs">
    <ul class="nav nav-tabs">

        <li class="active">
            <a href="#search-tabs-residents" data-toggle="tab">Residents <span class="label label-success">{{ count($residents) }}</span></a>
        </li>
<!--
        <li>
            <a href="#search-tabs-users" data-toggle="tab">Users <span class="label label-success">5</span></a>
        </li>
        <li>
            <a href="#search-tabs-messages" data-toggle="tab">Messages <span class="label label-danger">9</span></a>
        </li>
-->
    </ul> <!-- / .nav -->
</div>
<!-- / Tabs -->

<!-- Panel -->
<div class="panel search-panel">

<!-- Search form -->
<form action="search" class="search-form bg-primary" method="post">
    <div class="input-group input-group-lg">
        <span class="input-group-addon no-background"><i class="fa fa-search"></i></span>

@if( isset($q) )
        <input type="text" name="q" class="form-control" value="{{{ $q }}}" />
@else
        <input type="text" name="q" class="form-control" placeholder="Type your search here..." />
@endif
					<span class="input-group-btn">
						<button class="btn" type="submit">Search</button>
					</span>
    </div> <!-- / .input-group -->
</form>
<!-- / Search form -->

<!-- Search results -->
<div class="panel-body tab-content">



<!-- Residents search -->
<div class="search-users tab-pane fade in active" id="search-tabs-residents">
    <table class="table table-hover">
        <thead>
        <tr>

            <th>Name</th>
            <th>DOB</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>


@foreach ($residents as $resident)
<?php //if($resident->picture) echo $resident->picture;// var_dump( $resident->picture()); ?>
        <tr>
            <td>
                <a href="{{ $resident->url }}">
                    <?php if( $resident->picture ): ?>
                        <img src="{{ $resident->thumbUrl }}" alt="" class="avatar" />
                    <?php else: ?>
                        <img src="assets/images/pixel-admin/avatar.png" alt="" class="avatar" />
                    <?php endif; ?>
                </a>&nbsp;&nbsp;
                <a href="{{ $resident->url }}">{{ $resident->display_name }}</a>
            </td>
            <td>
                {{ $resident->dob }}
                <span class="label">{{ $resident->age }}</span>
            </td>
            <td>
                <span class="{{ Resident::$stateBadgeClass[ $resident->status ] }}">{{ Resident::$states[ $resident->status ] }}</span></td>
            <td>
@if( $resident->status == RESIDENTSTATUS_FORMER )
                <a href="{{ route('intake-begin',$resident->id) }}" class="btn btn-sm btn-info">Intake <i class="fa fa-sign-in"></i></a>
@else

@endif
            </td>
        </tr>
@endforeach

        </tbody>
    </table>
</div>
<!-- / Users search -->


<!-- Users search --
<div class="search-users tab-pane fade" id="search-tabs-users">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>User</th>
            <th>Full Name</th>
            <th>E-mail</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center">1</td>
            <td>
                <img src="assets/demo/avatars/1.jpg" alt="" class="avatar">&nbsp;&nbsp;
                <a href="#">jdoe</a>
            </td>
            <td>John Doe</td>
            <td>jdoe@example.com</td>
            <td>
                <a href="#" title="Edit" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a>
                <a href="#" title="Delete" class="btn btn-xs btn-outline btn-danger add-tooltip"><i class="fa fa-times"></i></a>
                <a href="#" title="Ban user" class="btn btn-xs btn-outline btn-info add-tooltip"><i class="fa fa-lock"></i></a>
            </td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>
                <img src="assets/demo/avatars/2.jpg" alt="" class="avatar">&nbsp;&nbsp;
                <a href="#">rjang</a>
            </td>
            <td>Robert Jang</td>
            <td>rjang@example.com</td>
            <td>
                <a href="#" title="Edit" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a>
                <a href="#" title="Delete" class="btn btn-xs btn-outline btn-danger add-tooltip"><i class="fa fa-times"></i></a>
                <a href="#" title="Ban user" class="btn btn-xs btn-outline btn-info add-tooltip"><i class="fa fa-lock"></i></a>
            </td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>
                <img src="assets/demo/avatars/3.jpg" alt="" class="avatar">&nbsp;&nbsp;
                <a href="#">mbortz</a>
            </td>
            <td>Michelle Bortz</td>
            <td>mbortz@example.com</td>
            <td>
                <a href="#" title="Edit" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a>
                <a href="#" title="Delete" class="btn btn-xs btn-outline btn-danger add-tooltip"><i class="fa fa-times"></i></a>
                <a href="#" title="Ban user" class="btn btn-xs btn-outline btn-info add-tooltip"><i class="fa fa-lock"></i></a>
            </td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>
                <img src="assets/demo/avatars/4.jpg" alt="" class="avatar">&nbsp;&nbsp;
                <a href="#">towens</a>
            </td>
            <td>Timothy Owens</td>
            <td>towens@example.com</td>
            <td>
                <a href="#" title="Edit" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a>
                <a href="#" title="Delete" class="btn btn-xs btn-outline btn-danger add-tooltip"><i class="fa fa-times"></i></a>
                <a href="#" title="Ban user" class="btn btn-xs btn-outline btn-info add-tooltip"><i class="fa fa-lock"></i></a>
            </td>
        </tr>
        <tr>
            <td class="text-center">5</td>
            <td>
                <img src="assets/demo/avatars/5.jpg" alt="" class="avatar">&nbsp;&nbsp;
                <a href="#">dsteiner</a>
            </td>
            <td>Denise Steiner</td>
            <td>dsteiner@example.com</td>
            <td>
                <a href="#" title="Edit" class="btn btn-xs btn-outline btn-success add-tooltip"><i class="fa fa-pencil"></i></a>
                <a href="#" title="Delete" class="btn btn-xs btn-outline btn-danger add-tooltip"><i class="fa fa-times"></i></a>
                <a href="#" title="Ban user" class="btn btn-xs btn-outline btn-info add-tooltip"><i class="fa fa-lock"></i></a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<!-- / Users search -->

<!-- Messages search -->
<div class="search-messages tab-pane fade widget-messages" id="search-tabs-messages">
    <div class="message unread">
        <a href="#" title="" class="from">Robert Jang</a>
        <a href="#" title="" class="title">Message Title 1</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message unread">
        <a href="#" title="" class="from">Michelle Bortz</a>
        <a href="#" title="" class="title"><i class="message-title-icon fa fa-paperclip"></i>Message Title 2</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Timothy Owens</a>
        <a href="#" title="" class="title">Message Title 3</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Denise Steiner</a>
        <a href="#" title="" class="title">Message Title 4</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Robert Jang</a>
        <a href="#" title="" class="title">Message Title 5</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Michelle Bortz</a>
        <a href="#" title="" class="title">Message Title 6</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Timothy Owens</a>
        <a href="#" title="" class="title">Message Title 7</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Denise Steiner</a>
        <a href="#" title="" class="title">Message Title 8</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->

    <div class="message">
        <a href="#" title="" class="from">Robert Jang</a>
        <a href="#" title="" class="title">Message Title 9</a>
        <div class="date">18 jan</div>
    </div> <!-- / .message -->
</div>
<!-- / Messages search -->
</div>






<!-- / Search results -->

<!-- Panel Footer --
<div class="panel-footer">
    <ul class="pagination">
        <li class="disabled"><a href="#">«</a></li>
        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">»</a></li>
    </ul>
</div> <!-- / .panel-footer -->


</div>
<!-- / Panel -->


<div class="well-lg">

    <a class="btn btn-lg btn-info" href="{{ route('intake-begin') }}">New Resident Intake <i class="fa fa-sign-in"></i></a>
</div>


@stop