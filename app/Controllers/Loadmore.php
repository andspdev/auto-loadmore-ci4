<?php

namespace App\Controllers;

use App\Models\LoadMoreModel;

class Loadmore extends BaseController
{
    public function index()
    {
        return view('load_more', ['startData' => 0, 'limitData' => 20]);
    }

    public function data()
    {
        $data           = [];
        $startData      = $this->request->getPost('startData');
        $limitData      = $this->request->getPost('limitData');
        $data['err']    = 'Tidak ada data yang ditampilkan';

        if (isset($startData) && isset($limitData))
        {
            $load_data          = new LoadMoreModel();
            $data['countries']  = $load_data->ambilData($limitData, $startData);
            $data['err']        = count($data['countries']) == 0 ? $data['err'] : null;
        }

        return $this->response->setJSON($data);
    }

