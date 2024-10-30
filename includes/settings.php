<?php
/******************************************************************************************
	Страница настроек плагина
	
*******************************************************************************************/
function bg_forreaders_options_page() {
	global $formats;
	global $bg_forreaders_mimes;
	
	bg_forreaders_add_options ();

	$active_tab = 'general';
	if( isset( $_GET[ 'tab' ] ) ) $active_tab = $_GET[ 'tab' ];
	?>
	<div class="wrap">
		<h2><?php _e('Plugin\'s &#171;For Readers&#187; settings', 'bg-forreaders') ?></h2>
		<div id="bg_forreaders_resalt"></div>
		<p><?php printf( __( 'Version', 'bg-forreaders' ).' <b>'.bg_forreaders_version().'</b>' ); ?></p>

		<h2 class="nav-tab-wrapper">
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General', 'bg-forreaders') ?></a>
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=system" class="nav-tab <?php echo $active_tab == 'system' ? 'nav-tab-active' : ''; ?>"><?php _e('System settings', 'bg-forreaders') ?></a>
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=options" class="nav-tab <?php echo $active_tab == 'options' ? 'nav-tab-active' : ''; ?>"><?php _e('Options', 'bg-forreaders') ?></a>
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=css" class="nav-tab <?php echo $active_tab == 'css' ? 'nav-tab-active' : ''; ?>"><?php _e('CSS', 'bg-forreaders') ?></a> 
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=html" class="nav-tab <?php echo $active_tab == 'html' ? 'nav-tab-active' : ''; ?>"><?php _e('HTML', 'bg-forreaders') ?></a> 
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=cron" class="nav-tab <?php echo $active_tab == 'cron' ? 'nav-tab-active' : ''; ?>"><?php _e('WP Cron', 'bg-forreaders') ?></a> 
		<?php if (file_exists(BG_FORREADERS_URI.'/forreaders.php')) : ?>
			<a href="?page=bg-forreaders%2Fbg-forreaders.php&tab=batch" class="nav-tab <?php echo $active_tab == 'batch' ? 'nav-tab-active' : ''; ?>"><?php _e('Batch mode', 'bg-forreaders') ?></a> 
		<?php endif; ?>
		</h2>

		<form id="bg_forreaders_options" method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>

	<!-- Общие Настройки -->
			<?php if ($active_tab == 'general') { ?>

				<table class="form-table">

				<tr valign="top">
				<th scope="row"><?php _e('File types', 'bg-forreaders') ?></th>
				<td>
				<?php foreach ($formats as $type => $document_type) { ?>
					<input type="checkbox" name="bg_forreaders_<?php echo $type ?>" <?php if(get_option('bg_forreaders_'.$type)) echo "checked" ?> value="on" /> <?php  echo $document_type ?>&nbsp;&nbsp; 
				<?php } ?>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Type of download links', 'bg-forreaders') ?></th>
				<td>
				<input type="radio" name="bg_forreaders_links" <?php if(get_option('bg_forreaders_links') == "php") echo "checked" ?> value="php" /> <?php _e('using php-script', 'bg-forreaders') ?><br /> 
				<input type="radio" name="bg_forreaders_links" <?php if(get_option('bg_forreaders_links') == "html5") echo "checked" ?> value="html5" /> <?php _e('using html5 atribute "download"', 'bg-forreaders') ?><br /> 
				<input type="radio" name="bg_forreaders_links" <?php if(get_option('bg_forreaders_links') == "html") echo "checked" ?> value="html" /> <?php _e('simple html link', 'bg-forreaders') ?>
				</td>
				</tr>
				
				<tr valign="top">
				<th scope="row"><?php _e('Location of download links', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_before" <?php if(get_option('bg_forreaders_before')) echo "checked" ?> value="on" /> <?php _e('before the text', 'bg-forreaders') ?><br /> 
				<input type="checkbox" name="bg_forreaders_after" <?php if(get_option('bg_forreaders_after')) echo "checked" ?> value="on" /> <?php _e('after the text', 'bg-forreaders') ?>
				</td>
				</tr>
				
				<tr valign="top">
				<th scope="row"><?php _e('Prompt to download', 'bg-forreaders') ?></th>
				<td>
				<input type="text" name="bg_forreaders_prompt" value="<?php echo get_option('bg_forreaders_prompt'); ?>" size="60" /><br>
				<?php _e('(you can use html-tags in the text)', 'bg-forreaders') ?>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Separator', 'bg-forreaders') ?></th>
				<td>
				<input type="text" name="bg_forreaders_separator" value="<?php echo get_option('bg_forreaders_separator'); ?>" size="60" /><br>
				<?php _e('(you can use html-tags in the text)', 'bg-forreaders') ?>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Icon size', 'bg-forreaders') ?></th>
				<td>
				<input type="range" name="bg_forreaders_zoom" min="0" max="1" step="0.2" value="<?php echo get_option('bg_forreaders_zoom'); ?>" onchange="document.getElementById('bg_forreaders_zoom_value').innerHTML=100*this.value;" /> <span id="bg_forreaders_zoom_value"><?php echo (100*get_option('bg_forreaders_zoom')); ?></span>%</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Show icons on the single post only', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_single" <?php if(get_option('bg_forreaders_single')) echo "checked" ?> value="on" /> 
				</td>
				</tr>
				
				<tr valign="top">
				<th scope="row"><?php _e('Create files for readers by default', 'bg-forreaders') ?></th>
				<td>
				<b><?php _e('Categories', 'bg-forreaders') ?>:</b>&nbsp;&nbsp;
				<input type="radio" name="bg_forreaders_cats" <?php if(get_option('bg_forreaders_cats')=='allowed') echo "checked" ?> value="allowed" /> <?php _e('allowed', 'bg-forreaders') ?>&nbsp;
				<input type="radio" name="bg_forreaders_cats" <?php if(get_option('bg_forreaders_cats')=='excluded') echo "checked" ?> value="excluded" /> <?php _e('excluded', 'bg-forreaders') ?><br>
				<input type="text" name="bg_forreaders_excat" value="<?php echo get_option('bg_forreaders_excat'); ?>" size="60" /><br>
				<i><?php _e('(to allow/exclude prepartion of the post for readers enter the category slugs separated by commas)', 'bg-forreaders') ?></i><br><br>
				<b><?php _e('Post type', 'bg-forreaders') ?>:</b>&nbsp;&nbsp;
				<input type="checkbox" name="bg_forreaders_type_page" <?php if(get_option('bg_forreaders_type_page')) echo "checked" ?> value="on" />&nbsp;<code>'page'</code>&nbsp;&nbsp;
				<input type="checkbox" name="bg_forreaders_type_post" <?php if(get_option('bg_forreaders_type_post')) echo "checked" ?> value="on" />&nbsp;<code>'post'</code> 
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('When will created files for readers?', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_while_displayed" <?php if(get_option('bg_forreaders_while_displayed')) echo "checked" ?> value="on" /> <?php _e('while current post is displayed', 'bg-forreaders') ?><br /> 
				<input type="checkbox" name="bg_forreaders_while_saved" <?php if(get_option('bg_forreaders_while_saved')) echo "checked" ?> value="on" /> <?php _e('while current post is saved', 'bg-forreaders') ?><br />
				<input type="checkbox" name="bg_forreaders_offline_query" <?php if(get_option('bg_forreaders_offline_query')) echo "checked" ?> value="on" /> <?php _e('in offline query from stack', 'bg-forreaders') ?>&nbsp;
				<?php 
					$stack = get_option ('bg_forreaders_stack');
					if (isset($stack)){
						$cnt = count($stack); 
						echo sprintf( _n( '(%s element in stack now)', '(%s elements in stack now)', $cnt, 'bg-forreaders' ), $cnt );
					}
				?>
				</td>
				</tr>
				
				<tr valign="top">
				<th scope="row"><?php _e('Generate OPDS catalogue?', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_generate_opds" <?php if(get_option('bg_forreaders_generate_opds')) echo "checked" ?> value="on" /> <code><?php echo OPDS_FEED; ?></code><br /> 
				<i><?php _e('(for post type "post" only)', 'bg-forreaders') ?></i>
				</td>
				</tr>
				
				<tr valign="top">
				<th scope="row"><?php _e('Upload books to bg_forreaders folder', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_book_folder" <?php if(get_option('bg_forreaders_book_folder')) echo "checked" ?> value="on" /> <?php printf(__('Uploades book files to <code>%s</code> folder when you use Add Media button on the edit screen', 'bg-forreaders'), BG_FORREADERS_STORAGE_PATH); ?><br />
				<i><?php printf(__('(for file type <code>%s</code>)', 'bg-forreaders'), implode (',', array_keys($bg_forreaders_mimes))) ?></i>
				</td>
				</tr>
				
				</table>

				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="bg_forreaders_pdf, bg_forreaders_epub, bg_forreaders_mobi,	bg_forreaders_fb2, 
							bg_forreaders_links, bg_forreaders_before, bg_forreaders_after, bg_forreaders_prompt, bg_forreaders_separator,
							bg_forreaders_zoom, bg_forreaders_single, bg_forreaders_cats, bg_forreaders_excat,
							bg_forreaders_type_page, bg_forreaders_type_post,
							bg_forreaders_while_displayed, bg_forreaders_while_saved, bg_forreaders_offline_query,
							bg_forreaders_generate_opds, bg_forreaders_book_folder" />

				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>

	<!-- Системные настройки -->
			<?php } elseif ($active_tab == 'system') { ?>
			
				<table class="form-table">
				
				<tr valign="top">
				<th scope="row"><?php _e('PHP version', 'bg-forreaders') ?></th>
				<td>
				<span><?php echo PHP_VERSION; ?>&nbsp;/&nbsp;<?php echo (PHP_INT_SIZE * 8) . __('Bit OS'); ?></span>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Memory limit', 'bg-forreaders') ?></th>
				<td>
				<?php bg_forreaders_memory_usage (); ?>
				<?php _e('Set memory limit:', 'bg-forreaders') ?><br>
				<input type="number" name="bg_forreaders_memory_limit" value="<?php echo get_option('bg_forreaders_memory_limit'); ?>" min="0" /> <?php _e('MB', 'bg-forreaders') ?>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Time limit', 'bg-forreaders') ?></th>
				<td>
				<?php bg_forreaders_time_limit (); ?>
				<?php _e('Set time limit:', 'bg-forreaders') ?><br>
				<input type="number" name="bg_forreaders_time_limit" value="<?php echo get_option('bg_forreaders_time_limit'); ?>" min="0" /> <?php _e('sec.', 'bg-forreaders') ?>
				</td>
				</tr>

				</table>

				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="bg_forreaders_memory_limit, bg_forreaders_time_limit" />

				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>

	<!-- Прочие настройки -->
			<?php } elseif ($active_tab == 'options') { ?>

				<table class="form-table">

				<tr valign="top">
				<th scope="row"><?php _e('Custom field for author name', 'bg-forreaders') ?></th>
				<td>
				<input type="text" name="bg_forreaders_author_field" value="<?php echo get_option('bg_forreaders_author_field'); ?>" size="60" /><br>
				<i><?php _e('(if you specify as "post", author is post author)', 'bg-forreaders') ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Custom field for publishing year', 'bg-forreaders') ?></th>
				<td>
				<input type="text" name="bg_forreaders_publishing_year" value="<?php echo get_option('bg_forreaders_publishing_year'); ?>" size="60" /><br>
				<i><?php _e('(if you specify as "post", publishing year is publishing year of the post)', 'bg-forreaders') ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Genre', 'bg-forreaders') ?></th>
				<td>
				<input type="text" name="bg_forreaders_genre" value="<?php echo get_option('bg_forreaders_genre'); ?>" size="60" /><br>
				<i><?php _e('(if you specify as "genre", genre is content of custom fields "genre")', 'bg-forreaders') ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Book header in  the text', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_add_title" <?php if(get_option('bg_forreaders_add_title')) echo "checked" ?> value="on" />&nbsp;<?php _e('add book title', 'bg-forreaders') ?>&nbsp;&nbsp;
				<input type="checkbox" name="bg_forreaders_add_author" <?php if(get_option('bg_forreaders_add_author')) echo "checked" ?> value="on" />&nbsp;<?php _e('add book author', 'bg-forreaders') ?>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Cover content', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_cover_title" <?php if(get_option('bg_forreaders_cover_title')) echo "checked" ?> value="on" id="bg_forreaders_cover" onchange="bg_forreaders_trigger_show_cover ();" />&nbsp;<?php _e('title', 'bg-forreaders') ?>&nbsp;&nbsp;
				<span  class="bg_forreaders_cover">
				<input type="checkbox" name="bg_forreaders_cover_author" <?php if(get_option('bg_forreaders_cover_author')) echo "checked" ?> value="on" />&nbsp;<?php _e('author', 'bg-forreaders') ?>&nbsp;&nbsp;
				<input type="checkbox" name="bg_forreaders_cover_site" <?php if(get_option('bg_forreaders_cover_site')) echo "checked" ?> value="on" />&nbsp;<?php _e('site name', 'bg-forreaders') ?>&nbsp;&nbsp;
				<input type="checkbox" name="bg_forreaders_cover_year" <?php if(get_option('bg_forreaders_cover_year')) echo "checked" ?> value="on" />&nbsp;<?php _e('year', 'bg-forreaders') ?>
				</span>
				</td>
				</tr>

				<tr valign="top"  class="bg_forreaders_cover">
				<th scope="row"><?php _e('Use post thumbnail as cover', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_cover_thumb" <?php if(get_option('bg_forreaders_cover_thumb')) echo "checked" ?> value="on" />&nbsp;
				<i><?php _e('(If there is post thumbnail, it will be used as cover)', 'bg-forreaders') ?></i>
				</td>
				</tr>

				<tr valign="top"  class="bg_forreaders_cover">
				<th scope="row"><?php _e('Cover image template', 'bg-forreaders') ?></th>
				<td>
				<input type="text" name="bg_forreaders_cover_image" value="<?php echo get_option('bg_forreaders_cover_image'); ?>" size="60" /><br>
				<i><?php _e('(png, gif or jpg file. Size: 840x1188px)', 'bg-forreaders') ?></i><br>
				<?php printf(__('The image file must be located in a folder', 'bg-forreaders')." <code>/". BG_FORREADERS_STORAGE_PATH."/</code>" ) ?>
				</td>
				</tr>

				<tr valign="top"  class="bg_forreaders_cover">
				<th scope="row"><?php _e('Сolors', 'bg-forreaders') ?></th>
				<td>
				<?php _e('text:', 'bg-forreaders') ?>&nbsp;<input type="color" name="bg_forreaders_text_color" value="<?php echo get_option('bg_forreaders_text_color'); ?>" />&nbsp;&nbsp;
				<?php _e('background:', 'bg-forreaders') ?>&nbsp;<input type="color" name="bg_forreaders_bg_color" value="<?php echo get_option('bg_forreaders_bg_color'); ?>" />
				</td>
				</tr>

				<tr valign="top"  class="bg_forreaders_cover">
				<th scope="row"><?php _e('Offset of the text field on the cover', 'bg-forreaders') ?></th>
				<td>
				<table>
					<tr>
					<td><?php _e('left:', 'bg-forreaders') ?></td>
					<td><input type="number" name="bg_forreaders_left_offset" value="<?php echo get_option('bg_forreaders_left_offset'); ?>" style="width: 80px;" /> px</td>
					<td><?php _e('right:', 'bg-forreaders') ?></td>
					<td><input type="number" name="bg_forreaders_right_offset" value="<?php echo get_option('bg_forreaders_right_offset'); ?>" style="width: 80px;" /> px</td>
					</tr>
					<tr>
					<td><?php _e('top:', 'bg-forreaders') ?></td>
					<td><input type="number" name="bg_forreaders_top_offset" value="<?php echo get_option('bg_forreaders_top_offset'); ?>" style="width: 80px;" /> px</td>
					<td><?php _e('bottom:', 'bg-forreaders') ?></td>
					<td><input type="number" name="bg_forreaders_bottom_offset" value="<?php echo get_option('bg_forreaders_bottom_offset'); ?>" style="width: 80px;" /> px</td>
					</tr>
				</table>
				</td>
				</tr>

				</table>

				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="bg_forreaders_author_field, bg_forreaders_publishing_year, bg_forreaders_genre, 
							bg_forreaders_add_title, bg_forreaders_add_author, 
							bg_forreaders_cover_author, bg_forreaders_cover_title, bg_forreaders_cover_site, bg_forreaders_cover_year,
							bg_forreaders_cover_thumb, bg_forreaders_cover_image, bg_forreaders_text_color, bg_forreaders_bg_color, 
							bg_forreaders_left_offset, bg_forreaders_right_offset, bg_forreaders_top_offset, bg_forreaders_bottom_offset" />

				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
				<script>
					function bg_forreaders_trigger_show_cover () {
						if (document.getElementById('bg_forreaders_cover').checked) jQuery('.bg_forreaders_cover').show();
						else jQuery('.bg_forreaders_cover').hide();
					}
					bg_forreaders_trigger_show_cover ();
				</script>
	<!-- Настройка таблицы стилей -->
			<?php } elseif ($active_tab == 'css') { ?>
				<table class="form-table">

				<tr valign="top">
				<th scope="row"><?php _e('CSS styles table', 'bg-forreaders') ?></th>
				<td>
				<textarea name="bg_forreaders_css" rows="10" cols="60"><?php echo get_option('bg_forreaders_css'); ?></textarea><br>
				<i><?php _e('Enter the css styling table for display text in readers.', 'bg-forreaders') ?></i>
				</td>
				</tr>
				
				</table>

				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="bg_forreaders_css" />

				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
					
	<!-- Ограничение использования HTML-тегов и их атрибутов -->
			<?php } elseif ($active_tab == 'html') { ?>
				<table class="form-table">

				<tr valign="top">
				<th scope="row"><?php _e('Allowed tags and attributes', 'bg-forreaders') ?></th>
				<td>
				<textarea name="bg_forreaders_tags" rows="10" cols="60"><?php echo get_option('bg_forreaders_tags'); ?></textarea><br>
				<i><?php _e('Enter the allowed tags separated by commas.', 'bg-forreaders') ?></i><br>
				<i><?php _e('Near in brackets enter the allowed attributes separated by vertical bar.', 'bg-forreaders') ?></i><br>
				<i><?php _e('(For example, a[href|name|id],b,strong,i,em,u)', 'bg-forreaders') ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('External links', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_extlinks" <?php if(get_option('bg_forreaders_extlinks')) echo "checked" ?> value="on" />	<i><?php _e('(If not allowed, the attribute href="..." with external link will removed from tag &lt;a&gt;).', 'bg-forreaders') ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Allow paragraphs in table cells of fb2', 'bg-forreaders') ?></th>
				<td>
				<input type="checkbox" name="bg_forreaders_allow_p" <?php if(get_option('bg_forreaders_allow_p')) echo "checked" ?> value="on" />	<i><?php _e('(Standard fb2 does not allow the paragraphs in the cells of the tables, but most readers understand the &lt;p&gt; and &lt;cite&gt; tags inside &lt;td&gt;).', 'bg-forreaders') ?></i>
				</td>
				</tr>

				</table>

				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="bg_forreaders_tags, bg_forreaders_extlinks, bg_forreaders_allow_p" />

				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>

	<!-- WP Cron  -->
			<?php } elseif ($active_tab == 'cron') { ?>
			<?php 
				$schedules = wp_get_schedules();
				asort ($schedules);
			?>
				<table class="form-table">

				<tr valign="top">
				<th scope="row"></th>
				<td>
				<i><?php _e('Now:', 'bg-forreaders');
				echo " <b>". date ('j-m-Y H:i')."</b> ".__('GMT', 'bg-forreaders'); ?></i>
				</td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php _e('Generate files for posts from stack', 'bg-forreaders') ?></th>
				<td>
				<select id='bg_forreaders_stack_interval' name='bg_forreaders_stack_interval'>
					<?php 
					foreach ($schedules as $schedule => $val) {
						if ($val['interval'] > 3600) continue;
						if (get_option('bg_forreaders_stack_interval') == $schedule) $selected = ' selected';
						else $selected = '';
						echo '<option value="'.$schedule.'"'.$selected.'>'.$val['display'].'</option>';
					}
					?>
				</select><br>
				<i><?php _e('Next time:', 'bg-forreaders');
				$next_time = wp_next_scheduled( 'bg_forreaders_stack_cron_action' );
				echo " ". ($next_time ? "<b>".date ('j-m-Y H:i', $next_time)."</b> ".__('GMT', 'bg-forreaders') : "<b>".__('never', 'bg-forreaders'))."</b>"; ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Generate files for all allowed posts', 'bg-forreaders') ?></th>
				<td>
				<select id='bg_forreaders_all_interval' name='bg_forreaders_all_interval'>
					<?php 
					foreach ($schedules as $schedule => $val) {
						if ($val['interval'] != 0 && $val['interval'] < 3600) continue;
						if (get_option('bg_forreaders_all_interval') == $schedule) $selected = ' selected';
						else $selected = '';
						echo '<option value="'.$schedule.'"'.$selected.'>'.$val['display'].'</option>';
					}
					?>
				</select>&nbsp;
				<?php _e('after', 'bg-forreaders') ?>&nbsp;
				<input type='time' name="bg_forreaders_all_checktime" value="<?php echo get_option('bg_forreaders_all_checktime'); ?>" />&nbsp;<?php _e('GMT', 'bg-forreaders') ?><br>
				<i><?php _e('Next time:', 'bg-forreaders');
				$next_time = wp_next_scheduled( 'bg_forreaders_all_cron_action' );
				echo " ". ($next_time ? "<b>".date ('j-m-Y H:i', $next_time)."</b> ".__('GMT', 'bg-forreaders') : "<b>".__('never', 'bg-forreaders'))."</b>"; ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Update Log file', 'bg-forreaders') ?></th>
				<td>
				<select id='bg_forreaders_log_interval' name='bg_forreaders_log_interval'>
					<?php 
					foreach ($schedules as $schedule => $val) {
						if ($val['interval'] != 0 && $val['interval'] < 3600) continue;
						if (get_option('bg_forreaders_log_interval') == $schedule) $selected = ' selected';
						else $selected = '';
						echo '<option value="'.$schedule.'"'.$selected.'>'.$val['display'].'</option>';
					}
					?>
				</select>&nbsp;
				<?php _e('after', 'bg-forreaders') ?>&nbsp;
				<input type='time' name="bg_forreaders_log_checktime" value="<?php echo get_option('bg_forreaders_log_checktime'); ?>" />&nbsp;<?php _e('GMT', 'bg-forreaders') ?><br>
				<i><?php _e('Next time:', 'bg-forreaders');
				$next_time = wp_next_scheduled( 'bg_forreaders_log_cron_action' );
				echo " ". ($next_time ? "<b>".date ('j-m-Y H:i', $next_time)."</b> ".__('GMT', 'bg-forreaders') : "<b>".__('never', 'bg-forreaders'))."</b>"; ?></i>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Log file', 'bg-forreaders') ?></th>
				<td>
				<?php printf ('<a href="%s" target="_blank">forreaders.log</a>', plugins_url('forreaders.log', dirname(__FILE__) )) ?>
				</td>
				</tr>
				</table>

				<input type="hidden" name="bg_forreaders_cron_updated" value="update" />
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="bg_forreaders_cron_updated, bg_forreaders_stack_interval, 
						bg_forreaders_all_interval, bg_forreaders_all_checktime,
						bg_forreaders_log_interval, bg_forreaders_log_checktime" />

				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>

	<!-- Пакетный режим -->
			<?php } elseif ($active_tab == 'batch') { ?>
				<table class="form-table">

				<tr valign="top">
				<th scope="row"><?php _e('Batch mode', 'bg-forreaders') ?></th>
				<td>
				<?php printf (__('You can use script %s<br>to generate files for readers in batch mode (using <b>cli</b> or <b>cron</b>).', 'bg-forreaders'),' <span style="background: gray; color: white">'. plugin_dir_path( dirname(__FILE__) ). 'forreaders.php'.'</span>') ?><br><br>
				<?php _e('<h3>Options:</h3>', 'bg-forreaders'); ?>
				<?php _e('<u>First parameter</u>', 'bg-forreaders'); ?><br>
				<?php _e('<b>id = [post id list separated by commas]</b> - process all the posts in the list;', 'bg-forreaders'); ?><br>
				<?php _e('<i>or</i>', 'bg-forreaders'); ?><br>
				<?php _e('<b>all = [from],[to]</b> - process all the posts of this range ([from]-[to]) on the site ignoring exceptions,<br>see General tab.', 'bg-forreaders'); ?><br>
				<?php _e('<i>or</i>', 'bg-forreaders'); ?><br>
				<?php _e('<b>stack</b> - process first element (post-id) from stack.', 'bg-forreaders'); ?><br><br>
				<?php _e('<u>Second parameter</u>', 'bg-forreaders'); ?><br>
				<?php _e('<b>echo</b> - output progress info to the screen.', 'bg-forreaders'); ?>
				</td>
				</tr>

				<tr valign="top">
				<th scope="row"><?php _e('Log file', 'bg-forreaders') ?></th>
				<td>
				<?php printf ('<a href="%s" target="_blank">forreaders.log</a>', plugins_url('forreaders.log', dirname(__FILE__) )) ?>
				</td>
				</tr>
				</table>

			<?php } ?>
			
		</form>
	</div>
	<?php 
}

function bg_forreaders_memory_usage () {
	$memory = array();
	
	$memory['limit'] = (int) ini_get('memory_limit') ;
	$memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 2) : 0;
	$memory['limit'] = empty($memory['limit']) ? __('N/A') : $memory['limit'] .' ' . __('MB');
	$memory['usage'] = empty($memory['usage']) ? __('N/A') : $memory['usage'] .' ' . __('MB');
	
	?>
		<ul>	
			<li><strong><?php _e('Memory limit', 'bg-forreaders'); ?></strong> : <span><?php echo $memory['limit']; ?></span></li>
			<li><strong><?php _e('Memory usage', 'bg-forreaders'); ?></strong> : <span><?php echo $memory['usage']; ?></span></li>
		</ul>
	<?php
}
function bg_forreaders_time_limit () {

	$time_limit = (int) ini_get('max_execution_time') ;
	$time_limit = (empty($time_limit) ? 30 : $time_limit) .' '. __('sec.', 'bg-forreaders');
	
	?>
		<ul>	
			<li><strong><?php _e('Max. execution time', 'bg-forreaders'); ?></strong> : <span><?php echo $time_limit; ?></span></li>
		</ul>
	<?php
}
