<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap">

  <h2>Form Sasaran Mutu Program Studi</h2>

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
      <?php foreach ($mutus as $key => $aspek) { ?>
      <tr>
        <td colspan="<?= count($tahuns) + 3?>">
          <b><?= $aspek['text']; ?></b>
        </td>
      </tr>
        <?php foreach ($aspek['list'] as $key => $mutu) { ?>
        <tr>
          <td><?= ($key + 1) ?></td>
          <td><?= $mutu['text']?></td>
          <?php foreach ($tahuns as $tahun) { ?>
          <td class="scol year">
            <input type="text" class="regular-text" style="max-width: 100%" value="<?= $mutu['sasaran'][$tahun] ?>">
          </td>
          <?php } ?>
          <td><?= $mutu['keterangan']; ?></td>
        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>

</div>