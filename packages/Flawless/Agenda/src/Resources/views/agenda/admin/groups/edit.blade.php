@extends('admin::layouts.content')

@section('page_title')
    Flawless Citas
@stop

@section('content')
    <div class="content">
        {!! view_render_event('flawless.agenda.admin.groups.edit.before', ['group' => $group]) !!}

        <form method="POST" action="{{ route('agenda.groups.update', $group->id) }}">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/agenda/groups') }}';"></i>

                        Editar Grupo de Servicios
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar Cambios
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()

                    <input name="_method" type="hidden" value="PUT">

                        <div slot="body">

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"> Nombre</label>
                                <input type="text"  class="control" name="name" v-validate="'required'" value="{{$group->name}}"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
                                <label for="description" class="required"> Descripción</label>
                                <input type="textarea"  class="control"  name="description"   v-validate="'required'" value="{{$group->description}}"/>
                                <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                            </div>

                        </div>

                </div>
            </div>
        </form>

        {!! view_render_event('flawless.agenda.admin.groups.edit.after', ['group' => $group]) !!}
    </div>
@stop
