@extends('template')

@section('titre')
    Translator
@endsection

@section('contenu')
    {{Form::open(['url' => 'valid', 'id' => 'formTranslation'])}}
        <div class="row">
            <div class="panel panel-info col-lg-4 col-lg-push-1">
                <div class="panel-heading">English</div>
                <div class="panel-body">
                    <div class="form-group {{$errors->has('english') ? 'has-error' : ''}}">
                        {{Form::textarea('english', 'English text',
                        ['class' => 'form-control',
                        'placeholder' => 'English text', 'readonly',
                        'id' => 'textarea_English'])}}
                        @if($errors->has('english'))
                            <small class="help-block">{{$errors->first('english')}}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-info col-lg-4 col-lg-push-2">
                <div class="panel-heading">French</div>
                <div class="panel-body">
                    <div class="form-group {{$errors->has('french') ? 'has-error' : ''}}">
                        {{Form::textarea('french', 'French text',
                        ['class' => 'form-control',
                        'placeholder' => 'French text',
                        'id' => 'textarea_Translation'])}}
                        @if($errors->has('french'))
                            <small class="help-block">{{$errors->first('french')}}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{ Form::submit('Validate',
        ['class' => 'btn btn-info pull-right',
        'style' => 'margin-right: 15%; margin-top: 25px; display: none',
        'name' => 'submit',
        'id' => 'changeButton',
        'value' => 'Validate']) }}
        {{ Form::submit('Skip',
        ['class' => 'btn btn-info pull-right',
        'style' => 'margin-right: 15px; margin-top: 25px; display: none',
        'name' => 'submit',
        'id' => 'skipButton',
        'value' => 'Skip']) }}
    {{ Form::close() }}
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if(isset($translation))
            const oldTranslation = "<?php echo str_replace('"', '\"', $translation->translation); ?>";
            $('textarea#textarea_Translation').val("<?php echo str_replace('"', '\"', $translation->translation); ?>");
        @endif
        @if(isset($english))
            $('textarea#textarea_English').val("<?php echo str_replace('"', '\"', $english->translation); ?>");
        @endif

        @if(isset($translation) && isset($english))
            $('input#changeButton').css({"display":"inline-block"});
            $('input#skipButton').css({"display":"inline-block"});
        @endif

        $('textarea#textarea_Translation').on('input propertychange paste', function() {
            let newTranslation = $('textarea#textarea_Translation').val();

            if(oldTranslation === newTranslation) {
                // Validate
                $('input#changeButton').attr('value', 'Validate');
            } else {
                // Modify
                $('input#changeButton').attr('value', 'Modify');
            }
        });
    });
</script>
@endsection