<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface ActivityInterface
{
    /**
     * @param Request $request
     * @return array
     * crea una actividad
     */
    public function save(Request $request): array;

    /**
     * @param Request $request
     * @param $id_activity
     * @return array
     * actualiza una actividad
     */
    public function update(Request $request, $id_activity): array;

    /**
     * @param $id_activity
     * @return array
     * retorna una actividad segun su id
     */
    public function getById($id_activity);

    /**
     * @param $id_activity
     * @return array
     * elimina una actividad
     */
    public function delete($id_activity);

    /**
     * @param $id_activity
     * @return array
     * restaura una actividad eliminada
     */
    public function restore($id_activity);

    public function index();
}
