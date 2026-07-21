<div class="certificate-page">
    <img src="{{ asset('assets/img/bdpdf.svg') }}" alt="" style="position:absolute; left:0; top:0; right:0; bottom:0; width:100%; height:100%; display:block; object-fit:cover; opacity:0.16; z-index:1;" />
    <div class="inner-frame">
        <div class="inner-frame-2">
            <div class="content">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="header-row" colspan="2" style="text-align:center;">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 64px; height: 54px; display:block; margin:0 auto 4px;" />
                            <div class="header-title">GEN-Z IT INSTITUTE</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <div class="divider"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <div class="title-block">
                                <div class="certificate-title">Certificate</div>
                                <div class="certificate-subtitle">Of Achievement</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <div class="body-text">
                                <p class="lead">This is to certify that</p>
                                <div class="name">{{ $certificate->name }}</div>
                                <p class="meta">has successfully completed the course</p>
                                <div class="course">{{ $certificate->course->title }}</div>
                                <p class="meta">Issued on {{ $certificate->updated_at->format('d M Y') }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="footer-table" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="footer-cell-left">
                                        <div class="date-label">Date of Issue</div>
                                        <div class="date-value">{{ $certificate->updated_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="footer-cell-middle">
                                        <div class="sig-line"></div>
                                        <div class="sig-label">Authorized Signature</div>
                                    </td>
                                    <td class="footer-cell-right">
                                        <div class="qr-bg">
                                            @if(! empty($qrImageData))
                                                <img src="{{ $qrImageData }}" alt="Verification QR code">
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
