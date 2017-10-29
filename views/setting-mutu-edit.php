<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">
  <form action="" method="POST" class="siam-form">
    <h2>Edit Mutu Prodi</h2>
    <table class="form-table">
      <tbody>
        <tr class="form-field">
          <th scope="row"><label for="aspek_id">Aspek</label></th>
          <td>
            <select name="aspek_id" id="aspek_id">
              <?php foreach ($aspek as $as) { ?>
              <option value="<?= $as['id'] ?>" <?= $as['id'] == $mutu->aspek_id ? 'selected' : '' ?>><?= $as['text'] ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="mutu_text">Item Sasaran</label></th>
          <td>
            <textarea name="mutu_text" id="mutu_text" cols="30" rows="3" class="large-text" required="required" placeholder="Item Sasaran"><?= $mutu->text ?></textarea>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="mutu_keterangan">Keterangan</label></th>
          <td>
            <textarea name="mutu_keterangan" id="mutu_keterangan" cols="30" rows="3" class="large-text" required="required" placeholder="Keterangan"><?= $mutu->keterangan ?></textarea>
          </td>
        </tr>
      </tbody>
    </table>

    <button class="button button-primary" type="submit" name="mutu_edit_submit" value="1">
      <span class="dashicons dashicons-welcome-write-blog"></span> Edit Mutu Prodi
    </button>
  </form>

</div>