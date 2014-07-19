<script>
    $(document).ready(function() {
        $('.tombol-hapus').click(function() {
            var id = $(this).attr('data-id');
            alertify.set({labels: {
                    ok: "Ya",
                    cancel: "Batal"
                }});
            alertify.confirm("Apakah Anda yakin akan menghapus data ini?", function(e) {
                if (e) {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url('data_informasi/hapus_data_informasi'); ?>',
                        data: 'id=' + id,
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status) {
                                alertify.alert(data.pesan, function() {
                                    location.href = '<?php echo base_url('data_informasi'); ?>';
                                });
                            } else {
                                alertify.alert(data.pesan);
                            }
                        },
                        error: function() {
                            alertify.alert('Terjadi kesalahan saat menghubungkan ke database!');
                            $('#simpan').button('reset');
                        }
                    })
                } else {
                    return false;
                }
            });

        })
    });
</script>