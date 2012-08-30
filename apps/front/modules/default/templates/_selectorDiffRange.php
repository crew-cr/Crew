<?php /** @var selectorDiffRangeForm $form */ ?>

<?php echo $form->renderFormTag(url_for('default/validateSelectorDiffRange')) ?>
  <?php echo $form->renderHiddenFields(); ?>
  Compare from
  <?php echo $form['from']->render(); ?>
  to
  <?php echo $form['to']->render(); ?>
  <input type="submit" value="Show" class="">
</form>