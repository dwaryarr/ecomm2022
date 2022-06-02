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
                            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenuModal">Add New SubMenu</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Url</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($submenu as $sm) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><?= $sm['title']; ?></td>
                                            <td><?= $sm['menu']; ?></td>
                                            <td><?= $sm['url']; ?></td>
                                            <td><?= $sm['icon']; ?></td>
                                            <td><?= $sm['is_active']; ?></td>
                                            <td>
                                                <a href="#" class="badge bg-success"><i class="fas fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#editSubMenuModal<?= $sm['id'] ?>"></i> Edit</a>
                                                <!-- Edit SubMenu Modal -->
                                                <div class="modal fade" id="editSubMenuModal<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editSubMenuModalLabel">Edit SubMenu</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url('menu/editsubmenu/') . $sm['id'] ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="SubMenu Title" id="title" name="title" value="<?= $sm['title'] ?>">
                                                                    </div>
                                                                    <div class="input-group mt-3">
                                                                        <select name="menu_id" id="menu_id" class="form-control">
                                                                            <option value="<?= $sm['menu_id'] ?>">Select Menu</option>
                                                                            <?php foreach ($menu as $m) : ?>
                                                                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group mt-3">
                                                                        <input type="text" class="form-control" placeholder="SubMenu url" id="url" name="url" value="<?= $sm['url'] ?>">
                                                                    </div>
                                                                    <div class=" input-group mt-3">
                                                                        <input type="text" class="form-control" placeholder="SubMenu Icon" id="icon" name="icon" value="<?= $sm['icon'] ?>">
                                                                    </div>
                                                                    <div class=" input-group mt-3 mb-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked value="<?= $sm['is_active'] ?>">
                                                                            Active?
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class=" modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><a href="<?= base_url('menu/deleteSubMenu/') . $sm['id']; ?>" class="badge bg-danger"><i class="fas fa-trash-can"></i> Delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('menu/submenu') ?>" method="POST">
                                <div class="modal-body">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="SubMenu Title" id="title" name="title">
                                    </div>
                                    <div class="input-group mt-3">
                                        <select name="menu_id" id="menu_id" class="form-control">
                                            <option value="">Select Menu</option>
                                            <?php foreach ($menu as $m) : ?>
                                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="input-group mt-3">
                                        <input type="text" class="form-control" placeholder="SubMenu url" id="url" name="url">
                                    </div>
                                    <div class="input-group mt-3">
                                        <input type="text" class="form-control" placeholder="SubMenu Icon" id="icon" name="icon">
                                    </div>
                                    <div class="input-group mt-3 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                                            Active?
                                            </label>
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