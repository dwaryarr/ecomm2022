        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $judul ?></h1>
                    <div class="row">
                        <div class="col-lg">
                            <?php if ($this->session->flashdata('flash')) {
                                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                            } ?>
                            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenuModal">Add New Role</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($role as $r) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><?= $r['role']; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/role/roleaccess/' . $r['id']) ?>" class="badge bg-warning"><i class="fas fa-bars"></i> Access</a>
                                                <a href="#" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#editMenuModal<?= $r['id'] ?>"><i class="fas fa-pen-to-square"></i> Edit</a>
                                                <!-- Edit Role Modal -->
                                                <div class="modal fade" id="editMenuModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editMenuModalLabel">Edit Role</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url('admin/role/editrole/' . $r['id']) ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Role name" id="role" name="role" value="<?= $r['role'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                        </div>
                        <a href="<?= base_url('admin/role/deleterole/' . $r['id']) ?>" class="badge bg-danger"><i class="fas fa-trash-can"></i> Delete</a>
                        </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                    </table>
                    <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
                <div class="row">

                </div>
        </div>

        <!-- New Modal -->
        <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newMenuModalLabel">Add New Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('admin/role') ?>" method="POST">
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Role name" id="role" name="role">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>