<tr class="comment_bloc">
  <td class="comment_count" colspan="2">
    <span class="counter"><?php echo sizeof($comments) ?></span>
  </td>
  <td class="line_comment">
    <div class="comment_holder">
      <?php foreach ($comments as $comment): ?>
      <div class="commit_comment">
        <div class="comment_user"><?php echo sprintf("<span class=\"right\">commenté le %s</span>", $comment->date) ?></div>
        <div class="comment_body"><?php echo sprintf("%s", $comment->value) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <form name="fileComment" method="post" action="" class="commentBloc">
      <input type="hidden" name="last_commit" value="<?php echo $lastCommit ?>">
      <input type="hidden" name="file" value="<?php echo $file ?>">
      <input type="hidden" name="position" value="<?php echo $position ?>">
      <input type="hidden" name="line" value="<?php echo $line ?>">
      <textarea rows="7" cols="10" name="lineCommentAdd" id="lineCommentAdd"></textarea>
      <button class="close" type="button">Fermer le formulaire</button>
      <button class="right" type="submit">Commenter la ligne</button>
    </form>
  </td>
</tr>
