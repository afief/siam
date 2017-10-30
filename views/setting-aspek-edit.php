<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">
  <form action="" method="POST" class="siam-form">
    <h2>Edit Aspek</h2>
    <table class="form-table">
      <tbody>
        <tr class="form-field form-required">
          <th scope="row"><label for="aspek_text">Nama Aspek</label></th>
          <td>
            <input name="aspek_text" type="text" id="aspek_text" value="<?= $aspek->text ?>" aria-required="true" autocorrect="off" maxlength="20">
          </td>
        </tr>
      </tbody>
    </table>
    <button class="button button-primary" type="submit" name="aspek_edit_submit" value="1">
      <span class="dashicons dashicons-welcome-write-blog"></span> Edit Aspek
    </button>
  </form>

</div>