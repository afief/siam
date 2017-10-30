<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">

  <h2>Pengaturan Daftar Mutu Prodi</h2>

  <table class="siam-table widefat fixed striped">
    <thead>
      <tr>
        <th class="xscol">&nbsp;</th>
        <th>Item Sasaran</th>
        <th>Keterangan</th>
        <th class="lcol year">#</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($mutus as $key => $aspekMutu) { ?>
      <tr>
        <td colspan="4">
          <b><?= $aspekMutu['text']; ?></b>
        </td>
      </tr>
        <?php foreach ($aspekMutu['list'] as $key => $mutu) { ?>
        <tr>
          <td><?= ($key + 1) ?></td>
          <td><?= $mutu['text']?></td>
          <td><?= $mutu['keterangan']; ?></td>
          <td>
          <a class="button" href="?page=siam-options-mutu&action=edit&id=<?= $mutu['id'] ?>">
            Edit
          </a>
          <a class="button" href="?page=siam-options-mutu&delete=<?= $mutu['id'] ?>" onclick="return confirm('Menghapus mutu akan menghapus data sasaran dan capaian yang sudah disimpan di mutu ini. Yakin?')">
            Delete
          </a>
        </td>
        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>

  <hr>

  <form action="" method="POST" class="siam-form">
    <h2>Tambah Mutu Prodi</h2>
    <table class="form-table">
      <tbody>
        <tr class="form-field">
          <th scope="row"><label for="aspek_id">Aspek</label></th>
          <td>
            <select name="aspek_id" id="aspek_id">
              <?php foreach ($aspek as $as) { ?>
              <option value="<?= $as['id'] ?>"><?= $as['text'] ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="mutu_text">Item Sasaran</label></th>
          <td>
            <textarea name="mutu_text" id="mutu_text" cols="30" rows="3" class="large-text" required="required" placeholder="Item Sasaran"></textarea>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="mutu_keterangan">Keterangan</label></th>
          <td>
            <textarea name="mutu_keterangan" id="mutu_keterangan" cols="30" rows="3" class="large-text" required="required" placeholder="Keterangan"></textarea>
          </td>
        </tr>
      </tbody>
    </table>

    <button class="button button-primary" type="submit" name="mutu_submit" value="1">
      <span class="dashicons dashicons-plus"></span> Tambah Mutu Prodi
    </button>
  </form>

</div>