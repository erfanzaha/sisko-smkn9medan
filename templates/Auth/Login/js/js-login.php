<script>
var ins = $('#form-data').on('submit', function(e){
      
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });
        $.ajax({
          url: "/auth/proses-login",
          method: 'post',
          data: new FormData(this),
          dataType: "json",
          contentType: false,
          cache: false,
          processData: false,
          success: function(r){
            if(r.icon == 'success'){
                swal({
                    title: "Success",
                    icon: r.icon,
                    text: r.msg,
                    dangerMode: false,
                    buttons: {                        
                        confirm: "Lanjut ke dashboard",
                    }
                }).then((ok) => {
                  window.location.href = r.link;
                });
              }else{
                swal({
                    title: r.icon,
                    text: r.msg,
                    icon: r.icon
                });
              }
          }
        }); 
      
    });
</script>