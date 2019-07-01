@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <update-appointment></update-appointment>
    </div>

    @push('scripts')
        <script type="text/x-template" id="update-appointment-form-template">
          {!! view_render_event('flawless.agenda.admin.appointments.edit.before', ['appointment' => $appointment]) !!}

            <form method="POST" action="{{ route('agenda.appointments.update', $appointment->id) }}">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="page-header">
                    <div class="page-title">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/appointments') }}';"></i>

                            Editar Cita
                        </h1>
                    </div>

                    <div class="page-action">
                        <button type="submit" class="btn btn-lg btn-primary">
                            Guardar Servicio
                        </button>
                    </div>
                </div>

                <div class="page-content">
                    <div class="form-container">
                        <div>
                            @csrf()

                                <div slot="body">
                                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="required">Nombre</label>

                                        <h3>{{$appointment->customer->name}}</h3>


                                    </div>

                                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="required">Servicio Base</label>

                                        <h3>{{$appointment->service->name}}</h3>


                                    </div>

                                    <datetime name="start_time">
                                        <div class="control-group" :class="[errors.has('start_time') ? 'has-error' : '']">
                                            <label for="start_time">{{ __('admin::app.promotion.general-info.ends-till') }}</label>

                                            <input type="text" class="control" value="{{$appointment->start_time}}" name="start_time">

                                            <span class="control-error" v-if="errors.has('start_time')">@{{ errors.first('start_time') }}</span>
                                        </div>
                                    </datetime>

                                    <datetime name="finish_time">
                                        <div class="control-group" :class="[errors.has('finish_time') ? 'has-error' : '']">
                                            <label for="finish_time">{{ __('admin::app.promotion.general-info.ends-till') }}</label>

                                            <input type="text" class="control" value="{{$appointment->finish_time}}" name="finish_time">

                                            <span class="control-error" v-if="errors.has('finish_time')">@{{ errors.first('finish_time') }}</span>
                                        </div>
                                    </datetime>

                                    <div class="control-group" :class="[errors.has('confirmed') ? 'has-error' : '']">
                                        <label for="confirmed" class="required">Confirmada</label>

                                        <select type="text" class="control" name="confirmed" v-validate="'required'" value="{{$appointment->confirmed}}">
                                            <option value="true">SI</option>
                                            <option value="false">NO</option>
                                        </select>

                                        <span class="control-error" v-if="errors.has('confirmed')">@{{ errors.first('confirmed') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('comments') ? 'has-error' : '']">
                                        <label for="comments" class="required">Comentarios</label>

                                        <input type="text" class="control" name="comments" v-validate="'required'" value="{{$appointment->comments}}">

                                        <span class="control-error" v-if="errors.has('comments')">@{{ errors.first('comments') }}</span>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </form>
          {!! view_render_event('flawless.agenda.admin.appointments.edit.after', ['appointment' => $appointment]) !!}
        </script>

        <script>
            Vue.component('update-appointment', {
                template: '#update-appointment-form-template',

                inject: [ '$validator'],

                data () {
                    return {
                      name: null,
                      day: null,
                      group_id: null,
                      price: 0,
                      duration: '00:15:00',
                      available: 0,
                    }
                }
            });
        </script>
    @endpush
@stop
