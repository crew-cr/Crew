<table>
  <tr>
    <td class="line_comment">
      <div class="comment_holder">
        <?php foreach ($globalComments as $globalComment) : ?>
        <div class="commit_comment">
          <div class="comment_user"><span class="right"><?php echo sprintf('commenté le %s', $globalComment->getUpdatedAt()) ?></span></div>
          <div class="comment_body"><?php echo $globalComment->getValue() ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </td>
  </tr>
</table>
<form name="globalComment" id="globalComment" method="post" action="<?php echo url_for('default/fileAddComment?file='.$file->getId()) ?>" >
  <?php echo $form['value']->render(); ?>
  <button type="submit">Commenter le fichier</button>
</form>