<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">

  <h2>Form Sasaran Mutu Program Studi</h2>

  <div class="tab">
    <ul>
      <?php foreach ($aspeks as $key => $aspek) { ?>
      <li onclick="openAspek(<?= $aspek['id'] ?>)" class="<?= $aspek['id'] == $aspekId ? 'active' : '' ?>"><?= $aspek['text'] ?></li>
      <?php } ?>
    </ul>
  </div>

  <form action="" method="POST">
    <input type="hidden" name="aspek_id" value="<?= $aspekId ?>">

    <table class="siam-table widefat fixed striped">
      <thead>
        <tr>
          <th class="xscol">&nbsp;</th>
          <th>Item Sasaran</th>
          <?php foreach ($tahuns as $tahun) { ?>
          <th class="scol year"><?= $tahun ?></th>
          <?php } ?>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($mutus as $key => $mutu) { ?>
        <tr>
          <td><?= ($key + 1) ?></td>
          <td><?= $mutu['text']?></td>
          <?php foreach ($tahuns as $tahun) { ?>
          <td class="scol year">
            <input type="text" class="regular-text mutu-nilai" style="max-width: 100%" name="mutu_<?= $mutu['id'] ?>_<?= $tahun ?>"  value="<?= $mutu['sasaran'][$tahun] ?>">
          </td>
          <?php } ?>
          <td><?= $mutu['keterangan']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <hr>

    <button class="button button-primary" type="submit" name="sasaran_submit" value="1">
      <span class="dashicons dashicons-portfolio"></span> Simpan
    </button>

  </form>

</div>

<script type="text/javascript">
  var changed = false;
  function openAspek(aspekId) {
    if (changed) {
      var c = confirm('Anda belum menyimpan perubahan terakhir di halaman ini. Yakin pindah tab?');
      if (!c)
        return;
    }
    window.location.href="<?= get_admin_url() . 'admin.php?page=mutu-prodi-sasaran' ?>&aspek_id=" + aspekId;
  }
  jQuery('.mutu-nilai').on('change', function(el) {
    changed = true;
  });
</script>