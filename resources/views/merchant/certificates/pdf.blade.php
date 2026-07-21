<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Achievement</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: #e7ece8;
            color: #111827;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            overflow: hidden;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .certificate-page {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            background: #fffdfa;
            border: 12px solid #0b5d38;
            box-sizing: border-box;
            page-break-inside: avoid;
            page-break-after: avoid;
        }

        .inner-frame {
            border: 2px solid #0b5d38;
            margin: 8px;
            height: calc(100% - 16px);
            box-sizing: border-box;
            background: rgba(255, 253, 250, 0.92);
            position: relative;
            z-index: 2;
        }

        .inner-frame-2 {
            border: 1px solid #c8942f;
            margin: 8px;
            height: calc(100% - 16px);
            box-sizing: border-box;
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
        }

        .content {
            padding: 8px 24px 0;
            box-sizing: border-box;
            height: 100%;
        }

        .header-row {
            text-align: center;
            padding-top: 4px;
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        .divider {
            width: 420px;
            height: 1px;
            border-top: 2px solid #0b5d38;
            margin: 4px auto 0;
        }

        .title-block {
            text-align: center;
            margin-top: 8px;
        }

        .certificate-title {
            font-size: 22px;
            font-weight: 700;
            color: #0b5d38;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .certificate-subtitle {
            font-size: 12px;
            font-weight: 600;
            color: #0b5d38;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .body-text {
            text-align: center;
            margin-top: 10px;
        }

        .lead {
            font-size: 13px;
            color: #6b7280;
            font-style: italic;
            margin: 0;
        }

        .name {
            margin-top: 6px;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            color: #111827;
            letter-spacing: 2px;
        }

        .meta {
            margin-top: 6px;
            font-size: 11px;
            color: #4b5563;
            margin-bottom: 0;
        }

        .course {
            margin-top: 6px;
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .footer-table {
            margin-top: 16px;
            width: 100%;
        }

        .footer-cell-left,
        .footer-cell-middle,
        .footer-cell-right {
            vertical-align: bottom;
            padding: 0;
        }

        .footer-cell-left {
            width: 28%;
            text-align: left;
        }

        .footer-cell-middle {
            width: 44%;
            text-align: center;
        }

        .footer-cell-right {
            width: 28%;
            text-align: right;
        }

        .date-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #111827;
        }

        .date-value {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
            margin-top: 2px;
        }

        .sig-line {
            width: 150px;
            border-top: 2px solid #111827;
            margin: 0 auto 6px;
        }

        .sig-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #111827;
        }

        .qr-bg {
            display: inline-block;
            width: 76px;
            height: 76px;
            padding: 0;
            background: #ffffff;
            box-sizing: border-box;
        }

        .qr-bg img {
            width: 76px;
            height: 76px;
            display: block;
        }
    </style>
</head>
<body>
    @include('merchant.certificates.partials.certificate-page')
</body>
</html>
