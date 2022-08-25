<?php

namespace App\Http\Controllers\Auth\ResponsablePersonnel;
use App\Models\Responsable_personnel;
use App\Http\Controllers\Globale\BaseController as BaseController;
use Illuminate\Support\Facades\File;
class ResponsablePersonnelController extends BaseController{
    public function allResponsablePersonnels(){
        $responsable_personnel = Responsable_personnel::find(1);
        return response([
            'responsable_personnel' => $responsable_personnel
        ]);
    }
    public function sendImage(){
        $responsable_personnel=auth()->guard('responsable_personnel')->user();

        if($responsable_personnel !=null){
            if($responsable_personnel->photo!=null){
                $destination = 'storage/images/responsable_personnel/'.$responsable_personnel->photo;
                return response([
                    "url"=>$destination
                ],200);
            }
            return response([
                "photo"=>null
            ],200);
        }
        return response([
            'msg' =>'undefiened responsable_personnel'
        ],401);
    }
    public function destroyImage(){
        $responsable_personnel=auth()->guard('responsable_personnel')->user();
        if($responsable_personnel !=null){
            $destination = 'storage/images/responsable_personnel/'.$responsable_personnel->photo;
                if(File::exists($destination)){
                    File::delete($destination);
                    $responsable_personnel->photo = null;
                    $responsable_personnel->save();
                }
                return response([
                    'status' => 200,
                    'client_dechet' =>$responsable_personnel,
                ]);
        }
    }
}
