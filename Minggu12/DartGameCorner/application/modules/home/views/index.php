<div class="container mt-5">
    <div class="row-lg mt-5">
        <center>
            <h2>
                Welcome to the Home Page, <?= $nama; ?>!</h2>
        </center>
    </div>
    <div class="row mt-5">
        <?php if ($this->session->flashdata('flash')) {
            echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
        } ?>
        <?php foreach ($products as $row) : ?>
            <div class="col-md-3 mb-5">
                <div class="card-group">
                    <div class="card bg-light cardmovie h-100" style="border :none" data-aos="zoom-out-up" data-aos-offset="250" data-aos-duration="1000">
                        <a href="<?= base_url(); ?>home/detail/<?= $row['id_produk']; ?>" class="text-decoration-none">
                            <img src="<?= base_url('assets/images/produk/') . $row['gambar']; ?>" class="card-img-top image-resize rounded">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["nama_produk"]; ?></h5>
                            </div>
                        </a>
                        <div class="card-text text-muted ms-2 ket">
                            <h6><?= $row["keterangan"]; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?= $this->pagination->create_links(); ?>
    </div>
</div>
<a id="myBtn" class="btn btn-info" href="<?= base_url(); ?>home/cekorder">Cek Proses Order!</a>

<!-- Cek Order -->
<script>
    var mybutton = document.getElementById("myBtn");
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };
    mybutton.style.display = "block"; // Show the button

    // function scrollFunction() {
    //     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    //         mybutton.style.display = "block";
    //     } else {
    //         mybutton.style.display = "none"; //none
    //     }
    // }
</script>