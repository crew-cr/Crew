<script>
  hljs.tabReplace = '  ';
  hljs.initHighlightingOnLoad();
</script>

<ul class="lines">
<?php foreach(explode("\n", $fileContent) as $line => $row): ?>
  <li><?php echo ++$line ?></li>
<?php endforeach;?>
</ul>

<pre><code class="<?php echo $fileExtension ?>"><?php echo $fileContent ?></code></pre>