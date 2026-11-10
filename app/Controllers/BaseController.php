<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();
    }

    /**
     * Save a registration and create a private code for public status lookup.
     *
     * @param \CodeIgniter\Model $model
     * @param string $serviceKey
     * @param array $data
     * @return string
     */
    protected function saveTrackedApplication($model, string $serviceKey, array $data): string
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            if (!$model->save($data)) {
                throw new \RuntimeException('Permohonan tidak berhasil disimpan.');
            }

            $applicationId = (int) $model->getInsertID();
            if ($applicationId < 1) {
                throw new \RuntimeException('ID permohonan tidak ditemukan.');
            }

            $trackingCode = strtoupper(bin2hex(random_bytes(16)));
            $db->table('application_tracking')->insert([
                'tracking_code' => $trackingCode,
                'service_key' => $serviceKey,
                'application_id' => $applicationId,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Kode pelacakan permohonan tidak berhasil dibuat.');
            }

            $db->transCommit();
            session()->setFlashdata('tracking_code', $trackingCode);

            return $trackingCode;
        } catch (\Throwable $exception) {
            $db->transRollback();
            log_message('error', 'Gagal menyimpan permohonan beserta kode pelacakan: {message}', [
                'message' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }
}
