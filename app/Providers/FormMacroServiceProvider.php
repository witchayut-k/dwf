<?php 

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

/**
 * Class FormMacroServiceProvider
 * @package App\Providers
 */
class FormMacroServiceProvider extends ServiceProvider {

	public function boot()
	{
		Form::macro('groupText', function ($name, $label, $data = null, $options = array()) {
			$options = collect($options);
			$helpText = "";
			if ($options->has('class'))
				$options['class'] .= " form-control";
			else
				$options['class'] = "form-control";

			if ($options->has('helptext'))
				$helpText = '<span class="help-block">'.$options['helptext'].'</span>';

			$options = $options->merge(['autocomplete'=>'off']);

			return '<div class="form-group">'.
						Form::label($name, $label, ['class'=>'control-label']).
						Form::text($name, $data, $options->toArray()).
						$helpText
					.'</div>';
		});

		Form::macro('groupNumber', function ($name, $label, $data = null, $options = array()) {
			$options = collect($options);
			$helpText = "";
			if ($options->has('class'))
				$options['class'] .= " form-control";
			else
				$options['class'] = "form-control";

			if ($options->has('helptext'))
				$helpText = '<span class="help-block">'.$options['helptext'].'</span>';

			$options = $options->merge(['autocomplete'=>'off']);

			return '<div class="form-group">'.
						Form::label($name, $label, ['class'=>'control-label']).
						Form::number($name, $data, $options->toArray()).
						$helpText
					.'</div>';
		});

		Form::macro('groupTextArea', function ($name, $label, $data = null, $options = array()) {
			$options = collect($options);
			if ($options->has('class'))
				$options['class'] .= " form-control";
			else
				$options['class'] = "form-control";

			$options = $options->merge(['autocomplete'=>'off']);

			return '<div class="form-group">'.
						Form::label($name, $label, ['class'=>'control-label']).
						Form::textarea($name, $data, $options->toArray())
					.'</div>';
		});

		Form::macro('groupEmail', function ($name, $label, $data = null, $options = array()) {
			$options = collect($options);
			if ($options->has('class'))
				$options['class'] .= " form-control";
			else
				$options['class'] = "form-control";

			$options = $options->merge(['autocomplete'=>'off']);

			return '<div class="form-group">'.
						Form::label($name, $label, ['class'=>'control-label']).
						Form::email($name, $data, $options->toArray())
					.'</div>';
		});
		
		Form::macro('groupPassword', function ($name, $label, $data = null, $options = "") {
			return '<div class="form-group">'.
						Form::label($name, $label, ['class'=>'control-label']).
						'<input type="password" name="'.$name.'" class="form-control" value="'.old('password_confirmation').'" '.$options.'>'
					.'</div>';
		});
		
		Form::macro('groupSelect', function ($name, $label, $items = null, $data = null, $options = array()) {
			$options = collect($options);
			if ($options->has('class'))
				$options['class'] .= " form-control bs-select";
			else
				$options['class'] = "form-control bs-select";

			return '<div class="form-group">'.
						Form::label($name, $label, ['class'=>'control-label']).
						Form::select($name, $items, $data, $options->toArray())
					.'</div>';
		});


		Form::macro('groupTextFREditor', function ($name, $label, $data = null) {
            return '<div class="form-group froala">' .
                ($label ? '<label class="control-label">'.$label.'</label>' : '').
                '<div class="fr-editor" id="'.str_replace("_", "-", $name).'">'.$data.'</div>'.
                '<textarea style="display:none;" name="'.$name.'" />'.$data.'</textarea>'.
            '</div>';
        });
        Form::macro('groupTextAreaFREditor', function ($name, $label, $data = null) {
            return '<div class="form-group froala">' .
                ($label ? '<label class="control-label">'.$label.'</label>' : '').
                '<div class="fr-textarea-editor" id="'.str_replace("_", "-", $name).'">'.$data.'</div>'.
                '<textarea style="display:none;" name="'.$name.'" />'.$data.'</textarea>'.
            '</div>';
        });

		// Summernote

        Form::macro('groupSummernoteEditor', function ($name, $label, $data = null) {
            return '<div class="form-group">' .
                ($label ? '<label class="control-label">'.$label.'</label>' : '').
                '<textarea class="editor-summernote" name="'.$name.'" id="'.str_replace("_", "-", $name).'">'.$data.'</textarea>'.
            '</div>';
        });
	}

	/**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}