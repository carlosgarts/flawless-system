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
        <h1>{{ trans('agenda::app.admin.schedules.title') }}</h1>
      </div>

    </div>


    <div class="page-content">
        @inject('scheduleGrid','Webkul\Admin\DataGrids\ScheduleDataGrid')

        {!! $scheduleGrid->render() !!}
    </div>


    <!-- CONTENT END-->
    </div>

  </div>

</div>
@stop


@section('javascript')
    <script>
        // @can('group_delete')
        //     window.route_mass_crud_entries_destroy = '{{ route('admin.groups.mass_destroy') }}';
        // @endcan

    </script>
@endsection
