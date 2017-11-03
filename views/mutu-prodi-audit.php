<link rel="stylesheet" type="text/css" href="<?= SIAM_URL . 'views/style.css' ?>">

<div class="wrap siam-wrap">
  <a class="button button-primary" href="<?= get_admin_url() . '/admin.php?download=audit-mutu'; ?>">
    <span class="dashicons dashicons-download"></span> Download Excel
  </a>
  <button class="button button-primary" onclick="doPrint()">
    <span class="dashicons dashicons-slides"></span> Print
  </button>
</div>

<div class="wrap siam-wrap"  id="printTable">
  <h2>Audit Mutu Program Studi</h2>

  <table class="siam-table widefat fixed striped">
    <thead>
      <tr>
        <th class="xscol" rowspan="2">&nbsp;</th>
        <th rowspan="2">Item Sasaran</th>
        <?php foreach ($tahuns as $tahun) { ?>
        <th class="lcol year" colspan="3"><?= $tahun ?></th>
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
      <?php foreach ($mutus as $key => $aspek) { ?>
      <tr>
        <td colspan="<?= count($tahuns) * 3 + 3?>">
          <b><?= $aspek['text']; ?></b>
        </td>
      </tr>
        <?php foreach ($aspek['list'] as $key => $mutu) { ?>
        <tr>
          <td><?= ($key + 1) ?></td>
          <td><?= $mutu['text']?></td>
          <?php foreach ($tahuns as $tahun) { ?>
          <td class="scol year"><?= $mutu['sasaran'][$tahun] ?></td>
          <td class="scol year"><?= $mutu['capaian'][$tahun] ?></td>
          <td class="scol year"><?= $mutu['audit'][$tahun] ?></td>
          <?php } ?>
          <td><?= $mutu['keterangan']; ?></td>
        </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>

</div>

<hr>

<div class="wrap siam-wrap">
  <a class="button button-primary" href="<?= get_admin_url() . '/admin.php?download=audit-mutu'; ?>">
    <span class="dashicons dashicons-download"></span> Download Excel
  </a>
  <button class="button button-primary" onclick="doPrint()">
    <span class="dashicons dashicons-slides"></span> Print
  </button>
</div>

<script type="text/javascript">
  function doPrint() {
    var divToPrint=document.getElementById("printTable");
    newWin= window.open("");
    var styles = jQuery('link[rel=stylesheet]');
    styles.each(function(index, val) {
      newWin.document.write(val.outerHTML);
    });
    newWin.document.write(divToPrint.outerHTML);
    newWin.setTimeout(function() {
      newWin.print();
      newWin.close();
    }, 1000);
  }
</script>