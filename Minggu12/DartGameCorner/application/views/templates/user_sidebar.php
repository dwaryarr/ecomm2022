<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav pb-5">
                    <!-- Menu Management -->
                    <?php
                    $role_id = $this->session->userdata('role_id');
                    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                                  FROM `user_menu` JOIN `user_access_menu`
                                  ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                                  WHERE `user_access_menu`.`role_id` = $role_id
                                  ORDER BY `user_access_menu`.`menu_id` ASC
                                  ";
                    $menu = $this->db->query($queryMenu)->result_array();
                    ?>

                    <!-- LOOPING MENU -->
                    <?php foreach ($menu as $m) : ?>
                        <div class="sb-sidenav-menu-heading">
                            <?= $m['menu']; ?>
                        </div>

                        <!-- SUB MENU -->
                        <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT *
                                     FROM `user_sub_menu` JOIN `user_menu`
                                     ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                     WHERE `user_sub_menu`.`menu_id` = $menuId
                                     AND `user_sub_menu`.`is_active` = 1
                                     ";
                        $querySubMenu = $this->db->query($querySubMenu)->result_array();
                        ?>
                        <?php foreach ($querySubMenu as $sm) : ?>
                            <?php if ($judul == $sm['title']) : ?>
                                <a class="nav-link active pb-0" href="<?= base_url($sm['url']); ?>">
                                <?php else : ?>
                                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                                    <?php endif; ?>
                                    <span class="sb-nav-link-icon"><i class="<?= $sm['icon']; ?>"></i></span>
                                    <?= $sm['title']; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endforeach ?>

                            <!-- End of Menu Management -->
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <b><?= $user['name']; ?></b>
                <!-- Toggle DarkMode -->
                <div class="form-check form-switch me-3">
                    <label class="form-check-label ms-3" for="lightSwitch">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                        </svg>
                    </label>
                    <input class="form-check-input" type="checkbox" id="lightSwitch" />
                </div>
            </div>
        </nav>
    </div>