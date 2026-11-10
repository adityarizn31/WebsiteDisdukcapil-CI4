<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\BeritaModel;
use App\Models\InovasiModel;
use App\Models\VisiMisiModel;
use App\Models\PersyaratansilancarModel;

// Halaman Pendaftaran Si Lancar

use App\Models\Pendaftaran_kk_Model;
use App\Models\Pendaftaran_kia_Model;
use App\Models\Pendaftaran_suratperpindahan_Model;
use App\Models\Pendaftaran_suratperpindahanluar_Model;

use App\Models\Pendaftaran_aktakelahiran_Model;
use App\Models\Pendaftaran_aktakematian_Model;
use App\Models\Pendaftaran_keabsahanakla_Model;

use App\Models\Pendaftaran_pelayanandata_Model;

use App\Models\Perbaikan_data_Model;
use App\Models\Pengaduan_update_Model;

// Halaman Pelayanan

use App\Models\PelayananModel;

use App\Models\Pelayanan_kk_Model;
use App\Models\Pelayanan_kia_Model;
use App\Models\Pelayanan_suratperpindahan_Model;
use App\Models\Pelayanan_suratperpindahanluar_Model;

use App\Models\Pelayanan_aktakelahiran_Model;
use App\Models\Pelayanan_aktakematian_Model;
use App\Models\Pelayanan_keabsahanakla_Model;

use App\Models\Pelayanan_pelayanandata_Model;

use App\Models\Pelayanan_perbaikandata_Model;
use App\Models\Pelayanan_pengaduanupdate_Model;

class Pelayanan extends BaseController
{
  protected $adminModel;
  protected $beritaModel;
  protected $inovasiModel;
  protected $visimisiModel;
  protected $persyaratansilancarModel;

  // Halaman Pendaftaran Si Lancar

  protected $kkModel;
  protected $kiaModel;
  protected $suratperpindahanModel;
  protected $suratperpindahanluarModel;

  protected $aktakelahiranModel;
  protected $aktakematianModel;
  protected $keabsahanaklaModel;

  protected $pelayanandataModel;

  protected $perbaikandataModel;
  protected $pengaduanupdateModel;

  // Halaman Pelayanan

  protected $pelayananModel;

  protected $pelkkModel;
  protected $pelkiaModel;
  protected $pelsuratperpindahanModel;
  protected $pelsuratperpindahanluarModel;

  protected $pelaktakelahiranModel;
  protected $pelaktakematianModel;
  protected $pelkeabsahanaklaModel;

  protected $pelpelayanandataModel;

  protected $pelperbaikandataModel;
  protected $pelpengaduanupdateModel;

  public function __construct()
  {
    $this->adminModel = new AdminModel();
    $this->beritaModel = new BeritaModel();
    $this->inovasiModel = new InovasiModel();
    $this->visimisiModel = new VisiMisiModel();
    $this->persyaratansilancarModel = new PersyaratansilancarModel();

    // Halaman Pendaftaran Si Lancar

    $this->kkModel = new Pendaftaran_kk_Model();
    $this->kiaModel = new Pendaftaran_kia_Model();
    $this->suratperpindahanModel = new Pendaftaran_suratperpindahan_Model();
    $this->suratperpindahanluarModel = new Pendaftaran_suratperpindahanluar_Model();

    $this->aktakematianModel = new Pendaftaran_aktakematian_Model();
    $this->aktakelahiranModel = new Pendaftaran_aktakelahiran_Model();
    $this->keabsahanaklaModel = new Pendaftaran_keabsahanakla_Model();

    $this->pelayanandataModel = new Pendaftaran_pelayanandata_Model();

    $this->perbaikandataModel = new Perbaikan_data_Model();
    $this->pengaduanupdateModel = new Pengaduan_update_Model();

    // Halaman Pelayanan

    $this->pelayananModel = new PelayananModel();

    $this->pelkkModel = new Pelayanan_kk_Model();
    $this->pelkiaModel = new Pelayanan_kia_Model();
    $this->pelsuratperpindahanModel = new Pelayanan_suratperpindahan_Model();
    $this->pelsuratperpindahanluarModel = new Pelayanan_suratperpindahanluar_Model();

    $this->pelaktakelahiranModel = new Pelayanan_aktakelahiran_Model();
    $this->pelaktakematianModel = new Pelayanan_aktakematian_Model();
    $this->pelkeabsahanaklaModel = new Pelayanan_keabsahanakla_Model();

    $this->pelpelayanandataModel = new Pelayanan_pelayanandata_Model();

    $this->pelperbaikandataModel = new Pelayanan_perbaikandata_Model();
    $this->pelpengaduanupdateModel = new Pelayanan_pengaduanupdate_Model();
  }

  public function index()
  {
    $data = [
      'title' => 'Pelayanan Online || Disdukcapil Majalengka'
    ];
    return view('pelayanan/index', $data);
  }













  // Si Lancar 1
  // Menampilkan Form Pendaftaran KK
  public function pendaftaran_kk()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran KK || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaran_kk', $data);
  }

  // Validasi Pendaftaran KK
  public function saveKK()
  {
    if (!$this->validate([

      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_kk.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ]
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_kk.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ]
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_kk.nomorpemohon]',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!'
        ]
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_kk.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Form Formulir Desa
      'formulirdesa' => [
        'rules' => 'uploaded[formulirdesa]|max_size[formulirdesa,1024]|mime_in[formulirdesa,application/pdf]|ext_in[formulirdesa,pdf]',
        'errors' => [
          'uploaded' => 'Formulir Desa Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Form KK Suami
      'kartukeluargasuami' => [
        'rules' => 'uploaded[kartukeluargasuami]|max_size[kartukeluargasuami,1024]|mime_in[kartukeluargasuami,application/pdf]|ext_in[kartukeluargasuami,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Suami Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Form KK Istri
      'kartukeluargaistri' => [
        'rules' => 'uploaded[kartukeluargaistri]|max_size[kartukeluargaistri,1024]|mime_in[kartukeluargaistri,application/pdf]|ext_in[kartukeluargaistri,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Istri Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Form Surat Nikah
      'suratnikah' => [
        'rules' => 'uploaded[suratnikah]|max_size[suratnikah,1024]|mime_in[suratnikah,application/pdf]|ext_in[suratnikah,pdf]',
        'errors' => [
          'uploaded' => 'Surat Nikah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Form Surat Pindah
      'suratpindah' => [
        'rules' => 'uploaded[suratpindah]|max_size[suratpindah,1024]|mime_in[suratpindah,application/pdf]|ext_in[suratpindah,pdf]',
        'errors' => [
          'uploaded' => 'Surat Pindah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ]

    ])) {
      return redirect()->to(base_url() . '/pelayanan/pendaftaran_kk/')->withInput();
    }

    // Berkas Formulir Desa
    $berkasFormulirDesa_KK = $this->request->getFile('formulirdesa');
    $namaFormulirDesa_KK = $berkasFormulirDesa_KK->getName();
    $berkasFormulirDesa_KK->move('pelayanan/kk', $namaFormulirDesa_KK);

    // Berkas KK Suami
    $berkasKKSuami_KK = $this->request->getFile('kartukeluargasuami');
    $namaKKSuami_KK = $berkasKKSuami_KK->getName();
    $berkasKKSuami_KK->move('pelayanan/kk', $namaKKSuami_KK);

    // Berkas KK Istri
    $berkasKKIstri_KK = $this->request->getFile('kartukeluargaistri');
    $namaKKIstri_KK = $berkasKKIstri_KK->getName();
    $berkasKKIstri_KK->move('pelayanan/kk', $namaKKIstri_KK);

    // Berkas Surat Nikah
    $berkasSuratNikah_KK = $this->request->getFile('suratnikah');
    $namaSuratNikah_KK = $berkasSuratNikah_KK->getName();
    $berkasSuratNikah_KK->move('pelayanan/kk', $namaSuratNikah_KK);

    // Berkas Surat Pindah
    $berkasSuratPindah_KK = $this->request->getFile('suratpindah');
    $namaSuratPindah_KK = $berkasSuratPindah_KK->getName();
    $berkasSuratPindah_KK->move('pelayanan/kk', $namaSuratPindah_KK);

    $this->saveTrackedApplication($this->kkModel, 'pendaftaran_kk', [
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'formulirdesa' => $namaFormulirDesa_KK,
      'kartukeluargasuami' => $namaKKSuami_KK,
      'kartukeluargaistri' => $namaKKIstri_KK,
      'suratnikah' => $namaSuratNikah_KK,
      'suratpindah' => $namaSuratPindah_KK
    ]);
    session()->setFlashdata('pesan', 'Selamat Pendaftaran KK anda berhasil !!');
    return redirect()->to('/pelayanan/pendaftaran_kk');
  }

























  // Si Lancar 1  
  // Menampilkan Form Pendaftaran KIA
  public function pendaftaran_kia()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran KIA || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan/pendaftaran_kia', $data);
  }

  // Validasi Pendaftaran KIA
  public function saveKIA()
  {
    if (!$this->validate([

      //Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_kia.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ]
      ],
      //Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_kia.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ]
      ],
      //Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_kia.nomorpemohon]',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!'
        ]
      ],
      //Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_kia.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Berkas Akta Kelahiran
      'aktakelahiran' => [
        'rules' => 'uploaded[aktakelahiran]|max_size[aktakelahiran,1024]|mime_in[aktakelahiran,application/pdf]|ext_in[aktakelahiran,pdf]',
        'errors' => [
          'uploaded' => 'Akta Kelahiran Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Kartu Keluarga
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,1024]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Pas Foto
      'pasfoto' => [
        'rules' => 'uploaded[pasfoto]|max_size[pasfoto,1024]|mime_in[pasfoto,application/pdf]|ext_in[pasfoto,pdf]',
        'errors' => [
          'uploaded' => 'Pas Foto Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ]

    ])) {
      return redirect()->to(base_url() . '/pelayanan/pendaftaran_kia/')->withInput();
    }

    // Berkas Akta Kelahiran
    $berkasAktaKelahiran_KIA = $this->request->getFile('aktakelahiran');
    $namaAktaKelahiran_KIA = $berkasAktaKelahiran_KIA->getName();
    $berkasAktaKelahiran_KIA->move('pelayanan/kia', $namaAktaKelahiran_KIA);

    // Berkas Kartu Keluarga
    $berkasKartuKeluarga_KIA = $this->request->getFile('kartukeluarga');
    $namaKartuKeluarga_KIA = $berkasKartuKeluarga_KIA->getName();
    $berkasKartuKeluarga_KIA->move('pelayanan/kia', $namaKartuKeluarga_KIA);

    // Berkas Pas Foto
    $berkasPasFoto_KIA = $this->request->getFile('pasfoto');
    $namaPasFoto_KIA = $berkasPasFoto_KIA->getName();
    $berkasPasFoto_KIA->move('pelayanan/kia');


    $this->saveTrackedApplication($this->kiaModel, 'pendaftaran_kia', [
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'aktakelahiran' => $namaAktaKelahiran_KIA,
      'kartukeluarga' => $namaKartuKeluarga_KIA,
      'pasfoto' => $namaPasFoto_KIA
    ]);
    session()->setFlashdata('pesan', 'Selamat Pendaftaran KIA anda Berhasil !!');
    return redirect()->to('/pelayanan/pendaftaran_kia');
  }


























  // Menampilkan Form Pendaftaran Akta Kelahiran
  public function pendaftaran_aktakelahiran()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Akta Kelahiran || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan/pendaftaran_aktakelahiran', $data);
  }

  // Validasi Akta Kelahiran
  public function saveAktakelahiran()
  {
    if (!$this->validate([

      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ]
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ]
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.nomorpemohon]',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!'
        ]
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Berkas F2.01 Akta
      'formulirf201akta' => [
        'rules' => 'uploaded[formulirf201akta]|max_size[formulirf201akta,1024]|mime_in[formulirf201akta,application/pdf]|ext_in[formulirf201akta,pdf]',
        'errors' => [
          'uploaded' => 'Formulir F201 Akta Kelahiran Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Surat Keterangan Lahir
      'suratketeranganlahir' => [
        'rules' => 'uploaded[suratketeranganlahir]|max_size[suratketeranganlahir,1024]|mime_in[suratketeranganlahir,application/pdf]|ext_in[suratketeranganlahir,pdf]',
        'errors' => [
          'uploaded' => 'Surat Keterangan Lahir Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Kartu Keluarga
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,1024]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas KTP Ayah
      'ktpayah' => [
        'rules' => 'uploaded[ktpayah]|max_size[ktpayah,1024]|mime_in[ktpayah,application/pdf]|ext_in[ktpayah,pdf]',
        'errors' => [
          'uploaded' => 'KTP Ayah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas KTP Ibu
      'ktpibu' => [
        'rules' => 'uploaded[ktpibu]|max_size[ktpibu,1024]|mime_in[ktpibu,application/pdf]|ext_in[ktpibu,pdf]',
        'errors' => [
          'uploaded' => 'KTP Ibu Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ]

    ])) {
      return redirect()->to(base_url() . '/pelayanan/pendaftaran_aktakelahiran/')->withInput();
    }

    // Berkas Formulir F201 
    $berkasFormulirF201_Akla = $this->request->getFile('formulirf201akta');
    $namaFormulirF201_Akla = $berkasFormulirF201_Akla->getName();
    $berkasFormulirF201_Akla->move('pelayanan/aktakelahiran', $namaFormulirF201_Akla);

    // Berkas Surat Keterangan Lahir
    $berkasSuratKeteranganLahir_Akla = $this->request->getFile('suratketeranganlahir');
    $namaSuratKeteranganLahir_Akla = $berkasSuratKeteranganLahir_Akla->getName();
    $berkasSuratKeteranganLahir_Akla->move('pelayanan/aktakelahiran', $namaSuratKeteranganLahir_Akla);

    // Berkas Kartu Keluarga
    $berkasKartuKeluarga_Akla = $this->request->getFile('kartukeluarga');
    $namaKartuKeluarga_Akla = $berkasKartuKeluarga_Akla->getName('');
    $berkasKartuKeluarga_Akla->move('pelayanan/aktakelahiran', $namaKartuKeluarga_Akla);

    // Berkas KTP Ayah
    $berkasKTPAyah_Akla = $this->request->getFile('ktpayah');
    $namaKTPAyah_Akla = $berkasKTPAyah_Akla->getName();
    $berkasKTPAyah_Akla->move('pelayanan/aktakelahiran', $namaKTPAyah_Akla);

    // Berkas KTP Ibu
    $berkasKTPIbu_Akla = $this->request->getFile('ktpibu');
    $namaKTPIbu_Akla = $berkasKTPIbu_Akla->getName();
    $berkasKTPIbu_Akla->move('pelayanan/aktakelahiran', $namaKTPIbu_Akla);

    $this->saveTrackedApplication($this->aktakelahiranModel, 'pendaftaran_aktakelahiran', [
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'formulirf201akta' => $namaFormulirF201_Akla,
      'kartukeluarga' => $namaKartuKeluarga_Akla,
      'suratketeranganlahir' => $namaSuratKeteranganLahir_Akla,
      'ktpayah' => $namaKTPAyah_Akla,
      'ktpibu' => $namaKTPIbu_Akla
    ]);
    session()->setFlashdata('pesan', 'Selamat Pendaftaran Akta Kelahiran Anda Berhasil !!');
    return redirect()->to('/pelayanan/pendaftaran_aktakelahiran/');
  }













  // Menampilkan Form Pendaftaran Akta Kematian
  public function pendaftaran_aktakematian()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Akta Kematian || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan/pendaftaran_aktakematian', $data);
  }

  // Validasi Pendaftaran Akta Kematian
  public function saveAktakematian()
  {
    if (!$this->validate([

      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ]
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ]
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.nomorpemohon]',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!'
        ]
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Berkas KK
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,1024]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas KTP Orang Meninggal
      'ktporangmeninggal' => [
        'rules' => 'uploaded[ktporangmeninggal]|max_size[ktporangmeninggal,1024]|mime_in[ktporangmeninggal,application/pdf]|ext_in[ktporangmeninggal,pdf]',
        'errors' => [
          'uploaded' => 'KTP Orang Meninggal Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Surat Kematian
      'suratkematian' => [
        'rules' => 'uploaded[suratkematian]|max_size[suratkematian,1024]|mime_in[suratkematian,application/pdf]|ext_in[suratkematian,pdf]',
        'errors' => [
          'uploaded' => 'Surat Kematian Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ]

    ])) {
      return redirect()->to(base_url() . '/pelayanan/pendaftaran_aktakematian/')->withInput();
    }

    // Berkas KK
    $berkasKK_Akket = $this->request->getFile('kartukeluarga');
    $namaKK_Akket = $berkasKK_Akket->getName();
    $berkasKK_Akket->move('pelayanan/aktakematian', $namaKK_Akket);

    // Berkas KTP Orang meninggal
    $berkasKTP_Akket = $this->request->getFile('ktporangmeninggal');
    $namaKTP_Akket = $berkasKTP_Akket->getName();
    $berkasKTP_Akket->move('pelayanan/aktakematian', $namaKTP_Akket);

    // Berkas Surat Kematian
    $berkasSuratKematian_Akket = $this->request->getFile('suratkematian');
    $namaSuratKematian_Akket = $berkasSuratKematian_Akket->getName();
    $berkasSuratKematian_Akket->move('pelayanan/aktakematian', $namaSuratKematian_Akket);

    $this->saveTrackedApplication($this->aktakematianModel, 'pendaftaran_aktakematian', [
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'kartukeluarga' => $namaKK_Akket,
      'ktporangmeninggal' => $namaKTP_Akket,
      'suratkematian' => $namaSuratKematian_Akket
    ]);
    session()->setFlashdata('pesan', 'Selamat Pendaftaran AktaKematian anda Berhasil !!');
    return redirect()->to('/pelayanan/pendaftaran_aktakematian');
  }














  // Menampilkan Form Pendaftaran Perbaikan Data
  public function pendaftaran_perbaikandata()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Perbaikan Data || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan/pendaftaran_perbaikandata', $data);
  }

  // Validasi Form Perbaikan Data
  public function savePerbaikanData()
  {
    if (!$this->validate([

      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[perbaikan_data.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ]
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[perbaikan_data.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ]
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[perbaikan_data.nomorpemohon]',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!'
        ]
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[perbaikan_data.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Form Penjelasan Perbaikan
      'penjelasanperbaikan' => [
        'rules' => 'required[perbaikan_data.penjelasanperbaikan]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Berkas Perbaikan 1
      'berkasperbaikan1' => [
        'rules' => 'uploaded[berkasperbaikan1]|max_size[berkasperbaikan1,1024]|mime_in[berkasperbaikan1,application/pdf]|ext_in[berkasperbaikan1,pdf]',
        'errors' => [
          'uploaded' => 'Surat Pindah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Perbaikan 2
      'berkasperbaikan2' => [
        'rules' => 'uploaded[berkasperbaikan2]|max_size[berkasperbaikan2,1024]|mime_in[berkasperbaikan2,application/pdf]|ext_in[berkasperbaikan2,pdf]',
        'errors' => [
          'uploaded' => 'Surat Pindah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ],
      // Berkas Perbaikan 3
      'berkasperbaikan3' => [
        'rules' => 'uploaded[berkasperbaikan3]|max_size[berkasperbaikan3,1024]|mime_in[berkasperbaikan3,application/pdf]|ext_in[berkasperbaikan3,pdf]',
        'errors' => [
          'uploaded' => 'Surat Pindah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ]
      ]

    ])) {
      return redirect()->to(base_url() . '/pelayanan/pendaftaran_perbaikandata/')->withInput();
    }

    // Berkas Perbaikan 1
    $berkasPerbaikan1 = $this->request->getFile('berkasperbaikan1');
    $namaBerkasPerbaikan1 = $berkasPerbaikan1->getName();
    $berkasPerbaikan1->move('pelayanan/perbaikan_data', $namaBerkasPerbaikan1);

    // Berkas Perbaikan 2
    $berkasPerbaikan2 = $this->request->getFile('berkasperbaikan2');
    $namaBerkasPerbaikan2 = $berkasPerbaikan2->getname();
    $berkasPerbaikan2->move('pelayanan/perbaikan_data', $namaBerkasPerbaikan2);

    // Berkas Perbaikan 3
    $berkasPerbaikan3 = $this->request->getFile('berkasperbaikan3');
    $namaBerkasPerbaikan3 = $berkasPerbaikan3->getname();
    $berkasPerbaikan3->move('pelayanan/perbaikan_data', $namaBerkasPerbaikan3);

    $this->saveTrackedApplication($this->perbaikandataModel, 'perbaikan_data', [
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'penjelasanperbaikan' => $this->request->getVar('penjelasanperbaikan'),
      'berkasperbaikan1' => $namaBerkasPerbaikan1,
      'berkasperbaikan2' => $namaBerkasPerbaikan2,
      'berkasperbaikan3' => $namaBerkasPerbaikan3
    ]);
    session()->setFlashdata('pesan', 'Selamat Pendaftaran Perbaikan Data anda Berhasil !!');
    return redirect()->to('/pelayanan/pendaftaran_perbaikandata/');
  }













  // Menampilkan Form Pengaduan Update
  public function pendaftaran_pengaduanupdate()
  {
    helper(['form']);
    $data = [
      'title' => 'Pengaduan Update || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan/pendaftaran_pengaduanupdate', $data);
  }

  // Validasi Form Pengaduan Update
  public function savePengaduanUpdate()
  {
    if (!$this->validate([

      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pengaduan_update.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ]
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pengaduan_update.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ]
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pengaduan_update.nomorpemohon]',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!'
        ]
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pengaduan_update.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ]
      ],
      // Form Pengaduan Update
      'pengaduanupdate' => [
        'rules' => 'required[pengaduan_update.pengaduanupdate]',
        'errors' => [
          'required' => 'Pengaduan Harus Diisi !!'
        ]
      ],
      // Berkas Kartu Tanda Penduduk
      'kartutandapenduduk' => [
        'rules' => 'uploaded[kartutandapenduduk]|mime_in[kartutandapenduduk,image/jpg,image/jpeg,image/png,application/pdf]',
        'errors' => [
          'uploaded' => 'Surat Kematian Harus di isi !!',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      // Berkas KK
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|mime_in[kartukeluarga,image/jpg,image/jpeg,image/png,application/pdf]',
        'errors' => [
          'uploaded' => 'Surat Kematian Harus di isi !!',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]

    ])) {
      return redirect()->to(base_url() . '/pelayanan/pendaftaran_pengaduanupdate/')->withInput();
    }

    // Berkas KTP
    $berkasKTP_PengUp = $this->request->getFile('kartutandapenduduk');
    $namaKTP_PengUp = $berkasKTP_PengUp->getName();
    $berkasKTP_PengUp->move('pelayanan/pengaduan_update', $namaKTP_PengUp);

    // Berkas KK
    $berkasKK_Pengup = $this->request->getFile('kartukeluarga');
    $namaKK_PengUp = $berkasKK_Pengup->getName();
    $berkasKK_Pengup->move('pelayanan/pengaduan_update', $namaKK_PengUp);

    $this->saveTrackedApplication($this->pengaduanupdateModel, 'pengaduan_update', [
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'pengaduanupdate' => $this->request->getVar('pengaduanupdate'),
      'kartutandapenduduk' => $namaKTP_PengUp,
      'kartukeluarga' => $namaKK_PengUp

    ]);
    session()->setFlashdata('pesan', 'Selamat Pendaftaran Pengaduan Update anda Berhasil !!');
    return redirect()->to('/pelayanan/pendaftaran_pengaduanupdate/');
  }



























  public function pelayanan_pemanfaatan_data_inovasi_pengaduan()
  {
    helper(['form']);
    $data = [
      'title' => 'Pelayanan Pemanfaatan Data Inovasi dan Pengaduan Antar Lembaga || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan/pelayanan_pemanfaatan_pengaduan', $data);
  }
}
