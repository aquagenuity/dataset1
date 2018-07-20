<script type="text/javascript" src="/js/jquery.js"></script>
<?php if(isset($scripts)) foreach($scripts as $script) printf("<script type=\"text/javascript\" src=\"%s\"></script>\n", $script); ?>
<script type="text/javascript" src="/js/default.js?v=<?php echo JS_VERSION; ?>"></script>
<!--[if lt IE 9]>
  <script type="text/javascript" src="/js/html5.js"></script>
<![endif]-->
<footer></footer>
</div>
</body>
</html>
