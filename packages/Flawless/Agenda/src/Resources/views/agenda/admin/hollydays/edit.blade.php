@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <update-holyday></update-holyday>
    </div>

    @push('scripts')
        <script type="text/x-template" id="update-holyday-form-template">
          {!! view_render_event('flawless.agenda.admin.hollydays.edit.before', ['hollyday' => $hollyday]) !!}

            <form method="POST" action="{{ route('agenda.hollydays.update', $hollyday->id) }}">
                @csrf

                <div class="page-header">
                    <div class="page-title">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/hollydays') }}';"></i>

                            {{ trans('agenda::app.admin.hollydays.title') }}
                        </h1>
                    </div>

                    <div class="page-action">
                        <button type="submit" class="btn btn-lg btn-primary">
                            Guardar Fecha
                        </button>
                    </div>
                </div>

                <div class="page-content">
                    <div class="form-container">

                        <div>
                            @csrf()
                            <input name="_method" type="hidden" value="PUT">
                                <div slot="body">
                                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="required">Nombre</label>

                                        <input type="text" class="control" name="name" value="{{$hollyday->name}}" v-validate="'required'">

                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>

                                    <date :name="day" dateFormat = "Y-m-d">
                                        <div class="control-group" :class="[errors.has('day') ? 'has-error' : '']">
                                            <label for="day">Dia</label>

                                            <input type="text" class="control" value="{{$hollyday->day}}"  name="day" >

                                            <span class="control-error" v-if="errors.has('day')">@{{ errors.first('day') }}</span>
                                        </div>
                                    </date>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
          {!! view_render_event('flawless.agenda.admin.hollydays.edit.after', ['hollyday' => $hollyday]) !!}
        </script>

        <script>
            Vue.component('update-holyday', {
                template: '#update-holyday-form-template',

                inject: [ '$validator'],

                data () {
                    return {
                        name: '',
                        day: ''
                    }
                },
                props: ['hDay', 'hName']
            });
        </script>
    @endpush
@stop
