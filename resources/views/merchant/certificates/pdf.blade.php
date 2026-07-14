<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Achievement</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }
        .certificate {
            width: 1000px;
            height: 700px;
            margin: 20px auto;
            padding: 28px;
            box-sizing: border-box;
            border: 12px solid #0b5d38;
            background: #fffdfa;
            position: relative;
            overflow: hidden;
        }
        .header {
            border-bottom: 1px solid rgba(11,93,56,0.2);
            padding-bottom: 16px;
        }
        .header-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #0b5d38;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header-subtitle {
            text-align: center;
            font-size: 16px;
            color: #0b5d38;
            margin-top: 6px;
            letter-spacing: 3px;
            font-weight: 600;
        }
        .content {
            text-align: center;
            padding-top: 28px;
            position: relative;
            z-index: 2;
        }
        .lead {
            font-size: 15px;
            color: #6b7280;
            font-style: italic;
        }
        .name {
            margin-top: 16px;
            font-size: 34px;
            font-weight: 700;
            text-transform: uppercase;
            color: #111827;
        }
        .course {
            margin-top: 20px;
            font-size: 22px;
            font-weight: 700;
            color: #111827;
        }
        .meta {
            margin-top: 18px;
            font-size: 14px;
            color: #4b5563;
            line-height: 1.6;
        }
        .footer {
            position: absolute;
            bottom: 28px;
            left: 28px;
            right: 28px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 12px;
            color: #4b5563;
            z-index: 2;
        }
        .signature {
            text-align: center;
        }
        .sig-line {
            width: 180px;
            border-top: 2px solid #111827;
            margin: 0 auto 6px;
        }
        .qr {
            width: 90px;
            height: 90px;
            border: 2px solid #0b5d38;
            padding: 6px;
            background: white;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <div class="header-title">GEN-Z IT INSTITUTE</div>
            <div class="header-subtitle">CERTIFICATE OF ACHIEVEMENT</div>
        </div>

        <div class="content">
            <p class="lead">This is to certify that</p>
            <div class="name">{{ $certificate->name }}</div>
            <p class="meta">has successfully completed the course</p>
            <div class="course">{{ $certificate->course->title }}</div>
            <p class="meta">Issued on {{ $certificate->updated_at->format('d M Y') }}</p>
        </div>

        <div class="footer">
            <div>
                <p><strong>Date of Issue:</strong> {{ $certificate->updated_at->format('d M Y') }}</p>
            </div>
            <div class="signature">
                <div class="sig-line"></div>
                <p>Authorized Signature</p>
            </div>
            <div>
                <img class="qr" src="{{ $certificateUrl }}" alt="Verification link">
            </div>
        </div>
    </div>
</body>
</html>
