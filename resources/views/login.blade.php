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
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,200&family=Sarabun:wght@200;400&family=Thasadith:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Builder Management Program</title>
    <!-- <link rel="stylesheet" href="{{ URL::asset('../cs') }}" /> -->

    <style>
        html,
        body,
        .row {
            height: 100%;
            margin: 0;
        }

        * {
            font-family: 'Prompt', sans-serif;
        }

        .bg-logo {
            height: 100%;
            background: #00a1e5;
        }

        a {
            text-decoration: none;
        }

        .container {
            position: relative;
        }

        form,
        .header {
            width: 95%;
            position: absolute;
            top: 48%;
            transform: translateY(-50%);
        }

        .logo {
            position: absolute;
            top: 50%;
            right: 29%;
            transform: translateY(-50%);
            animation-name: ex;
            animation-duration: 2s;
        }

        .header {
            background-color: #00a1e5;
            top: 50%;
            right: 29%;
            transform: translateY(-50%);
            animation-name: ex;
        }

        .text-header {
            color: white;

        }

        /* @keyframes ex {
    0% {
        right: 29%;
        top: 0px;
    }
} */
    </style>
</head>

<body>
    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="col-12" style="position: relative;">
                    <h3>
                        เข้าสู่ระบบ
                    </h3>
                    <form method="post" action="{{route('check')}}">
                    @csrf
                        <label>รหัสพนักงาน</label>
                        <input type="text" class="form-control" name="user_name" required />
                        <label>รหัสผ่าน</label>
                        <input type="password" class="form-control" name="user_pass" required />
                        <br />
                        <button type="submit" class="btn btn-info form-control" style="color:white;">เข้าสู่ระบบ</button>
                        
                        <!-- <a href="{{route('login')}}" class="btn btn-info form-control" style="color:white;">เข้าสู่ระบบ</a> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9 bg-logo">
            <div>
                <div class="row">
                    <div class="col-12">
                        <center>
                            <!-- <img src="../image/Feature2.jpg" width="90%" /> -->
                            <h3 class="text-header">
                                <div style="height: 10px;"></div>
                                Building Management Program
                            </h3>
                        </center>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>