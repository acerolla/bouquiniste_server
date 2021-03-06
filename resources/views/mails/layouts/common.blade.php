<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>APP</title>
    <style type="text/css">
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 10px;
            background: #fff;
            font-weight: normal;
            line-height: 1.2;
            color: #212529;
            text-align: left;
            font-family: 'Open Sans', sans-serif !important;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        h1, h2, h3, h4, h5, h6, h7 {
            color: #7084ab;
        }

        table {
            border-spacing: 0;
            table-layout: fixed;
        }

        .wrapper {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
            width: 100%;
            height: 100%;
        }

        .header {
            background: #eef8ff;
            height: 60px;
        }

        .wrapper td {
        }

        .content-cell {
            width: 600px;
        }

        .spacing {
            width: auto;
        }

        .header-line {
            width: 100%;
        }

        .left-column {
            text-align: left;
            padding-left: 10px;
        }

        .right-column {
            text-align: right;
            padding-right: 10px;
        }

        .right-column a {
            color: #7f888f;
            font-weight: normal;
            position: relative;
            text-decoration: underline;
        }

        .logo {
            width: 97px;
        }

        .footer {
            height: 100px;
            background: #fafbff;
        }

        .footer h3 {
            margin-top: 6px;
        }

        .footer-line {
            width: 100%;
        }

        .footer-line td {
            vertical-align: top;
            padding: 30px 0 30px 0;
        }

        .footer-line ol, .footer-line ul {
            list-style-type: none;
            color: #899196;
            font-size: 15px;
            margin: 0;
            padding: 0;
        }

        .footer-line ul a {
            color: #899196;
        }

        .footer-line ol li, .footer-line ul li {
            margin: 6px 0 0 0;
        }

        .content-cell {
            padding: 90px 0 90px 0;
        }

        .header .content-cell {
            padding: 0 0 0 0;
        }
    </style>
</head>
<body>
<table class="wrapper">
    <tr>
        <td></td>
        <td class="content-cell">
            @yield('content')
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>