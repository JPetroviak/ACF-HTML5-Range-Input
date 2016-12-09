<?php
class acf_field_range extends acf_field {
	function __construct() {
		$this->version = '1.0.2';
		$this->name = 'range';
		$this->label = __('Range', 'acf-range');
		$this->category = 'basic';
		$this->defaults = array(
			'default_value' => 0,
			'min_value'	=> 0,
			'max_value' => 100,
			'step_size' => 1,
			'units' => "%",
			'min_label' => '0%',
			'max_label' => '100%'
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

		acf_render_field_setting($field, array(
			'label'			=> __('Min Label','acf-range'),
			'instructions'	=> __('Enter a label for the minimum value','acf-range'),
			'type'			=> 'text',
			'name'			=> 'min_label',
		));

		acf_render_field_setting($field, array(
			'label'			=> __('Max Label','acf-range'),
			'instructions'	=> __('Enter a label for the maximum value','acf-range'),
			'type'			=> 'text',
			'name'			=> 'max_label',
		));
	}

	function render_field($field) {
		$default = (intval($field['default_value']) < intval($field['min_value'])) ? intval($field['default_value']) : intval($field['min_value']);
		$value = (isset($field['value'])) ? intval($field['value']) : $default;
		?>
		<p class="input-wrapper">
			<span class="input-helper"><?php echo $value; ?><?php echo esc_attr($field['units']); ?></span>
			<span class="range-label"><?php echo esc_attr($field['min_label']); ?></span>
			<input id="range" class="range" type="range" name="<?php echo $field['name'] ?>" min="<?php echo $field['min_value'] ?>" max="<?php echo $field['max_value']; ?>" step="<?php echo $field['step_size']; ?>" data-units="<?php echo $field['units']; ?>" value="<?php echo $value; ?>" />
			<span class="range-label"><?php echo esc_attr($field['max_label']); ?></span>
		</p>
		<?php
	}

	function input_admin_enqueue_scripts() {
		$directory = plugin_dir_url(__FILE__);
		wp_enqueue_style('range-styles', $directory . 'styles/range.css', array('acf-input'), $this->version);
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
