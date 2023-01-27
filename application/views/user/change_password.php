<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-md-6">
      <?= $this->session->flashdata('pesan'); ?>
      <form action="<?= base_url() . "user/changepassword"; ?>" method="post">
        <div class="form-group">
          <label for="Current Password">Current Password</label>
          <input type="password" name="current_password" class="form-control" id="Current Password">
          <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">New Password</label>
          <input type="password" name="new_password_1" class="form-control" id="new_password_1">
          <?= form_error('new_password_1', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Repeat-Password</label>
          <input type="password" class="form-control" name="new_password_2" id="new_password_2">
          <?= form_error('new_password_2', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Change Password</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->