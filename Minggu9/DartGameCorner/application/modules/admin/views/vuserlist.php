        <!-- Main Frame -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $judul ?></h1>
                    <div class="row">
                        <div class="col-lg">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userlist as $u) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><img src="<?= base_url('assets/images/profile/') . $u['image']; ?>" alt="poster" width="75px"></td>
                                            <td><?= $u['name']; ?></td>
                                            <td><?= $u['email']; ?></td>
                                            <td><?= $u['role_id']; ?></td>
                                            <td><?= $u['is_active']; ?></td>
                                            <td><?= date('d F Y', $u['date_created']); ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>admin/userlist/edit/<?= $u['id']; ?>" class="badge bg-success"><i class="fas fa-pen-to-square"></i> Edit</a>
                                                <a href="<?= base_url(); ?>admin/userlist/hapus/<?= $u['id']; ?>" class="badge bg-danger"><i class="fas fa-trash-can"></i> Delete</a>
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