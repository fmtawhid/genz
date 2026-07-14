<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CertificatesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $merchant = $user->merchant;

        $certificates = Admission::with('course')
            ->where('merchant_id', $merchant->id)
            ->where('status', 'approved')
            ->latest()
            ->paginate(12);

        return view('merchant.certificates.index', compact('certificates'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $merchant = $user->merchant;

        $certificate = Admission::with('course')
            ->where('merchant_id', $merchant->id)
            ->where('status', 'approved')
            ->findOrFail($id);

        $certificateUrl = route('merchant.certificates.verify', ['token' => $this->makeVerificationToken($certificate)]);

        return view('merchant.certificates.show', compact('certificate', 'certificateUrl'));
    }

    public function download($id)
    {
        $user = Auth::user();
        $merchant = $user->merchant;

        $certificate = Admission::with('course')
            ->where('merchant_id', $merchant->id)
            ->where('status', 'approved')
            ->findOrFail($id);

        $certificateUrl = route('merchant.certificates.verify', ['token' => $this->makeVerificationToken($certificate)]);

        $pdf = Pdf::loadView('merchant.certificates.pdf', compact('certificate', 'certificateUrl'));

        return $pdf->download(Str::slug($certificate->course->title) . '-certificate.pdf');
    }

    public function verify($token)
    {
        $certificate = Admission::with('course')->where('status', 'approved')->firstWhere('verification_token', $token);

        if (! $certificate) {
            abort(404);
        }

        return view('merchant.certificates.verify', compact('certificate'));
    }

    protected function makeVerificationToken(Admission $certificate): string
    {
        if (! empty($certificate->verification_token)) {
            return $certificate->verification_token;
        }

        $token = hash('sha256', $certificate->id . ':' . $certificate->course_id . ':' . now()->timestamp);

        try {
            if (Schema::hasColumn('admissions', 'verification_token')) {
                $certificate->verification_token = $token;
                $certificate->saveQuietly();
            }
        } catch (\Throwable $e) {
            // Ignore schema issues and continue with the generated token.
        }

        return $token;
    }
}
