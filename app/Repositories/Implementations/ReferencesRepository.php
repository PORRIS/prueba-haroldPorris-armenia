<?php


namespace App\Repositories\Implementations;


use App\Models\ReferenceCulturalRights;
use App\Models\ReferenceExpertises;
use App\Models\ReferenceNacs;
use App\Utilities\Resources;
use Exception;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class ReferencesRepository
{
    /**
     * @param $search
     * @return array
     */
    public function getExpertises( $search = null )
    {
        try {
            $expertises = ReferenceExpertises::query()
                ->search($search)
                ->orderBy('id')
                ->cursorPaginate(Resources::PAGINATE_EXPERTISES);
            $expertises->withPath(Resources::PATH_EXPERTISES);
            $expertises = $expertises->toArray();
            $expertises['status'] = true;
            $expertises['code'] = 200;
            $expertises['message'] = ($expertises['data']) ?
                Lang::get('validation.references.expertises_find') :
                Lang::get('validation.references.expertises_not_find');
            return $expertises;
        } catch (Exception $exception) {
            Log::error($exception);
            return ['status' => false,'message' => Lang::get('validation.references.expertises_error'),'code' => 500,'data'=>null];
        }
    }

    /**
     * @param $id_expertise
     * @return array
     */
    public function getExpertisesByid($id_expertise)
    {
        try {
            $estado = true;
            $code = 200;
            $mensaje = Lang::get('validation.references.expertise_find');
            $data = ReferenceExpertises::query()
                ->whereId($id_expertise)->first();
            return  [$data,$code,$mensaje,$estado];

        } catch (Exception $exception) {
            report($exception);
            return ['',500,Lang::get('validation.references.expertises_error'),false];
        }
    }

    /**
     * @param $search
     * @return array
     */
    public function getCulturalRights( $search = null )
    {
        try {
            $cultural = ReferenceCulturalRights::query()
                ->search($search)
                ->orderBy('id')
                ->cursorPaginate(Resources::PAGINATE_CULTURALRIGHTS);
            $cultural->withPath(Resources::PATH_CULTURALRIGHTS);
            $cultural = $cultural->toArray();
            $cultural['status'] = true;
            $cultural['code'] = 200;
            $cultural['message'] = ($cultural['data']) ?
                Lang::get('validation.references.cultural_find') :
                Lang::get('validation.references.cultural_not_find');
            return $cultural;
        } catch (Exception $exception) {
            Log::error($exception);
            return ['status' => false,'message' => Lang::get('validation.references.cultural_error'),'code' => 500,'data'=>null];
        }
    }

    /**
     * @param $id_cultura
     * @return array
     */
    public function getCulturalRightByid($id_cultura)
    {
        try {
            $estado = true;
            $code = 200;
            $mensaje = Lang::get('validation.references.cultural_find');
            $data = ReferenceCulturalRights::query()
                ->whereId($id_cultura)->first();
            return  [$data,$code,$mensaje,$estado];

        } catch (Exception $exception) {
            report($exception);
            return ['',500,Lang::get('validation.references.cultural_error'),false];
        }
    }

    /**
     * @param $search
     * @return array
     */
    public function getNacs( $search = null )
    {
        try {
            $nac = ReferenceNacs::query()
                ->search($search)
                ->orderBy('id')
                ->cursorPaginate(Resources::PAGINATE_NACS);
            $nac->withPath(Resources::PATH_NACS);
            $nac = $nac->toArray();
            $nac['status'] = true;
            $nac['code'] = 200;
            $nac['message'] = ($nac['data']) ?
                Lang::get('validation.references.nac_find') :
                Lang::get('validation.references.nac_not_find');
            return $nac;
        } catch (Exception $exception) {
            Log::error($exception);
            return ['status' => false,'message' => Lang::get('validation.references.nac_error'),'code' => 500,'data'=>null];
        }
    }

    /**
     * @param $id_nac
     * @return array
     */
    public function getNacByid($id_nac)
    {
        try {
            $estado = true;
            $code = 200;
            $mensaje = Lang::get('validation.references.nac_find');
            $data = ReferenceNacs::query()
                ->whereId($id_nac)->first();
            return  [$data,$code,$mensaje,$estado];

        } catch (Exception $exception) {
            report($exception);
            return ['',500,Lang::get('validation.references.nac_error'),false];
        }
    }

}
