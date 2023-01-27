<!-- Begin Page Content -->


<?php

?>
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-lg-7">
      <form action="<?= base_url() . "menu/editMenuSub" ?>" method="post">
        <input type="hidden" value="<?= $subMenu['id']; ?>" name="id">
        <div class="form-group">
          <label for="">Title Menu</label>
          <input type="text" class="form-control" id="title" value="<?= $subMenu['title']; ?>" name="title" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="">Menu Access</label>
          <input type="text" class="form-control" id="menu" value="<?= $subMenu['menu_id']; ?>" name="menu_id" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="">Url</label>
          <input type="text" class="form-control" id="url" value="<?= $subMenu['url']; ?>" name="url" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="">Icon</label>
          <input type="text" class="form-control" id="icon" value="<?= $subMenu['icon']; ?>" name="icon" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="<?= $subMenu['is_active']; ?>" id="is_active" checked>
            <label class="form-check-label" for="defaultCheck1">
              Active ?
            </label>
          </div>
        </div>
        <button class="btn btn-primary" type="submit">Edit</button>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->