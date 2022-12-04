<?php

namespace App\Repositories\Interfaces;

interface ReferencesInterfaces
{
    /**
     * @param $search
     * @return array
     */
    public function getExpertises($search = null);

    /**
     * @param $id_expertise
     * @return array
     */
    public function getExpertisesByid($id_expertise);

    /**
     * @param $search
     * @return array
     */
    public function getCulturalRights($search = null);

    /**
     * @param $id_cultura
     * @return array
     */
    public function getCulturalRightByid($id_cultura);

    /**
     * @param $search
     * @return array
     */
    public function getNacs($search = null);

    /**
     * @param $id_nac
     * @return array
     */
    public function getNacByid($id_nac);
}
