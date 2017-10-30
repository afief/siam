<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">

  <h2>Pengaturan Daftar Tahun</h2>

  <table class="siam-table widefat fixed striped">
    <thead>
      <tr>
        <th class="xscol">&nbsp;</th>
        <th>Tahun</th>
        <th class="lcol year">#</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tahuns as $key => $tahun) { ?>
      <tr>
        <td><?= ($key + 1) ?></td>
        <td><?= $tahun['text']?></td>
        <td>
          <a class="button" href="?page=siam-options-tahun&delete=<?= $tahun['id'] ?>">
            Delete
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <hr>

  <form action="" method="POST" class="siam-form">
    <h2>Tambah Tahun</h2>
    <table class="form-table">
      <tbody>
        <tr class="form-field">
          <th scope="row"><label for="tahun_text">Tahun</label></th>
          <td>
            <input type="text" class="tahun_text" id="tahun_text" name="tahun_text" required="required">
          </td>
        </tr>
      </tbody>
    </table>

    <button class="button button-primary" type="submit" name="tahun_submit" value="1">
      <span class="dashicons dashicons-plus"></span> Tambah Tahun
    </button>
  </form>

</div>