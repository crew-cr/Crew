<tr class="comment_bloc">
  <td class="comment_count" colspan="2">
    <span class="counter"><?php echo sizeof($comments) ?></span>
  </td>
  <td class="line_comment">
    <div class="comment_holder">
      <?php foreach ($comments as $comment): ?>
      <div class="commit_comment">
        <div class="comment_user">
          <?php echo sprintf("<span>commenté le %s par <strong>%s</strong></span>", $comment->getUpdatedAt('d/m/Y à H:i:s'), $comment->getsfGuardUser()) ?>
          <?php echo $userId === $comment->getUserId() ? sprintf("<button class=\"right delete danger\" data=\"%s?id=%s\">Delete</button>", url_for('default/lineDeleteComment'), $comment->getId()) : '' ?>
        </div>
        <div class="comment_body"><?php echo sprintf("%s", $comment->getValue()) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="comment_form <?php echo $formVisible ? '' : 'hidden' ?>">
      <form name="fileComment" method="post" action="<?php echo url_for('default/lineAddComment') ?>" class="commentBloc">
        <?php echo $form->renderHiddenFields(); ?>
        <?php echo $form['value']->render(); ?>
        <button class="close safe" type="button">Close Form</button>
        <button class="right good" type="submit">Add Line Note</button>
      </form>
    </div>
    <div class="comment_add <?php echo $formVisible ? 'hidden' : '' ?>">
      <button class="add_comment good">Add a line note</button>
    </div>
  </td>
</tr>