<div class="wrap">
<h2>テーマ設定</h2> 
    <form method="post" action="options.php">
    <?php settings_fields( 'myoption-group' ); do_settings_sections( 'myoption-group' ); ?>
      <table class="form-table">

        <tr>
          <th scope="row"><label for="googleTagManager">googleタグマネージャーのID</label></th>
          <td>
            <input type="text" name="googleTagManager" id="googleTagManager" class="regular-text" value="<?php echo esc_attr( get_option('googleTagManager') ); ?>">
            <p>例：GTM-XXXXXX</p>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="twitterSite">TwitterのID（twitter:site のmetatagに追加されます）</label></th>
          <td>
            <input type="text" name="twitterSite" id="twitterSite" class="regular-text" value="<?php echo esc_attr( get_option('twitterSite') ); ?>">
            <p>例：@munichang19</p>
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