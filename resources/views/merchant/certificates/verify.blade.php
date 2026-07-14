<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Verification</title>
    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }
        .card {
            max-width: 760px;
            margin: auto;
            padding: 28px;
            border-radius: 24px;
            background: #fffdfa;
            border: 12px solid #0b5d38;
            box-shadow: 0 18px 45px rgba(0,0,0,0.14);
        }
        .badge {
            display: inline-block;
            padding: 8px 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }
        .title {
            margin-top: 16px;
            font-size: 28px;
            font-weight: 700;
            color: #0b5d38;
            text-transform: uppercase;
            letter-spacing: 0.16em;
        }
        .subtitle {
            margin-top: 8px;
            font-size: 16px;
            color: #6b7280;
        }
        .meta {
            margin-top: 24px;
            color: #374151;
            line-height: 1.7;
        }
        .meta p {
            margin: 6px 0;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">Verified Certificate</div>
        <div class="title">GEN-Z IT INSTITUTE</div>
        <div class="subtitle">Certificate of Achievement</div>
        <div class="meta">
            <p><strong>Student:</strong> {{ $certificate->name }}</p>
            <p><strong>Course:</strong> {{ $certificate->course->title }}</p>
            <p><strong>Email:</strong> {{ $certificate->email }}</p>
            <p><strong>Issued:</strong> {{ $certificate->updated_at->format('d M Y') }}</p>
            <p><strong>Status:</strong> Approved</p>
        </div>
    </div>
</body>
</html>
