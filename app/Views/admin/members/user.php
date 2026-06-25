<?=$this->extend("admin/_layouts/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Users</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">users</li>
      </ol>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(1,2)){ ?>
            <a href="<?=base_url('admin/add_user')?>" class="btn btn-primary">Add User</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Profile Image</th>
                  <th>Name</th>
                  <th>Privilege</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($users)){
                    $sn = 1;
                    foreach($users as $list){
                    if($list->status == 1){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    }
                    ?>
                    <tr>
                        <td><?=$sn;?></td>
                        <td><img src="<?=base_url('public/assets/upload/users/'.$list->image) ?>" alt="image" width="65" height="75"></td>
                        <td><?=$list->name?></td>
                        <td><?=$list->post_name?></td>
                        <td><?=$list->email?></td>
                        <td><?=$list->phone?></td>
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(1,3)){ ?>
                            <a href="<?=base_url('/admin/edit_user/'.$list->user_id) ?>"><i class="fas fa-edit"></i></a>
                            <?php }if(is_privilege(1,4)){ ?>
                            <a href="<?=base_url('/admin/user_profile/'.$list->user_id) ?>"><i class="fas fa-eye"></i></a>
                            <?php }if(is_privilege(1,5)){ ?>
                            <?php if($list->user_id != 1){?>
                            <a href="<?=base_url('/admin/user_delete/'.$list->user_id) ?>" onclick="return confirm('Are you sure?');" style="color:red"><i class="fas fa-trash"></i></a>
                            <?php } }?>
                        </td>
                    </tr>

                <?php $sn++; }
                } ?>
              </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->
<?=$this->endSection()?>
  