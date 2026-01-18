<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000000;
            color: #C1922B;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            width: 100%;
        }
        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #111111;
            border: 1px solid #C1922B;
            border-radius: 6px;
            overflow: hidden;
        }
        .content-cell {
            padding: 20px;
            color: #C1922B;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #C1922B;
        }
        .button a {
            background-color: #C1922B !important;
            color: #000000 !important;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            display: inline-block;
        }
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }
            .footer {
                width: 100% !important;
            }
        }
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
    {!! $head ?? '' !!}
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    {!! $header ?? '' !!}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {!! Illuminate\Mail\Markdown::parse($slot) !!}
                                        {!! $subcopy ?? '' !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {!! $footer ?? '' !!}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>