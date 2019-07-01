@extends('admin::layouts.content')

@section('page_title')
Flawless Citas
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('agenda.groups.store') }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/groups') }}';"></i>

                        Grupo de servicios

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar Grupo
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()

                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name" class="required">Nombre</label>
                        <input type="text" class="control" name="name" v-validate="'required'" value="{{ old('name') }}">
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
                        <label for="description" class="required">Descripción</label>
                        <input type="textarea" class="control" name="description" v-validate="'required'" value="{{ old('description') }}" >
                        <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                    </div>

                </div>
            </div>
        </form>
    </div>
@stop
