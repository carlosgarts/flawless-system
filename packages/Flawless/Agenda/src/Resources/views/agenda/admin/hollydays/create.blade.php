@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')

    <div class="content">
        <new-holyday></new-holyday>
    </div>

    @push('scripts')
        <script type="text/x-template" id="new-holyday-form-template">
            <form method="POST" action="{{ route('agenda.hollydays.store') }}">
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

                                <div slot="body">
                                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="required">Nombre</label>

                                        <input type="text" class="control" name="name" v-model="name" v-validate="'required'" value="{{ old('name') }}">

                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>

                                    <date :name="day" dateFormat = "Y-m-d">
                                        <div class="control-group" :class="[errors.has('day') ? 'has-error' : '']">
                                            <label for="day">Dia</label>

                                            <input type="text" class="control" v-model="day" name="day" >

                                            <span class="control-error" v-if="errors.has('day')">@{{ errors.first('day') }}</span>
                                        </div>
                                    </date>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </script>

        <script>
            Vue.component('new-holyday', {
                template: '#new-holyday-form-template',

                inject: ['$validator'],

                data () {
                    return {
                        name: null,
                        day: null
                    }
                }
            });
        </script>
    @endpush
@stop
