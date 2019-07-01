@extends('admin::layouts.master')

@section('page_title')
Flawless Citas
@stop

@section('content-wrapper')

<div class="inner-section">

    @include ('admin::layouts.nav-aside')

    <div class="content-wrapper">
    @include ('admin::layouts.tabs')

    <div class="content" style="height: 100%;">
      <!-- CONTENT BEGIN-->
    <div class="page-header">
      <div class="page-title">
        <h1>{{ trans('agenda::app.admin.appointments.title') }}</h1>
      </div>
      <div class="page-action">
        <a href="{{ route('agenda.appointments.create') }}" class="btn btn-lg btn-primary">{{ trans('agenda::app.admin.qa_add_new') }}</a>
      </div>
    </div>


    <div class="page-content">

      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

      <div id='agedaCalendar'></div>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
        <div id='calendar'></div>

        @inject('appointmentGrid','Webkul\Admin\DataGrids\AppointmentDataGrid')

        {!! $appointmentGrid->render() !!}
    </div>


    <!-- CONTENT END-->
    </div>

  </div>

</div>
@push('scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>


<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
                  // put your options and callbacks here
                  defaultView: 'agendaWeek',
                  // minTime: "07:00:00",
                  // maxTime: "22:00:00",
                  eventTextColor : '#fff',
                  events : [
                    @foreach(app('Flawless\Agenda\Models\Appointment')->all() as $appointment)
                {
                    title : '{{ $appointment->customer->first_name . ' ' . $appointment->customer->last_name }}',
                    start : '{{ $appointment->start_time }}',
                    @if ($appointment->finish_time)
                            end: '{{ $appointment->finish_time }}',
                    @endif
                    url : '{{ route('agenda.appointments.edit', $appointment->id) }}',
                    @if ($appointment->confirmed == 0)
                            backgroundColor: '#ec5943',
                    @endif
                },
                  @endforeach
            ]
        })
    });
</script>
@endpush
@stop
