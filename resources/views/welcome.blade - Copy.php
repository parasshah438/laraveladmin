
<?php include('BrowserDetection.php');
include('Mobile_Detect.php');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="">
                    <form id="visitordata" method="post">
                        @csrf
                        <?php  
                        if (Auth::check()) { ?>
                        <input type="hidden" name="username" id="username" value="<?php echo Auth::user()->name; ?>">
                        <?php }else { ?>
                        <input type="hidden" name="username" id="username" value="not login user">
                        <?php } ?>

                        <?php 

                        $browser=new Wolfcast\BrowserDetection;
                        $browser_name=$browser->getName();
                        $browser_version=$browser->getVersion();
                        $detect=new Mobile_Detect();
                        $MAC = exec('getmac'); 
                        $MAC_value = strtok($MAC," "); 

                        if($detect->isMobile()){ ?>
                           <input type="hidden" name="device" id="device" value="Mobile">
                        <?php }elseif($detect->isTablet()){ ?>
                          
                            <input type="hidden" name="device" id="device" value=" <?php  echo $type='Tablet'; ?>">
                        <?php }else{ ?>
                            
                            <input type="hidden" name="device" id="device" value="<?php echo $type='PC'; ?>">
                       <?php } ?>

                       <?php if($detect->isiOS()){ ?>
                           <input type="hidden" name="ios" id="ios" value="IOS">
                        <?php }elseif($detect->isTablet()){ ?>
                             
                            <input type="hidden" name="ios" id="ios" value="Android">
                        <?php }else{ ?>
                           
                            <input type="hidden" name="ios" id="ios" value="Window">
                       <?php } ?>
                        <input type="hidden" name="browser" id="browser" value="<?php echo $browser_name; ?>">
                        <input type="hidden" name="browser_version" id="browser_version" value="<?php echo $browser_version; ?>">
                        <input type="hidden" name="ip" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                        <input type="hidden" name="mac" id="mac" value="<?php echo $MAC_value; ?>">
                    </form>
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="{{asset('public/admins/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
       var username = $('#username').val();
       var browser = $('#browser').val();
       var browser_version = $('#browser_version').val();
       var device = $('#device').val();
       var ios = $('#ios').val();
       var ip = $('#ip').val();
       var mac = $('#mac').val();
      
       $.ajax({
            url:"{{url('/getdata')}}",
            type: "post",
            data:$('#visitordata').serialize(),
            success:function(result){
            }
       });
    })
</script>