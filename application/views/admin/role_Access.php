<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-lg-6">
      <?= $this->session->flashdata('pesan'); ?>
      <h5>Role : <?= $role['role']; ?></h5>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Menu</th>
            <th scope="col">Access</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($menu as $sm) :  ?>
            <tr>
              <th scope="row"><?= $no++; ?></th>
              <td><?= $sm['menu']; ?></td>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" <?= cheked_access($role['id'], $sm['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $sm['id']; ?>">
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->