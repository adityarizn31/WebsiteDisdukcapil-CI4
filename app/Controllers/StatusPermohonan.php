<?php

namespace App\Controllers;

use App\Models\Pendaftaran_aktakelahiran_Model;
use App\Models\Pendaftaran_aktakematian_Model;
use App\Models\Pendaftaran_keabsahanakla_Model;
use App\Models\Pendaftaran_kia_Model;
use App\Models\Pendaftaran_kk_Model;
use App\Models\Pendaftaran_kkperceraian_Model;
use App\Models\Pendaftaran_pelayanandata_Model;
use App\Models\Pendaftaran_suratperpindahan_Model;
use App\Models\Pendaftaran_suratperpindahanluar_Model;
use App\Models\Pengaduan_update_Model;
use App\Models\Perbaikan_data_Model;

class StatusPermohonan extends BaseController
{
    private $services = [
        'pendaftaran_kk' => ['label' => 'Kartu Keluarga', 'model' => Pendaftaran_kk_Model::class],
        'pendaftaran_kk_perceraian' => ['label' => 'Kartu Keluarga Perceraian', 'model' => Pendaftaran_kkperceraian_Model::class],
        'pendaftaran_kia' => ['label' => 'Kartu Identitas Anak', 'model' => Pendaftaran_kia_Model::class],
        'pendaftaran_suratperpindahan' => ['label' => 'Surat Perpindahan', 'model' => Pendaftaran_suratperpindahan_Model::class],
        'pendaftaran_suratperpindahanluar' => ['label' => 'Surat Perpindahan ke Majalengka', 'model' => Pendaftaran_suratperpindahanluar_Model::class],
        'pendaftaran_aktakelahiran' => ['label' => 'Akta Kelahiran', 'model' => Pendaftaran_aktakelahiran_Model::class],
        'pendaftaran_aktakematian' => ['label' => 'Akta Kematian', 'model' => Pendaftaran_aktakematian_Model::class],
        'pendaftaran_keabsahanakla' => ['label' => 'Keabsahan Akta Kelahiran', 'model' => Pendaftaran_keabsahanakla_Model::class],
        'pendaftaran_pelayanandata' => ['label' => 'Pelayanan Pemanfaatan Data', 'model' => Pendaftaran_pelayanandata_Model::class],
        'perbaikan_data' => ['label' => 'Perbaikan Data', 'model' => Perbaikan_data_Model::class],
        'pengaduan_update' => ['label' => 'Pengaduan Update', 'model' => Pengaduan_update_Model::class],
    ];

    public function index()
    {
        return view('pelayanan_views/lacak_permohonan', [
            'title' => 'Lacak Permohonan || Disdukcapil Majalengka',
            'trackingResult' => session()->getFlashdata('tracking_result'),
            'trackingError' => session()->getFlashdata('tracking_error'),
        ]);
    }

    public function cari()
    {
        $code = strtoupper(trim((string) $this->request->getPost('tracking_code')));
        if (!preg_match('/^[A-F0-9]{32}$/', $code)) {
            return redirect()->to('/lacak-permohonan')->with('tracking_error', 'Kode pelacakan tidak ditemukan. Periksa kembali kode Anda.');
        }

        $tracking = \Config\Database::connect()
            ->table('application_tracking')
            ->where('tracking_code', $code)
            ->get()
            ->getRowArray();

        if (!$tracking || !isset($this->services[$tracking['service_key']])) {
            return redirect()->to('/lacak-permohonan')->with('tracking_error', 'Kode pelacakan tidak ditemukan. Periksa kembali kode Anda.');
        }

        $service = $this->services[$tracking['service_key']];
        $modelClass = $service['model'];
        $application = (new $modelClass())->find((int) $tracking['application_id']);

        if (!$application) {
            return redirect()->to('/lacak-permohonan')->with('tracking_error', 'Kode pelacakan tidak ditemukan. Periksa kembali kode Anda.');
        }

        session()->setFlashdata('tracking_result', [
            'service' => $service['label'],
            'status' => !empty($application['status']) ? $application['status'] : 'Menunggu Verifikasi',
            'created_at' => $tracking['created_at'],
        ]);

        return redirect()->to('/lacak-permohonan');
    }
}
