<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">

  <h1>Daftar Aspek</h1>

  <table class="siam-table widefat fixed striped">
    <thead>
      <tr>
        <th class="xscol">&nbsp;</th>
        <th>Nama</th>
        <th class="lcol year">#</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($aspek as $key => $as) { ?>
      <tr>
        <td>
          <?= ($key + 1) ?>
        </td>
        <td>
          <b><?= $as['text']; ?></b>
        </td>
        <td>
          <a class="button" href="?page=siam-options-aspek&action=edit&id=<?= $as['id'] ?>">
            Edit
          </a>
          <a class="button" href="?page=siam-options-aspek&delete=<?= $as['id'] ?>" onclick="return confirm('Menghapus aspek akan menghapus semua mutu dibawah <?= $as['text'] ?>. Yakin?')">
            Delete
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <hr>

  <form action="" method="POST" class="siam-form">
    <h2>Tambah Aspek</h2>
    <table class="form-table">
      <tbody>
        <tr class="form-field form-required">
          <th scope="row"><label for="aspek_text">Nama Aspek</label></th>
          <td>
            <input name="aspek_text" type="text" id="aspek_text" value="" aria-required="true" autocorrect="off" maxlength="20" required="required">
          </td>
        </tr>
      </tbody>
    </table>
    <button class="button button-primary" type="submit" name="aspek_submit" value="1">
      <span class="dashicons dashicons-plus"></span> Tambah Aspek
    </button>
  </form>

</div>