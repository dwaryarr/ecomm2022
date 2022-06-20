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
                            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenuModal">Add New Menu</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><?= $m['menu']; ?></td>
                                            <td>
                                                <a href="#" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#editMenuModal<?= $m['id'] ?>"><i class="fas fa-pen-to-square"></i> Edit</a>
                                                <!-- Edit Menu Modal -->
                                                <div class="modal fade" id="editMenuModal<?= $m['id'] ?>" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-light">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url('menu/editmenu/' . $m['id']) ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Menu name" id="menu" name="menu" value="<?= $m['menu'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td><a href="<?= base_url('menu/deletemenu/' . $m['id']) ?>" class="badge bg-danger"><i class="fas fa-trash-can"></i> Delete</a></td>

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
                        <div class="modal-content bg-light">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('menu') ?>" method="POST">
                                <div class="modal-body">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Menu name" id="menu" name="menu">
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