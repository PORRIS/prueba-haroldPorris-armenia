<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchIdCulturalRightsRequest;
use App\Http\Requests\SearchIdExpertiseRequest;
use App\Http\Requests\SearchIdNacRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\Implementations\ReferencesRepository;
use App\Utilities\Resources;
use Illuminate\Support\Facades\Cache;

class ReferencesController extends ApiController
{
    private $references;
    public function __construct(  ReferencesRepository $references  )
    {
        $this->references = $references;
    }

    public function getExpertises(SearchRequest $request){

        if(!$request->query('search')) {
            $data = Cache::remember('Expertises', Resources::CACHE_DEFAULT, function () {
                return $this->references->getExpertises();
            });
        }else{
            $data = $this->references->getExpertises($request->query('search'));
        }
        unset($this->references);
        return  $this->showDataEspecific($data);
    }

    public function getExpertiseByid(SearchIdExpertiseRequest $request,$id){
        $data = $this->references->getExpertisesByid($id);
        unset($this->referencias);
        return  $this->showData( [$data[0]],$data[1],$data[2],$data[3]);
    }

    public function getCulturalRights(SearchRequest $request){

        if(!$request->query('search')) {
            $data = Cache::remember('CulturalRights', Resources::CACHE_DEFAULT, function () {
                return $this->references->getCulturalRights();
            });
        }else{
            $data = $this->references->getCulturalRights($request->query('search'));
        }
        unset($this->references);
        return  $this->showDataEspecific($data);
    }

    public function getCulturalRightByid(SearchIdCulturalRightsRequest $request,$id){
        $data = $this->references->getCulturalRightByid($id);
        unset($this->referencias);
        return  $this->showData( [$data[0]],$data[1],$data[2],$data[3]);
    }
    public function getNacs(SearchRequest $request){

        if(!$request->query('search')) {
            $data = Cache::remember('Nacs', Resources::CACHE_DEFAULT, function () {
                return $this->references->getNacs();
            });
        }else{
            $data = $this->references->getNacs($request->query('search'));
        }
        unset($this->references);
        return  $this->showDataEspecific($data);
    }

    public function getNacByid(SearchIdNacRequest $request,$id){
        $data = $this->references->getNacByid($id);
        unset($this->referencias);
        return  $this->showData( [$data[0]],$data[1],$data[2],$data[3]);
    }
}
