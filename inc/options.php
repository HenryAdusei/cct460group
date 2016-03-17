<?php
	
function authentic_add_submenu() {
		add_submenu_page( 'themes.php', 'Theme Options', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
	}
add_action( 'admin_menu', 'authentic_add_submenu' );
	

function authentic_settings_init() { 
	register_setting( 'theme_options', 'authentic_options_settings' );
	
	add_settings_section(
		'authentic_options_page_section', 
		'Changes to the site can be made through these options.', 
		'authentic_options_page_section_callback', 
		'theme_options'
	);
	
	function authentic_options_page_section_callback() { 
		echo 'Options include:';
	}

	add_settings_field( 
		'authentic_text_field', 
		'Enter your text', 
		'authentic_text_field_render', 
		'theme_options', 
		'authentic_options_page_section' 
	);

	add_settings_field( 
		'authentic_checkbox_field', 
		'Check your preference', 
		'authentic_checkbox_field_render', 
		'theme_options', 
		'authentic_options_page_section'  
	);

	add_settings_field( 
		'authentic_radio_field', 
		'Choose an option', 
		'authentic_radio_field_render', 
		'theme_options', 
		'authentic_options_page_section'  
	);
	
	add_settings_field( 
		'authentic_textarea_field', 
		'Enter content in the textarea', 
		'authentic_textarea_field_render', 
		'theme_options', 
		'authentic_options_page_section'  
	);
	
	add_settings_field( 
		'authentic_select_field', 
		'Choose from the dropdown', 
		'authentic_select_field_render', 
		'theme_options', 
		'authentic_options_page_section'  
	);

	function authentic_text_field_render() { 
		$options = get_option( 'authentic_options_settings' );
		?>
		<input type="text" name="authentic_options_settings[authentic_text_field]" value="<?php if (isset($options['authentic_text_field'])) echo $options['authentic_text_field']; ?>" />
		<?php
	}
	
	function authentic_checkbox_field_render() { 
		$options = get_option( 'authentic_options_settings' );
	?>
		<input type="checkbox" name="authentic_options_settings[authentic_checkbox_field]" <?php if (isset($options['authentic_checkbox_field'])) checked( 'on', ($options['authentic_checkbox_field']) ) ; ?> value="on" />
		<label>Turn it On</label> 
		<?php	
	}
	
	function authentic_radio_field_render() { 
		$options = get_option( 'authentic_options_settings' );
		?>
		<input type="radio" name="authentic_options_settings[authentic_radio_field]" <?php if (isset($options['authentic_radio_field'])) checked( $options['authentic_radio_field'], 1 ); ?> value="1" /> <label>Option One</label><br />
		<input type="radio" name="authentic_options_settings[authentic_radio_field]" <?php if (isset($options['authentic_radio_field'])) checked( $options['authentic_radio_field'], 2 ); ?> value="2" /> <label>Option Two</label><br />
		<input type="radio" name="authentic_options_settings[authentic_radio_field]" <?php if (isset($options['authentic_radio_field'])) checked( $options['authentic_radio_field'], 3 ); ?> value="3" /> <label>Option Three</label>
		<?php
	}
	
	function authentic_textarea_field_render() { 
		$options = get_option( 'authentic_options_settings' );
		?>
		<textarea cols="40" rows="5" name="authentic_options_settings[authentic_textarea_field]"><?php if (isset($options['authentic_textarea_field'])) echo $options['authentic_textarea_field']; ?></textarea>
		<?php
	}

	function authentic_select_field_render() { 
		$options = get_option( 'authentic_options_settings' );
		?>
		<select name="authentic_options_settings[authentic_select_field]">
			<option value="1" <?php if (isset($options['authentic_select_field'])) selected( $options['authentic_select_field'], 1 ); ?>>Option 1</option>
			<option value="2" <?php if (isset($options['authentic_select_field'])) selected( $options['authentic_select_field'], 2 ); ?>>Option 2</option>
		</select>
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
