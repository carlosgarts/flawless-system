@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <new-service></new-service>
    </div>

    @push('scripts')
        <script type="text/x-template" id="new-service-form-template">
            <form method="POST" action="{{ route('agenda.services.store') }}">
                @csrf

                <div class="page-header">
                    <div class="page-title">
                        <h1>
                            <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/services') }}';"></i>

                            Nuevo Servicio
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

                                        <input type="text" class="control" name="name" v-model="name" v-validate="'required'" value="{{ old('name') }}">

                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('group_id') ? 'has-error' : '']">
                                        <label for="group_id" class="required">Grupo perteneciente</label>

                                        <select type="text" class="control" name="group_id" v-model="group_id" v-validate="'required'" value="{{ old('group_id') }}">
                                            <option disabled="disabled">Select Customer Groups</option>
                                            @foreach(app('Flawless\Agenda\Models\Group')->all() as $groups)
                                                <option value="{{ $groups->id }}">{{ $groups->name }}</option>
                                            @endforeach
                                        </select>

                                        <span class="control-error" v-if="errors.has('group_id')">@{{ errors.first('group_id') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('price') ? 'has-error' : '']">
                                        <label for="price" class="required">Precio</label>

                                        <input type="number" min="0" class="control" name="price" v-model="price" v-validate="'required|numeric'" value="{{ old('price') }}">

                                        <span class="control-error" v-if="errors.has('price')">@{{ errors.first('price') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('duration') ? 'has-error' : '']">
                                        <label for="duration" class="required">Duración</label>

                                        <select type="text" class="control" name="duration" v-model="duration" v-validate="'required'" value="{{ old('duration') }}">
                                                <option value="15">00:15</option>
                                                <option value="30">00:30</option>
                                                <option value="45">00:45</option>
                                                <option value="60">01:00</option>
                                                <option value="90">01:30</option>
                                                <option value="120">02:00</option>
                                                <option value="150">02:30</option>
                                                <option value="180">03:00</option>
                                                <option value="210">03:30</option>
                                                <option value="240">04:00</option>
                                                <option value="270">04:30</option>
                                                <option value="300">05:00</option>
                                                <option value="330">05:30</option>
                                                <option value="360">06:00</option>
                                        </select>

                                        <span class="control-error" v-if="errors.has('duration')">@{{ errors.first('duration') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('available') ? 'has-error' : '']">
                                        <label for="available" class="required">Limite</label>

                                        <input type="number" min="0" class="control" name="available" v-model="available" v-validate="'required|numeric'" value="{{ old('available') }}">

                                        <span class="control-error" v-if="errors.has('available')">@{{ errors.first('available') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
                                        <label for="description" class="required">Descripción</label>

                                        <input type="text" class="control" name="description" v-validate="'required'" value="{{ old('description') }}">

                                        <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </script>

        <script>
            Vue.component('new-service', {
                template: '#new-service-form-template',

                inject: ['$validator'],

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
