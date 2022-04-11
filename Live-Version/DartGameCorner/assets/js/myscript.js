const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal({
        title: 'Data Movie ',
        text: 'Berhasil ' + flashData,
        type: 'success'
    });
}

// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin',
        text: "data movie akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});

// Toggle DarkMode/LightMode
const cards = document.querySelectorAll('.card');
const lists = document.querySelectorAll('.list');
const checkbox = document.getElementById('checkbox');
checkbox.addEventListener('change', () => {
//change theme of the website
document.body.classList.toggle('dark');
cards.forEach(card => card.classList.toggle('bg-dark'));
lists.forEach(list => list.classList.toggle('bg-dark'));
});
