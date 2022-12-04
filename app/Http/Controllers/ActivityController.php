<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveActivityRequest;
use App\Http\Requests\SearchIdActivityRequest;
use App\Http\Requests\SearchIdActivityRestoreRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\Implementations\ActivityRepository;
use App\Repositories\Interfaces\ActivityInterface;
use Illuminate\Http\Request;

class ActivityController extends ApiController
{
    private $activity;
    public function __construct(  ActivityInterface $activity  )
    {
        $this->activity = $activity;
    }

    public function save(SaveActivityRequest $request){
        $data = $this->activity->save($request);
        return $this->showData([$data[3]], $data[0],$data[1],$data[2]);
    }

    public function update(UpdateActivityRequest $request,$id_activity){
        $data = $this->activity->update($request,$id_activity);
        return $this->showData([$data[3]], $data[0],$data[1],$data[2]);
    }

    public function getById(SearchIdActivityRequest $request,$id_activity){
        $data = $this->activity->getById($id_activity);
        return $this->showData($data[3], $data[0],$data[1],$data[2]);
    }

    public function delete(SearchIdActivityRequest $request,$id_activity){
        $data = $this->activity->delete($id_activity);
        return $this->showData(null, $data[0],$data[1],$data[2]);
    }

    public function restore(SearchIdActivityRestoreRequest $request,$id_activity){
        $data = $this->activity->restore($id_activity);
        return $this->showData(null, $data[0],$data[1],$data[2]);
    }

    public function index(){
        $data = $this->activity->index();
        return  $this->showDataEspecific($data);
    }

}
