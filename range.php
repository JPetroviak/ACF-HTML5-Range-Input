<?php
class acf_field_range extends acf_field {
	function __construct() {
		$this->name = 'range';
		$this->label = __('Range', 'acf-range');
		$this->category = 'basic';
		$this->defaults = array(
			'default_value' => 0,
			'min_value'	=> 0,
			'max_value' => 100,
			'step_size' => 1,
			'units' => "%",
		);
		parent::__construct();
	}

	function render_field_settings($field) {
		acf_render_field_setting($field, array(
			'label'			=> __('Default Value','acf-range'),
			'instructions'	=> __('Appears when creating a new post','acf-range'),
			'type'			=> 'number',
			'name'			=> 'default_value',
		));

		acf_render_field_setting($field, array(
			'label'			=> __('Minimum Value','acf-range'),
			'type'			=> 'number',
			'name'			=> 'min_value',
		));

		acf_render_field_setting($field, array(
			'label'			=> __('Maximum Value','acf-range'),
			'type'			=> 'number',
			'name'			=> 'max_value',
		));

		acf_render_field_setting($field, array(
			'label'			=> __('Step Size','acf-range'),
			'type'			=> 'number',
			'name'			=> 'step_size',
		));

		acf_render_field_setting($field, array(
			'label'			=> __('Units','acf-range'),
			'instructions'	=> __('Enter the units to measure by','acf-range'),
			'type'			=> 'text',
			'name'			=> 'units',
		));
	}

	function render_field($field) {
		$default = (intval($field['default_value']) < intval($field['min_value'])) ? intval($field['default_value']) : intval($field['min_value']);
		$value = (isset($field['value'])) ? intval($field['value']) : $default;
		?>
		<input id="range" class="range" type="range" name="<?php echo $field['name'] ?>" min="<?php echo $field['min_value'] ?>" max="<?php echo $field['max_value']; ?>" step="<?php echo $field['step_size']; ?>" data-units="<?php echo $field['units']; ?>" value="<?php echo $value; ?>" />
		<p class="input-helper"><?php echo $value; ?><?php echo $field['units']; ?></p>
		<?php
	}

	function input_admin_enqueue_scripts() {
		$directory = plugin_dir_url(__FILE__);
		wp_enqueue_style('range-styles', $directory . 'styles/range.css', '', $this->version);
		wp_enqueue_script('range-scripts', $directory . 'scripts/range.js', array('jquery'), $this->version, false);
	}

	function load_value($value, $post_id, $field) {
		return (int)$value;
	}

	function update_value($value, $post_id, $field) {
		return (int)$value;
	}

	function format_value($value, $post_id, $field) {
		return (int)$value;
	}
}

new acf_field_range();
