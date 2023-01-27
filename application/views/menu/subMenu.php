<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-lg-12">
      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New SubMenu</a>
      <br>
      <br>
      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
      <?php endif; ?>
      <?= $this->session->flashdata('pesan'); ?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Menu</th>
            <th scope="col">Url</th>
            <th scope="col">Icon</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($subMenu as $subMenu) :  ?>
            <tr>
              <th scope="row"><?= $no++; ?></th>
              <td><?= $subMenu['title']; ?></td>
              <td><?= $subMenu['menu']; ?></td>
              <td><?= $subMenu['url']; ?></td>
              <td><?= $subMenu['icon']; ?></td>
              <td><?= $subMenu['is_active']; ?></td>
              <td>
                <a href="<?= base_url() . "menu/editsubMenu/$subMenu[id]"; ?>" class="badge badge-success">Edit</a>
                <a href="<?= base_url() . "menu/deletesubMenu/$subMenu[id]"; ?>" class="badge badge-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New SubMenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() . "menu/subMenu" ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="subMenu Title..">
          </div>
          <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
              <option selected>Select Menu</option>
              <?php foreach ($menu as $menu) :  ?>
                <option value="<?= $menu['id'] ?>"><?= $menu['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" aria-describedby="emailHelp" placeholder="subMenu Title..">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" aria-describedby="emailHelp" placeholder="icon">
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" value="1" name="is_active" id="is_active" checked>
              <label class="custom-control-label" for="is_active">Active</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>