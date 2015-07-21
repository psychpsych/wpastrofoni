<p>
	<label>Title</label> 
	<input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
	Hangi eklentiyi göstermek istersin?
	<select class="astrofoni-widgets">
		<?php for ($i=0; $i < 20; $i++): ?>
		<option>
			<?php echo $wpastrofoni_profile->{'widgets'}[$i]->{'access_code'}; ?>
		</option>
	<?php endfor; ?>
</select>
</p>

