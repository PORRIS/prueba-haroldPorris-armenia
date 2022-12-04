<?php


namespace App\Repositories\Implementations;

use App\Models\Activity;
use App\Repositories\Interfaces\ActivityInterface;
use App\Utilities\Resources;
use Exception;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ActivityRepository implements ActivityInterface
{
    /**
     * @param Request $request
     * @return array
     * crea una actividad
     */
    public function save(Request $request):array{
        try {
            $message = Lang::get('validation.activity.not_created');
            $codigo = 422;
            $activity = new Activity();
            $activity->consecutive = 0;
            $activity->activity_name = $request->activity_name;
            $activity->cultural_right_id = $request->cultural_rights;
            $activity->nac_id = $request->nac_id;
            $activity->activity_date = $request->activity_date ;
            $activity->start_time = $request->start_time;
            $activity->final_hour = $request->final_hour;
            $activity->expertise_id = $request->expertise_id;
            $save = $activity->save();
            if($save){
                $this->updateConsecutive($activity->id);
                $message = Lang::get('validation.activity.created');
                $codigo = 200;
            }
            return [$codigo,$message,$save,['activity_id'=>$activity->id]];
        } catch (Exception $exception) {
            report($exception);
            return [500, Lang::get('validation.activity.error_created'),false,''];
        }
    }

    /*
     * ACTUALIZAR EL CAMPO consecutive
     */
    private function updateConsecutive($id_activity){
        $activity = $this->getActivity($id_activity);
        $activity->consecutive = 'FP'.$id_activity;
        $activity->save();
    }

    /**
     * @param Request $request
     * @param $id_activity
     * @return array
     * actualiza una actividad
     */
    public function update(Request $request, $id_activity):array
    {
        try {
            $codigo = 422;
            $update = false;
            $activity = Activity::query()->find($id_activity);
            $activity->activity_name = $request->activity_name;
            $activity->cultural_right_id = $request->cultural_rights;
            $activity->nac_id = $request->nac_id;
            $activity->activity_date = $request->activity_date ;
            $activity->start_time = $request->start_time;
            $activity->final_hour = $request->final_hour;
            $activity->expertise_id = $request->expertise_id;
            if($activity->isDirty()){
                $update = $activity->save();
                $message = $update ? Lang::get('validation.activity.updated'):Lang::get('validation.auditoria.not_updated');
                $codigo = $update ? 200 : 422;
            }else{
                $message = Lang::get('validation.activity.not_updated_change');
            }
            return [$codigo,$message,$update,''];

        } catch (Exception $exception) {
            report($exception);
            return [500,Lang::get('validation.activity.error_updated'),false];
        }
    }

    /**
     * @param $id_activity
     * @return array
     * retorna una actividad segun su id
     */
    public function getById($id_activity)
    {
        try {
            $estado = true;
            $code = 200;
            $mensaje = Lang::get('validation.activity.is_find');
            $data = $this->getActivity($id_activity);
            if(!$data){
                $estado = false;
                $code = 422;
                $mensaje = Lang::get('validation.activity.is_inactive');
            }
            return [$code,$mensaje,$estado,$data];
        } catch (Exception $exception) {
            report($exception);
            return ['',500,Lang::get('validation.activity.error_find'),false];
        }
    }

    private function getActivity($id_activity){
        return Activity::query()->with(['cultural','nac','expertise'])->find($id_activity);
    }

    /**
     * @param $id_activity
     * @return array
     * elimina una actividad
     */
    public function delete($id_activity)
    {
        try {
            $delete = Activity::query()->find($id_activity);
            $deleted = $delete->delete();
            $mensaje = Lang::get('validation.activity.deleted');
            $codigo = 200;
            if(!$deleted){
                $mensaje = Lang::get('validation.activity.not_deleted');
                $codigo = 422;
            }
            return [$codigo,$mensaje,$deleted];
        } catch (Exception $exception) {
            report($exception);
            return [500,Lang::get('validation.activity.error_deleted'),false];
        }
    }

    /**
     * @param $id_activity
     * @return array
     * restaura una actividad eliminada
     */
    public function restore($id_activity)
    {
        try {
            $restore = Activity::query()->onlyTrashed()->find($id_activity);
            $mensaje = Lang::get('validation.activity.restore');
            $codigo = 200;
            $estado = true;
            if($restore){
                $restore->restore();
            }else{
                $mensaje = Lang::get('validation.activity.not_restore');
            }
            return [$codigo,$mensaje,$estado];
        } catch (Exception $exception) {
            report($exception);
            return [500,Lang::get('validation.activity.error_restore'),false];
        }
    }

    public function index(){
        try {
            $activities = Activity::query()
                ->with(['cultural','nac','expertise'])
                ->orderBy('id')
                ->cursorPaginate(Resources::PAGINATE_ACTIVITIES);
            $activities->withPath(Resources::PATH_ACTIVITIES);
            $activities = $activities->toArray();
            $activities['status'] = true;
            $activities['code'] = 200;
            $activities['message'] = ($activities['data']) ?
                Lang::get('validation.activity.activities_find') :
                Lang::get('validation.activity.activities_not_find');
            return $activities;
        } catch (Exception $exception) {
            report($exception);
            return [500,Lang::get('validation.activity.activities_error_restore'),false];
        }
    }

}
