<table>
  <tr>
    <td class="line_comment">
      <div class="comment_holder">
        <?php if (count($globalComments) > 0) : ?>
          <?php foreach ($globalComments as $globalComment) : ?>
          <div class="comment">
            <div class="comment_user">
              <img class="avatar" src="<?php echo $globalComment->getsfGuardUser()->getProfile()->getAvatarUrl() ?>" />
              <?php echo sprintf("<span><strong>%s</strong> %s</span>", $globalComment->getAuthorName(), $globalComment->getUpdatedAt('d/m/Y H\hi')) ?>
              <?php echo $userId === $globalComment->getUserId() ? sprintf("<button class=\"right delete danger\" data=\"%s?id=%s\">Delete</button>", url_for('default/fileDeleteComment'), $globalComment->getId()) : '' ?>
            </div>
            <div class="comment_body"><?php echo nl2br(sprintf("%s", $globalComment->getValue())) ?></div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <form name="globalComment" id="globalComment" class="comment_form" method="post" action="<?php echo url_for('default/fileAddComment?file='.$file->getId()) ?>">
          <?php echo $form['value']->render(); ?>
          <button class="right good" type="submit">Add File Note</button>
        </form>
      </div>
    </td>
  </tr>
</table>
