<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<?php if (!isset($wpastrofoni_id ) || $wpastrofoni_id == '' ): ?>



					<div class="postbox">

						<h3><span><?php esc_attr_e( "Astrofoni'ye hoşgeldiniz", 'wp_admin_style' ); ?></span></h3>

						<div class="inside">
							<p>Eklentiyi kullanabilmek için lütfen Astrofoni üzerinden aldığınız ID'yi giriniz. <a href="#">Daha fazla bilgi</a></p>

							<form name="wpastrofoni_id_form" method="post" action="">
								<input type="hidden" name="wpastrofoni_form_submitted" value="Y">
								<table class="form-table">
									<tr>
										<td><label for="wpastrofoni_id">Astrofoni ID:</label></td>
										<td><input type="text" value="" name="wpastrofoni_id" id="wpastrofoni_id" class="regular-text code" placeholder="Lütfen geçerli bir değer giriniz..." /><br></td>
									</tr>
								</table>
								<p><input class="button-primary" type="submit" name="wpastrofoni_id_submit" value="<?php esc_attr_e( 'Onayla' ); ?>" /></p>
							</form>

						</div>
					</div>
					<!-- .postbox -->
				<?php else: ?>

				<div class="postbox">

					<h3><span><?php esc_attr_e( "Aşağıdaki eklentiler bulundu", 'wp_admin_style' ); ?></span></h3>

					<div class="inside">
						<p>Astrofoni üzerinden oluşturduğunuz şu eklentilere ulaştık. Dilediğiniz eklentiyi Wordpress'e bir tıkla entegre edebilirsiniz. Lütfen entegre edilecek eklentiyi aşağıdan seçiniz. Not: Eklentilerin Wordpress üzerinde düzgün görüntülenebilmesi için URL adresi mutlaka doğru olmalıdır.</p>


						<ul class="astrofoni-widgets">
							<?php
							$widget_count = count($wpastrofoni_profile->{'widgets'});
							for ($i=0; $i < $widget_count; $i++):
								$domain = str_replace('http://', '', $wpastrofoni_profile->{'widgets'}[$i]->{'website_url'});
								$usable = false;
								if(strpos( $_SERVER['HTTP_HOST'], $domain) !== false){
								    $usable = true;
								}
								//print_r([$domain, $_SERVER['HTTP_HOST'], $usable]);
								?>
							<li style="background-color: <?=$usable ? 'rgb(18, 145, 35)' : 'rgb(154, 125, 163)'?>;">
								<a href="#"><?php echo $wpastrofoni_profile->{'widgets'}[$i]->{'access_code'}; ?></a><br>
								<?php if(strlen($wpastrofoni_profile->{'widgets'}[$i]->{'website_description'})): ?>
									<small><?php echo $wpastrofoni_profile->{'widgets'}[$i]->{'website_description'}; ?></small><br>
								<?php endif; ?>
									<small>Domain: <?php echo $wpastrofoni_profile->{'widgets'}[$i]->{'website_url'}; ?></small><br>
							</li>
						<?php endfor; ?>
					</ul>
				</div>
			</div>
			<?php if ($display_json == true): ?>
			<div class="postbox">
				<p>JSON FEED</p>
				<div class="inside">
					<p>
						<?php echo $wpastrofoni_profile->{'user_name'}; ?>
					</p>
					<p>
						<?php echo $wpastrofoni_profile->{'user_surname'}; ?>
					</p>
					<pre><?php
						$tmp1 = (array)$wpastrofoni_profile;
						$tmp2 = (isset($tmp1['widgets'][0]) ? (array)$tmp1['widgets'][0] : (array)$tmp1['widgets']);
						unset($tmp1['widgets']);
						echo 'user: <br>';
						print_r($tmp1);

						echo '<hr>';

					  $tmp2['insert_code'] = htmlentities($tmp2['insert_code']);
						echo 'one widget: <br>';
						print_r($tmp2);

//						echo '<hr>';

//						echo htmlentities($wpastrofoni_profile->{'widgets'}[0]->{'insert_code'});
						?>
					</pre>
				</div>
			</div>
		<?php endif; ?>


	</div>
	<!-- .meta-box-sortables .ui-sortable -->

</div>
<!-- post-body-content -->

<!-- sidebar -->
<div id="postbox-container-1" class="postbox-container">

	<div class="meta-box-sortables">

		<div class="postbox">

			<h3><span><?php esc_attr_e(
				'Yan taraf', 'wp_admin_style'
				); ?></span></h3>

				<div class="inside">
					<form name="wpastrofoni_id_form" method="post" action="">
						<input type="hidden" name="wpastrofoni_form_submitted" value="Y">
						<p><label for="wpastrofoni_id">ID:</label></p>
						<p><input type="text" value="<?php echo $wpastrofoni_id; ?>" name="wpastrofoni_id" id="wpastrofoni_id" class="" placeholder="Lütfen geçerli bir değer giriniz..." /></p>
						<p><input class="button-primary" type="submit" name="wpastrofoni_id_submit" value="<?php esc_attr_e( 'Güncelle' ); ?>" /></p>
					</form>
					<p><?php esc_attr_e(
						'Buraya şirketin diğer ürünlerinin tanıtımı gelebilir?',
						'wp_admin_style'
						); ?></p>
					</div>
					<!-- .inside -->

				</div>
				<!-- .postbox -->

			<?php endif; ?>

		</div>
		<!-- .meta-box-sortables -->

	</div>
	<!-- #postbox-container-1 .postbox-container -->

</div>
<!-- #post-body .metabox-holder .columns-2 -->

<br class="clear">
</div>
<!-- #poststuff -->

</div> <!-- .wrap -->
