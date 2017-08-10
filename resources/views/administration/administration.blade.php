@extends('template')

@section('titre')
    Translator - Admin
@endsection

@section('contenu')
    <div class="row">
        {{ Form::open(array('url' => 'admin/import', 'files' => true)) }}
        <div class="panel panel-info col-lg-6 col-lg-push-3">
            <div class="panel-heading">Import</div>
            <div class="panel-body text-center">
                <div class="form-group {{ $errors->has('langage') ? 'has-error' : '' }}">
                    {{ Form::label('Langage', null, ['class' => 'pull-left']) }}
                    {{ Form::text('langage', null, ['class' => 'form-control']) }}
                    @if($errors->has('langage'))
                        <small class="help-block">{{ $errors->first('langage') }}</small>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('import') ? 'has-error' : '' }}">
                    {{ Form::file('import',
                    ['class' => 'filestyle',
                        'data-buttonBefore' => 'true',
                        'data-buttonName' => 'btn-info',
                        'data-icon' => 'false',
                        'data-placeholder' => 'no file',
                        'accept' => '.ini']) }}
                    @if($errors->has('import'))
                        <small class="help-block">{{$errors->first('import')}}</small>
                    @endif
                </div>
                {{ Form::submit('Import', ['class' => 'btn btn-info']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>

    <div class="row">
        {{ Form::open(array('url' => 'admin/export', 'files' => true, 'class' => 'form-inline')) }}
        <div class="panel panel-info col-lg-6 col-lg-push-3">
            <div class="panel-heading">Export</div>
            <div class="panel-body text-center">
                <div class="form-group {{$errors->has('export') ? 'has-error' : ''}}">
                    <select class="form-control" id="langage" name="langage">
                        @foreach($langages as $langage)
                            <option value="{{ $langage->id }}">{{ $langage->langage }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('export'))
                        <small class="help-block">{{$errors->first('export')}}</small>
                    @endif
                </div>
                {{ Form::submit('Export', ['class' => 'btn btn-info']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection