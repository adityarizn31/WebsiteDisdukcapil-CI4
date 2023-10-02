<?php

namespace App\Models;

use CodeIgniter\Model;

class Pendaftaran_kk_Model extends Model
{
  protected $table = 'pendaftaran_kk';
  protected $useTimeStamps = true; // Mengaktifkan Created at dan Updated at

  public function getDataKK($nama = false)
  {
    // Jika nama pemohon == false maka yang akan ditampilkan semua
    if ($nama == false) {
      return $this->findAll();
    }

    // Namun jika nama pemohon == true makan akan ditampilkan nama tersebut saja
    return $this->where(['namapemohon' => $nama])->first();
  }
}
