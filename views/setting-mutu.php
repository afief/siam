<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">

  <h2>Pengaturan Daftar Mutu</h2>

  <table class="siam-table widefat fixed striped">
    <thead>
      <tr>
        <th class="xscol">&nbsp;</th>
        <th>Item Sasaran</th>
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
          <td><?= $mutu['keterangan']; ?></td>
        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>

</div>