<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="{{ url('/') }}/template_mobile/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ url('/') }}/template_mobile/assets/img/favicon-32x32.png" sizes="32x32">

    <title>MD Mall</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="{{ url('/') }}/template_mobile/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="{{ url('/') }}/template_mobile/assets/css/login_page.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/template_mobile/sweetalert2/sweetalert2.min.css" />
</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card" style="position: absolute;width: 100%;right: 5px;left: 5px;top: calc(100vh - 80%);">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <h1>Morodadi</h1>
                </div>
                <form id="formLogin">
                    <div class="uk-form-row">
                        <label for="username">Username</label>
                        <input class="md-input" type="text" id="username" name="username"  autocomplete="false" />
                    </div>
                    <div class="uk-form-row">
                        <label for="password">Password</label>
                        <input class="md-input" type="password" id="password" name="password"  autocomplete="false" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="button" onClick="login()" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- common functions -->
    <script src="{{ url('/') }}/template_mobile/assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="{{ url('/') }}/template_mobile/assets/js/uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="{{ url('/') }}/template_mobile/assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="{{ url('/') }}/template_mobile/assets/js/pages/login.min.js"></script>
    <script src="{{ url('/') }}/template_mobile/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function login(){
            if($("#username").val()==""){
                Swal.fire({icon: 'warning',title: 'Username Tidak Boleh Kosong'})
                return false;
            }
            if($("#password").val()==""){
                Swal.fire({icon: 'warning',title: 'Password Tidak Boleh Kosong'})
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url : "{{ url('api/mob/login') }}",
                type: "POST",
                data:$("#formLogin").serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status){
                        Swal.close();
                        window.location.href = "{{ url('mobile_dashboard') }}";
                    }else{
                        Swal.fire({icon: 'error',title: 'Oops...',text: data.message,})
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire({icon: 'error',title: 'Oops...',text: 'Something went wrong!',})
                },
                beforeSend: function(){
                    Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
                }
            });

        }
    </script>
</body>
</html>