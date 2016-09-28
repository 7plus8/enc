<?php include 'header.php'; ?>
	<section id="avatar">
		<div class="wrapper">
		<?php include ADMIN_DIR . 'admin_toolbar.php'; ?>
			<form action="/user/set_avatar" enctype="multipart/form-data" class="dropzone is_error" method="post" target="">
				<p>
				<label for=""></label>
				</p>
				<p class="title">Drop an image to upload</p>
				<p class="sub-title">or</p>
				<a href="#" id="select" class="button button_primary">Select a file</a>
				<table class="nojs-tbl">
					<tbody>
						<tr>
							<td><input type="file" id="file" name="file"></td>
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<td><input type="submit" class="av_sub button button_primary" value="Upload image"></td>
						</tr>
					</tbody>
				</table>
				<div id="img">	
				</div>				
			</form>
		</div>
	</section>
<?php include 'footer.php'; ?>