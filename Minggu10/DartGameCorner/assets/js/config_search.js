function search(){
    $("#loading").show(); // Tampilkan loadingnya
    $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET   atau POST
        url: baseurl + "search", // Isi dengan url/path file   php yang dituju
        data: {nama_produk : $("#nama_produk").val()}, // data yang akan dikirim   ke file proses
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF8");
            }
        },
        success: function(response){ // Ketika proses pengiriman  berhasil
        $("#loading").hide(); // Sembunyikan loadingnya
   
        if(response.status == "success"){ // Jika isi dari   array status adalah success
            $("#nama_produk").val(response.nama); // set textbox dengan id   nama
            $("#harga").val(response.harga); // set   textbox dengan id  harga
            $("#stok").val(response.stok); // set textbox   dengan id stok
            $("#keterangan").val(response.keterangan); // set textbox dengan   id keterangan
        } else { // Jika isi dari array status adalah failed
            alert("Data Tidak Ditemukan");
        }
    },
        error: function (xhr, ajaxOptions, thrownError) { //   Ketika ada error
        alert(xhr.responseText);
        }
    });
   }

   $(document).ready(function(){
        $("#loading").hide(); // Sembunyikan loadingnya
   
        $("#btn-search").click(function(){ // Ketika user mengklik   tombol Cari
        search(); // Panggil function search
    });
    //$("#nama_produk").keyup(function(){ // Ketika user menekan tombol di   keyboard
    $("#nama_produk").on(function(){ // Ketika user menekan tombol di   keyboard
    // if(event.keyCode == 13){ // Jika user menekan tombol ENTER
    if(event.keyCode == 13){ // Jika user menekan tombol ENTER
    search(); // Panggil function search
    }
    });
   });
   