{{ Form::open( ['url' => "suspension/edit/{$suspension->id}", 'class' => 'panel form-horizontal' ]) }}


<div class="panel-heading">
    <span class="panel-title">Edit suspension for {{ $suspension->resident->display_name }}</span>
</div>
<div class="panel-body">
<div class="form-group">
    {{ Form::label('suspension-type', 'Suspension Type', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select( NOTEFLAG_SUSPENSION . '-type', Suspension::$types, $suspension->type, ['id' => 'suspension-type', 'class' => 'form-control']) }}
    </div>
</div>




<div class="form-group">
    <p></p>
    {{ Form::hidden('suspension-startdate', $suspension->start_date->format('M d, Y'), ['id' => 'suspension-startdate']) }}
    {{ Form::label('suspension-duration', 'Duration', ['class' => 'col-sm-2 control-label']) }}

    <div class="col-sm-10">
        {{ Form::select( 'suspension-duration', Suspension::$durations, $suspension->duration, ['id' => 'suspension-duration', 'class' => 'form-control']) }}
        <p class="help-block">
            Suspension began on <strong>{{ $suspension->start_date->format(Config::get('format.date')) }}</strong> and will end on

            <a href="#" id="bs-x-editable-enddate" data-type="date" data-placement="right" data-title="Tweak End Date?">{{ $suspension->end_date->format('M d, Y') }}</a>
            {{ Form::hidden('suspension-enddate', null, ['id' => 'suspension-enddate']) }}

        </p>
    </div>

</div>





<div class="form-group">
    {{ Form::label(NOTEFLAG_SUSPENSION .'-'. NOTETYPE_DETAIL, 'Detail Note', ['class' => 'col-sm-2 control-label']) }}

    <div class="col-sm-10">
        {{ Form::textarea( NOTEFLAG_SUSPENSION .'-'. NOTETYPE_DETAIL, null, ['rows' => '3', 'class' => 'form-control', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 68px;', 'placeholder' => 'I decided to change this suspension because...']) }}
    </div>
</div>

<div class="form-group" style="margin-bottom: 0;">
    <div class="col-sm-offset-2 col-sm-10">

        <button class="btn btn-{{ Note::$flagClass[NOTEFLAG_SUSPENSION] }}">Save Changes <i class="fa {{ Note::$flagIcon[NOTEFLAG_SUSPENSION] }}"></i></button>
    </div>
</div>
</div>

{{ Form::close() }}



<script type="text/javascript">
    $('#suspension-duration').on('change', function(e) {
        var duration = $('#suspension-duration').val();
        var startdate = new Date($('#suspension-startdate').val());
        var enddate = new Date(startdate);
        enddate.setDate(startdate.getDate() + parseInt(duration));
        var newDate = new Date((enddate.getMonth() + 1) + '/' + enddate.getDate() + '/' + enddate.getFullYear());
        $('#bs-x-editable-enddate').editable('setValue', newDate);
        $('#suspension-enddate').val(newDate);
    });

</script>