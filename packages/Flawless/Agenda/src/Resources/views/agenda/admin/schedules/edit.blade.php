@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <update-schedule></update-schedule>
    </div>

    @push('scripts')
        <script type="text/x-template" id="update-schedule-form-template">
          {!! view_render_event('flawless.agenda.admin.schedules.edit.before', ['schedule' => $schedule]) !!}

            <form method="POST" action="{{ route('agenda.schedules.update', $schedule->id) }}">
                @csrf

                <div class="page-header">
                    <div class="page-title">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/hollydays') }}';"></i>

                            {{ trans('agenda::app.admin.schedules.title') }}
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
                                  <div class="control-group" :class="[errors.has('start_time') ? 'has-error' : '']">
                                      <label for="start_time" class="required">Duración</label>

                                      <select type="text" class="control" name="start_time" v-validate="'required'" value="{{$schedule->start_time}}">
                                              <option value="05:00:00">05 AM</option>
                                              <option value="06:00:00">06 AM</option>
                                              <option value="07:00:00">07 AM</option>
                                              <option value="08:00:00">08 AM</option>
                                              <option value="09:00:00">09 AM</option>
                                              <option value="10:00:00">10 AM</option>
                                              <option value="11:00:00">11 AM</option>
                                              <option value="12:00:00">12 AM</option>
                                      </select>

                                      <span class="control-error" v-if="errors.has('start_time')">@{{ errors.first('start_time') }}</span>
                                  </div>

                                  <div class="control-group" :class="[errors.has('finish_time') ? 'has-error' : '']">
                                      <label for="finish_time" class="required">Duración</label>

                                      <select type="text" class="control" name="finish_time" v-validate="'required'" value="{{$schedule->finish_time}}">
                                        <option value="13:00:00">01 PM</option>
                                        <option value="14:00:00">02 PM</option>
                                        <option value="15:00:00">03 PM</option>
                                        <option value="16:00:00">04 PM</option>
                                        <option value="17:00:00">05 PM</option>
                                        <option value="18:00:00">06 PM</option>
                                        <option value="19:00:00">07 PM</option>
                                        <option value="20:00:00">08 PM</option>
                                        <option value="21:00:00">09 PM</option>
                                        <option value="22:00:00">10 PM</option>
                                        <option value="23:00:00">11 PM</option>
                                        <option value="24:00:00">12 PM</option>
                                        <option value="01:00:00">01 AM</option>
                                        <option value="02:00:00">02 AM</option>
                                        <option value="03:00:00">03 AM</option>
                                        <option value="04:00:00">04 AM</option>
                                      </select>

                                      <span class="control-error" v-if="errors.has('finish_time')">@{{ errors.first('finish_time') }}</span>
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
          {!! view_render_event('flawless.agenda.admin.schedules.edit.after', ['schedule' => $schedule]) !!}
        </script>

        <script>
            Vue.component('update-schedule', {
                template: '#update-schedule-form-template',

                inject: [ '$validator'],

                data () {
                    return {
                        name: '',
                        start_time: '',
                        finish_time: '',
                        config: {
                          enableTime: true, // set wrap to true only when using 'input-group'
                          enableSeconds: true,
                          noCalendar: true
                        },
                    }
                },
                props: ['hDay', 'hName']
            });
        </script>
    @endpush
@stop
