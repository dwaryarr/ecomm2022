<section id="about">
    <div class="container mt-5">
        <div class="row mt-5">
            <center>
                <h2>
                    <?= $nama; ?></h2>
            </center>
        </div>
        <div class="row mt-5 text-center mb-3 justify-content-center">
            <div class="col-lg">
                <img src="<?= base_url(); ?>assets/images/logo512.png" alt="logo" width="150px">
                <h1><b>Dart</b>GameCorner</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere eligendi quaerat repellendus eum reprehenderit dolores vitae quam, perferendis aperiam maxime quis atque! Facilis ad sapiente, reprehenderit dignissimos voluptatibus perferendis ea!</p>

            </div>
            <div class="row mt-4">
                <div class="col-xl-6">

                    <h3>Visi</h3>
                    <p>Menjadi platform top up dan consignment yang paling diminati dan terkemuka untuk beragam game online dan produk digital di dunia.</p>

                </div>
                <div class="col-xl-6">

                    <h3>Misi</h3>
                    <p>Menawarkan kemudahan di seluruh jenis pembayaran bagi pengguna dan mitra di dalam ekosistem digital.</p>

                </div>
            </div>

        </div>
</section>
<!-- End of about -->

<!-- Contact -->
<section id="contact">
    <div class="container-sm">
        <div class="row text-center mb-3 justify-content-center">
            <div class="col">
                <h2>Kritik & Saran</h2>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
                    <strong>Terima kasih!</strong> Pesan anda berhasil terkirim.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form name="dartgamecorner-contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="nama" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea class="form-control" id="pesan" name="pesan" rows="3"></textarea>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary btn-kirim">Kirim</button>
                        <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Contact -->

<!-- Script Google SpreadSheets Contact Form-->
<script>
    const scriptURL = 'https://script.google.com/macros/s/AKfycbx3bFS4Yu85fdVlD9okvoDK2vPI-NWnCZIC2L1cJ0KDVr9gVuLmfQQh9Bao_k2ya5jEtg/exec'
    const form = document.forms['dartgamecorner-contact-form']
    const btnKirim = document.querySelector('.btn-kirim')
    const btnLoading = document.querySelector('.btn-loading')
    const myAlert = document.querySelector('.my-alert')

    form.addEventListener('submit', e => {
        e.preventDefault()
        btnLoading.classList.toggle('d-none')
        btnKirim.classList.toggle('d-none')
        fetch(scriptURL, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => {
                btnLoading.classList.toggle('d-none')
                btnKirim.classList.toggle('d-none')
                myAlert.classList.toggle('d-none')
                form.reset()
                console.log('Success!', response)
            })
            .catch(error => console.error('Error!', error.message))
    })
</script>