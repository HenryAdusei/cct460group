<?php
	
function authentic_add_submenu() {
		add_submenu_page( 'themes.php', 'Theme Options', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
	}
add_action( 'admin_menu', 'authentic_add_submenu' );
	

function authentic_settings_init() { 
	register_setting( 'theme_options', 'authentic_options_settings' );
	
	add_settings_section(
		'authentic_options_page_section', 
		'Please select changes you would like to make to the theme here.', 
		'authentic_options_page_section_callback', 
		'theme_options'
	);
	
	function authentic_options_page_section_callback() { 
		echo 'Options include:';
	}

		add_settings_field( 
		'authentic_select_field', 
		'Background Color -', 
		'authentic_select_field_render', 
		'theme_options', 
		'authentic_options_page_section'  
	);
	
	add_settings_field( 
		'authentic_checkbox_field', 
		'Other -', 
		'authentic_checkbox_field_render', 
		'theme_options', 
		'authentic_options_page_section'  
	);
	
	function authentic_select_field_render() { 
		$options = get_option( 'authentic_options_settings' );
		?>
		<select name="authentic_options_settings[authentic_select_field]">
		<option value="1" <?php if (isset($options['authentic_select_field'])) selected( $options['authentic_select_field'], 1 ); ?>>Grey</option>
		<option value="2" <?php if (isset($options['authentic_select_field'])) selected( $options['authentic_select_field'], 2 ); ?>>Red</option>
		<option value="3" <?php if (isset($options['authentic_select_field'])) selected( $options['authentic_select_field'], 3 ); ?>>Blue</option>
		</select>
	<?php
	}
	
	function authentic_checkbox_field_render() { 
		$options = get_option( 'authentic_options_settings' );
	?>
		<input type="checkbox" name="authentic_options_settings[authentic_checkbox_field]" <?php if (isset($options['authentic_checkbox_field'])) checked( 'on', ($options['authentic_checkbox_field']) ) ; ?> value="on" />
		<label>Borders</label>
		<br>
		<input type="checkbox" name="authentic_options_settings[authentic_checkbox_field]" <?php if (isset($options['authentic_checkbox_field'])) checked( 'on', ($options['authentic_checkbox_field']) ) ; ?> value="on" />
		<label>Font</label>
		<br>
		<input type="checkbox" name="authentic_options_settings[authentic_checkbox_field]" <?php if (isset($options['authentic_checkbox_field'])) checked( 'on', ($options['authentic_checkbox_field']) ) ; ?> value="on" />
		<label>Line Spacing</label> 
		<?php	
	}
	
	function my_theme_options_page(){ 
		?>
		<form action="options.php" method="post">
			<h2>Theme Options</h2>
			<?php
			settings_fields( 'theme_options' );
			do_settings_sections( 'theme_options' );
			submit_button();
			?>
		</form>
		<?php
	}

}

add_action( 'admin_init', 'authentic_settings_init' );
