<div class="wrap">
<h2>テーマ設定</h2> 
    <form method="post" action="options.php">
    <?php settings_fields( 'myoption-group' ); do_settings_sections( 'myoption-group' ); ?>
      <table class="form-table">
        <tr>
          <th scope="row"><label for="logoImg">トップ画像のパス</label></th>
          <td>
            <input type="text" name="logoImg" id="logoImg" class="regular-text" value="<?php echo esc_attr( get_option('logoImg') ); ?>">
          </td>
        </tr> 

        <tr>
          <th scope="row"><label for="profileImg">prof画像のパス</label></th>
          <td>
            <input type="text" name="profileImg" id="profileImg" class="regular-text" value="<?php echo esc_attr( get_option('profileImg') ); ?>">
            <p>画像のサイズは「400*400」を推奨</p>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="googleTagManager">googleタグマネージャーのID</label></th>
          <td>
            <input type="text" name="googleTagManager" id="googleTagManager" class="regular-text" value="<?php echo esc_attr( get_option('googleTagManager') ); ?>">
            <p>例：GTM-XXXXXX</p>
          </td>
        </tr>

        <tr>
          <th scope="row">&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
      </table>
    <?php submit_button(); ?>
    </form>
    
</div>