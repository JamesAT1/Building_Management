<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   Swal.fire({
                title: 'สำเร็จ!',
                text: 'ได้เปลี่ยนข้อมูลพนักงานได้สำเร็จ',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                confirmButtonText: 'ตกลง',
            }).then((result) => {
                if(result.isConfirmed){

                    location.href = "{{url('/show_user')}}";
                }
            });
</script>
</body>
</html>