<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,200&family=Sarabun:wght@200;400&family=Thasadith:ital@0;1&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Builder Management Program</title>
    <style>
        * {
            font-family: 'Prompt', sans-serif;
            scroll-behavior: smooth;
        }
        .form_label{
            height: 35px;
        }
        .btn-login{
            width: 100%;
            height: 50px;
            background-color: #2650c9
        }
        .card{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
            transition: 0.1s;
        }
        .card-body{
            padding: 10%;
        }
        body{
            background-color: #f7f8fab3;
            display: flex;
            height: 100%;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="height: 120px;"></div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center mb-3">
                                            <img src="{{ asset('/img/logo.jpg') }}" alt="logo_mtc" width="350px">
                                        </div>
                                        <h5 class="text-center mb-4">เข้าสู่ระบบ Building Management</h5>
                                        <form method="post" action="{{ route('check') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form_label"><strong>รหัสพนักงาน</strong></label>
                                                <input type="text" class="form-control" name="user_name"
                                                    placeholder="รหัสประจำตัวพนักงาน">
                                            </div>
                                            <div style="height: 10px;"></div>
                                            <div class="form-group">
                                                <label class="form_label"><strong>รหัสผ่าน</strong></label>
                                                <input type="password" class="form-control" name="user_pass"
                                                    placeholder="กรุณากรอกรหัสผ่าน">
                                            </div>
                                            <br />
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-login">เข้าสู่ระบบ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
