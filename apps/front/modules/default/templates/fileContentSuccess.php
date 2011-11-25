<canvas id="outline" width="50" height="700" style="position: fixed;"></canvas>
<div class="file_bloc">
  <div class="data">
    <div class="data_head">
      <ul class="right actions">
        <li>
          <?php echo link_to('View diff', 'default/file', array('title' => 'View entire file', 'query_string' => 'file='.$file->getId())) ?>
        </li>
      </ul>
    </div>
      <pre class="brush: <?php echo $fileExtension ?>"><?php echo $fileContent; ?></pre>
</div>

<script type="text/javascript">
SyntaxHighlighter.all();
</script>