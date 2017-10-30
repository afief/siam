<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">

  <h2>Form Audit Mutu Program Studi</h2>

  <div class="tab">
    <ul>
      <?php foreach ($aspeks as $key => $aspek) { ?>
      <li onclick="openAspek(<?= $aspek['id'] ?>)" class="<?= $aspek['id'] == $aspekId ? 'active' : '' ?>"><?= $aspek['text'] ?></li>
      <?php } ?>
    </ul>
  </div>

  <form action="" method="POST">
    <table class="siam-table widefat fixed striped">
      <thead>
        <tr>
          <th class="xscol" rowspan="2">&nbsp;</th>
          <th rowspan="2">Item Sasaran</th>
          <?php foreach ($tahuns as $tahun) { ?>
          <th class="xlcol year" colspan="3"><?= $tahun ?></th>
          <?php } ?>
          <th rowspan="2">Keterangan</th>
        </tr>
        <tr>
          <?php foreach ($tahuns as $tahun) { ?>
          <th class="scol year small">Sasaran</th>
          <th class="scol year small">Capaian</th>
          <th class="mcol year small">Audit</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($mutus as $key => $mutu) { ?>
        <tr>
          <td><?= ($key + 1) ?></td>
          <td><?= $mutu['text']?></td>
          <?php foreach ($tahuns as $tahun) { ?>
          <td class="scol year">
            <?= $mutu['sasaran'][$tahun] ?>
          </td>
          <td class="scol year">
            <?= $mutu['capaian'][$tahun] ?>
          </td>
          <td class="mcol year">
            <input type="text" class="regular-text mutu-nilai" style="max-width: 100%" name="mutu_<?= $mutu['id'] ?>_<?= $tahun ?>" value="<?= $mutu['audit'][$tahun] ?>">
          </td>
          <?php } ?>
          <td><?= $mutu['keterangan']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <hr>

    <button class="button button-primary" type="submit" name="audit_submit" value="1">
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
    window.location.href="<?= get_admin_url() . 'admin.php?page=mutu-prodi-audit-form' ?>&aspek_id=" + aspekId;
  }
  jQuery('.mutu-nilai').on('change', function(el) {
    changed = true;
  });
</script>