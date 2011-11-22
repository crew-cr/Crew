<tr class="comment_bloc">
  <td class="comment_count" colspan="2">
    <span class="counter"><?php echo sizeof($comments) ?></span>
  </td>
  <td class="line_comment">
    <div class="clipper">
      <div class="comments_holder">
        <?php foreach ($comments as $comment): ?>
        <div class="comment">
          <div class="comment_user">
            <img class="avatar" src="<?php echo $comment->getsfGuardUser()->getProfile()->getAvatarUrl() ?>" />
            <?php echo sprintf("<span><strong>%s</strong> %s</span>", $comment->getAuthorName(), $comment->getUpdatedAt('d/m/Y H\hi')) ?>
            <?php echo $userId === $comment->getUserId() ? sprintf("<button class=\"right delete danger\" data=\"%s?id=%s\">Delete</button>", url_for('default/commentDeleteLine'), $comment->getId()) : '' ?>
          </div>
          <div class="comment_body"><?php echo nl2br(sprintf("%s", $comment->getValue())) ?></div>
        </div>
        <?php endforeach; ?>
        <div class="comment_form <?php echo $formVisible ? '' : 'hidden' ?>">
          <form name="fileComment" method="post" action="<?php echo url_for('default/commentAddLine') ?>" class="comment_form">
            <?php echo $form->renderHiddenFields(); ?>
            <?php echo $form['value']->render(); ?>
            <button class="close safe" type="button">Close Form</button>
            <button class="right good" type="submit">Add Line Note</button>
          </form>
        </div>
        <div class="comment_add <?php echo $formVisible ? 'hidden' : '' ?>">
          <button class="add_comment good">Add a line note</button>
        </div>
      </div>
    </div>
  </td>
</tr>
