@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <update-service></update-service>
    </div>

    @push('scripts')
        <script type="text/x-template" id="update-service-form-template">
          {!! view_render_event('flawless.agenda.admin.services.edit.before', ['service' => $service]) !!}

            <form method="POST" action="{{ route('agenda.services.update', $service->id) }}">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="page-header">
                    <div class="page-title">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/services') }}';"></i>

                            {{ trans('agenda::app.admin.services.title') }}
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

                                        <input type="text" class="control" name="name" v-validate="'required'" value="{{$service->name}}">

                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('price') ? 'has-error' : '']">
                                        <label for="price" class="required">Precio</label>

                                        <input type="number" min="0" class="control" name="price" v-validate="'required|numeric'" value="{{$service->price}}">

                                        <span class="control-error" v-if="errors.has('price')">@{{ errors.first('price') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('duration') ? 'has-error' : '']">
                                        <label for="duration" class="required">Duración (en minutos)</label>

                                        <input type="number" min="0"  max ="1440" class="control" name="duration" v-validate="'required|numeric'" value="{{$service->duration}}">

                                        <span class="control-error" v-if="errors.has('duration')">@{{ errors.first('duration') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('available') ? 'has-error' : '']">
                                        <label for="available" class="required">Limite</label>

                                        <input type="number" min="0" class="control" name="available"  v-validate="'required|numeric'" value="{{$service->available}}">

                                        <span class="control-error" v-if="errors.has('available')">@{{ errors.first('available') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
                                        <label for="description" class="required">Descripción</label>

                                        <input type="text" class="control" name="description" v-validate="'required'" value="{{$service->description}}">

                                        <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </form>
          {!! view_render_event('flawless.agenda.admin.services.edit.after', ['service' => $service]) !!}
        </script>

        <script>
            Vue.component('update-service', {
                template: '#update-service-form-template',

                inject: [ '$validator'],

                data () {
                    return {
                      name: null,
                      day: null,
                      group_id: null,
                      price: 0,
                      duration: '15',
                      available: 0,
                    }
                }
            });
        </script>
    @endpush
@stop
