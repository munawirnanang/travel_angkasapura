<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Pengguna</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-default">Tambah Pengguna</button>
            <div class="row">
                <div class="col-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user as $us) { ?>
                                <tr>
                                    <td><?php echo $us['id']; ?></td>
                                    <td><?php echo $us['name'] ?></td>
                                    <td><?php echo $us['status'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning" data-id="<?php echo $us['id'] ?>">Ubah</button>
                                        <button type="button" class="btn btn-danger" onClick="deleteUser(<?php echo $us['id']; ?>)">Hapus</button>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="storeUser" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-warning">
    <div class="modal-dialog">
        <form action="editUser" method="post">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="changeId" name="id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="changeEmail" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Nama</label>
                        <input type="text" class="form-control" id="changeName" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="changePassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStatus1">Status</label>
                        <select id="changeStatus" name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function() {

        $('#modal-warning').on('shown.bs.modal', function(event) {
            //ajax call to get Data User Informatin from database
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var link = "<?php echo base_url(); ?>showSpecificUser";
            $.ajax({
                    method: "POST",
                    url: link,
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    //Put Data User to form Edit User
                    var file = JSON.parse(data);
                    console.log(file);
                    $('#changeId').val(file[0]['id']);
                    $('#changeEmail').val(file[0]['email']);
                    $('#changeName').val(file[0]['name']);
                    $('#changePassword').val(file[0]['pass']);
                    $('#changeStatus').val(file[0]['status']);
                });
        });

    });

    function deleteUser(id) {
        if (confirm("Are you sure delete this user?") == true) {
            var link = "<?php echo base_url(); ?>deleteUser";
            $.ajax({
                    method: "POST",
                    url: link,
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    if (data == 1) {
                        window.location = "<?php echo base_url(); ?>manajemen_pengguna";
                    }
                })
                .fail(function() {
                    alert("error");
                });
        }
    }
</script>