<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap">

  <h2>Form Capaian Mutu Program Studi</h2>

  <table class="siam-table widefat fixed striped">
    <thead>
      <tr>
        <th class="xscol" rowspan="2">&nbsp;</th>
        <th rowspan="2">Item Sasaran</th>
        <?php foreach ($tahuns as $tahun) { ?>
        <th class="lcol year" colspan="2"><?= $tahun ?></th>
        <?php } ?>
        <th rowspan="2">Keterangan</th>
      </tr>
      <tr>
        <?php foreach ($tahuns as $tahun) { ?>
        <th class="scol year small">Sasaran</th>
        <th class="mcol year small">Capaian</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($mutus as $key => $aspek) { ?>
      <tr>
        <td colspan="<?= (count($tahuns) * 2) + 3?>">
          <b><?= $aspek['text']; ?></b>
        </td>
      </tr>
        <?php foreach ($aspek['list'] as $key => $mutu) { ?>
        <tr>
          <td><?= ($key + 1) ?></td>
          <td><?= $mutu['text']?></td>
          <?php foreach ($tahuns as $tahun) { ?>
          <td class="scol year">
            <?= $mutu['sasaran'][$tahun] ?>
          </td>
          <td class="mcol year">
            <input type="text" class="regular-text" style="max-width: 100%" value="<?= $mutu['capaian'][$tahun] ?>">
          </td>
          <?php } ?>
          <td><?= $mutu['keterangan']; ?></td>
        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>

</div>