<!DOCTYPE html>
<html>
    <head>
        <title>Soluciones Integrales</title>
        <link rel="icon" href="<?php echo asset('images/integralIcono.png')?>" sizes="192x192" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo asset('css/email.css')?>" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                font-size: 100%;
                line-height: 1.6;
            }
            img {
                max-width: 100%;
            }
            body {
                -webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: none;
                width: 100%!important;
                height: 100%;
            }
            a {
                color: #348eda;
            }
            .btn-primary {
                text-decoration: none;
                color: #FFF;
                background-color: #348eda;
                border: solid #348eda;
                border-width: 10px 20px;
                line-height: 2;
                font-weight: bold;
                margin-right: 10px;
                text-align: center;
                cursor: pointer;
                display: inline-block;
                border-radius: 25px;
            }
            .btn-secondary {
                text-decoration: none;
                color: #FFF;
                background-color: #aaa;
                border: solid #aaa;
                border-width: 10px 20px;
                line-height: 2;
                font-weight: bold;
                margin-right: 10px;
                text-align: center;
                cursor: pointer;
                display: inline-block;
                border-radius: 25px;
            }
            .last {
                margin-bottom: 0;
            }
            .first {
                margin-top: 0;
            }
            .padding {
                padding: 10px 0;
            }
            table.body-wrap {
                width: 100%;
                padding: 20px;
            }
            table.body-wrap .container {
                border: 1px solid #f0f0f0;
            }
            table.footer-wrap {
                width: 100%;
                clear: both!important;
            }
            .footer-wrap .container p {
                font-size: 12px;
                color: #666;

            }
            table.footer-wrap a {
                color: #999;
            }
            h1, h2, h3 {
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                line-height: 1.1;
                margin-bottom: 15px;
                color: #000;
                margin: 40px 0 10px;
                line-height: 1.2;
                font-weight: 200;
            }
            h1 {
                font-size: 36px;
            }
            h2 {
                font-size: 28px;
            }
            h3 {
                font-size: 22px;
            }
            p, ul, ol {
                margin-bottom: 10px;
                font-weight: normal;
                font-size: 14px;
            }
            ul li, ol li {
                margin-left: 5px;
                list-style-position: inside;
            }
            .container {
                display: block!important;
                max-width: 600px!important;
                margin: 0 auto!important; /* makes it centered */
                clear: both!important;
            }
            .body-wrap .container {
                padding: 20px;
            }
            .content {
                max-width: 600px;
                margin: 0 auto;
                display: block;
            }
            .content table {
                width: 100%;
            }
            
            .data-box {
                width: 100%;
                background-color: #dfe9f1;
                border-radius: 5px;
                padding: 5px 10px;
                border: 1px solid #01274b;
            }            
        </style>        
    </head>
    
    <body bgcolor="#f6f6f6">
        <table class="body-wrap">
            <tr>
                <td></td>
                <td class="container" bgcolor="#FFFFFF">
                    <div class="content">
                        <table>
                            <tr valign="top">
                                <td align="left">
                                    <a href="http://{{request()->getHttpHost()}}">
                                        <img src="http://envios.soluciones-integrales.com.ve/images/cropped-integral-logo-envios.png" width="250px">
                                    </a><br>
                                    RIF J-404421556
                                </td>
                                <td align="right">
                                    <p>
                                        9802 NW 80th Avenue<br>
                                        BAY-G47<br>
                                        Hialeah, Florida 33016-2342 USA<br>
                                    </p>                                    
                                </td>
                            </tr>
                            <!-- Email content goes here .. -->
                            @yield('content')
                        </table>
                    </div>
                </td>
                <td></td>
            </tr>
        </table>      
        <!-- Footer -->
        <table class="footer-wrap">
            <tr>
                <td></td>
                <td class="container">
                    <div class="content">
                        <table>
                            <tr>
                                <td align="center">
                                    
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td></td>
            </tr>
        </table>
        <!-- /Footer -->        
    </body>
</html>