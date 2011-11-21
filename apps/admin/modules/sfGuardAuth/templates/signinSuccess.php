<div class="boxCenter">
  <form class="radius" id="formLogin" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <div class="marge">
      <div>
        <label>Nom d'utilisateur</label><br />
        <?php echo $form['username']->render(); ?>
      </div>
      <div style="margin-top: 6px">
        <label>Mot de passe</label><br />
        <?php echo $form['password']->render(); ?>
      </div>
      <div style="margin-top: 6px">
        <?php echo $form['remember']->render(); ?><label for="signin_remember">Se souvenir de moi</label>
      </div>
      <button type="submit">Se connecter</button>
      <div>
      </div>
    </div>
    <?php echo $form->renderHiddenFields(); ?>
  </form>
</div>