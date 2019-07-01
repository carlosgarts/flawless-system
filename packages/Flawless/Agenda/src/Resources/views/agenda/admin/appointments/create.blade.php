@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <new-appointment></new-appointment>
    </div>

    @push('scripts')
        <script type="text/x-template" id="new-appointment-form-template">
            <form method="POST" action="{{ route('agenda.appointments.store') }}">
                @csrf

                <div class="page-header">
                    <div class="page-title">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/appointments') }}';"></i>

                            Nueva Cita
                        </h1>
                    </div>

                    <div class="page-action">
                        <button type="submit" class="btn btn-lg btn-primary">
                            Guardar Cita
                        </button>
                    </div>
                </div>

                <div class="page-content">
                    <div class="form-container">
                        <div>
                            @csrf()

                                <div slot="body">

                                    <div class="control-group" :class="[errors.has('customer_id') ? 'has-error' : '']">
                                        <label for="customer_id" class="required">Cliente</label>

                                        <select type="text" class="control" name="customer_id" v-model="customer_id" v-validate="'required'" value="{{ old('customer_id') }}">
                                            <option disabled="disabled">Seleccione un cliente</option>
                                            @foreach(app('Webkul\Customer\Models\Customer')->all() as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }} {{ $customer->email }}</option>
                                            @endforeach
                                        </select>

                                        <span class="control-error" v-if="errors.has('service_id')">@{{ errors.first('service_id') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('service_id') ? 'has-error' : '']">
                                        <label for="service_id" class="required">Servicio Base</label>

                                        <select type="text" class="control" name="service_id" v-model="service_id" v-validate="'required'" value="{{ old('service_id') }}">
                                            <option disabled="disabled">Seleccione un servicio</option>
                                            @foreach(app('Flawless\Agenda\Models\Service')->all() as $services)
                                                <option value="{{ $services->id }}">{{ $services->name }}</option>
                                            @endforeach
                                        </select>

                                        <span class="control-error" v-if="errors.has('service_id')">@{{ errors.first('service_id') }}</span>
                                    </div>

                                    <date :name="date">
                                        <div class="control-group" :class="[errors.has('date') ? 'has-error' : '']">
                                            <label for="date">Dia</label>

                                            <input type="text" class="control" v-model="date" name="date">

                                            <span class="control-error" v-if="errors.has('date')">@{{ errors.first('date') }}</span>
                                        </div>
                                    </date>

                                    <div class="control-group" :class="[errors.has('starting_hour') ? 'has-error' : '']">
                                        <label for="starting_hour" class="required">Hora de inicio</label>

                                        <select name="starting_hour" id="starting_hour" v-model="starting_hour" class="control" required style="max-width: 85px; " v-validate="'required'" value="{{ old('starting_hour') }}">
                              						<option value="-1" selected>Hora</option>
                              						<option value="08">08</option>
                              						<option value="09">09</option>
                              						<option value="10">10</option>
                              						<option value="11">11</option>
                              						<option value="12">12</option>
                              						<option value="13">13</option>
                              						<option value="14">14</option>
                              						<option value="15">15</option>
                              						<option value="16">16</option>
                              						<option value="17">17</option>
                              						<option value="18">18</option>
                              					</select>
                                        :
                                        <select name="starting_minute" id="starting_minute" v-model="starting_minute" class="control" required style="max-width: 95px;"  v-validate="'required'" value="{{ old('starting_minute') }}">
                              						<option value="-1" selected>Minuto</option>
                              						<option value="00">00</option>
                              						<option value="15">15</option>
                              						<option value="30">30</option>
                              						<option value="45">45</option>
                              					</select>

                                        <span class="control-error" v-if="errors.has('starting_hour')">@{{ errors.first('start_hour') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('finish_hour') ? 'has-error' : '']">
                                        <label for="finish_hour" class="required">Hora de culminado</label>

                                        <select name="finish_hour" id="finish_hour" v-model="finish_hour" class="control" required style="max-width: 85px; " v-validate="'required'" value="{{ old('finish_hour') }}">
                              						<option value="-1" selected>Hora</option>
                              						<option value="08">08</option>
                              						<option value="09">09</option>
                              						<option value="10">10</option>
                              						<option value="11">11</option>
                              						<option value="12">12</option>
                              						<option value="13">13</option>
                              						<option value="14">14</option>
                              						<option value="15">15</option>
                              						<option value="16">16</option>
                              						<option value="17">17</option>
                              						<option value="18">18</option>
                              					</select>
                                        :
                                        <select name="finish_minute" id="finish_minute" v-model="finish_minute" class="control" required style="max-width: 95px;"  v-validate="'required'" value="{{ old('finish_minute') }}">
                              						<option value="-1" selected>Minuto</option>
                              						<option value="00">00</option>
                              						<option value="15">15</option>
                              						<option value="30">30</option>
                              						<option value="45">45</option>
                              					</select>

                                        <span class="control-error" v-if="errors.has('finish_hour')">@{{ errors.first('finisht_hour') }}</span>
                                    </div>


                                    <div class="control-group" :class="[errors.has('confirmed') ? 'has-error' : '']">
                                        <label for="confirmed" class="required">Confirmada</label>

                                        <select type="text" class="control" name="confirmed" v-model="confirmed" v-validate="'required'" value="{{ old('confirmed') }}">
                                            <option value="true">SI</option>
                                            <option value="false">NO</option>
                                        </select>

                                        <span class="control-error" v-if="errors.has('confirmed')">@{{ errors.first('confirmed') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('comments') ? 'has-error' : '']">
                                        <label for="comments" class="required">Comentarios</label>

                                        <input type="text" class="control" name="comments" v-validate="'required'" value="{{ old('comments') }}">

                                        <span class="control-error" v-if="errors.has('comments')">@{{ errors.first('comments') }}</span>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </script>

        <script>
            Vue.component('new-appointment', {
                template: '#new-appointment-form-template',

                inject: ['$validator'],

                data () {
                    return {
                        name: null,
                        customer_id: null,
                        service_id: null,
                        starting_time: null,
                        finish_time: null,
                        available: 0,
                        comments: '',
                        confirmed: false,
                        date: null,
                        starting_hour: null,
                        starting_minute: null,
                        finish_hour: null,
                        finish_minute: null
                    }
                }
            });
        </script>
    @endpush
@stop
