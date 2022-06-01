<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BrandRepository {

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function selectAttributesRelatedRecords($attribut) {
        $this->model = $this->model->with($attribut); // sempre atualiza o proprio atributo
        // query está sendo montada
    }

    public function filt($filts) {
        $filts = explode(';', $filts); // divide o grupo de comparações
        foreach ($filts as $key => $condition) {

            $c = explode(':', $condition);
            $this->model = $this->model->where($c[0], $c[1], $c[2]);
            // a query está sendo montada
        }
    }

    public function selectAttribut($attribut) {
        $this->model = $this->model->selectRaw($attribut);
        // query está sendo montada
    }

    public function getResult() {
        return $this->model->get();
    }

}







?>
