				<div class="footer"></div>
				<div id="loading" class="loading"></div>
				<div id="dialog" title="Basic dialog" style="display:none">
					<p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
				</div>
			</div>
		</form>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<?php if(isset($scripts)) foreach($scripts as $script) printf("<script type=\"text/javascript\" src=\"%s\"></script>\n", $script); ?>
		<script type="text/javascript" src="/js/default-admin.js"></script>
	</body>
</html>