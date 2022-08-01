<?php

namespace App\Http\Resources\GestionPoubelleEtablissements;

use App\Models\Bloc_etablissement;
use App\Models\Bloc_poubelle;
use App\Models\Etablissement;
use App\Models\Etage_etablissement;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Poubelle extends JsonResource{
    public function toArray($request) {
        $bloc_poubelle= Bloc_poubelle::where('id',$this->bloc_poubelle_id)->first();
        $etage= Etage_etablissement::where('id',$bloc_poubelle->etage_etablissement_id)->first();
        $etage_nom= $etage->nom_etage_etablissement;
        $bloc_etabl= Bloc_etablissement::where('id',$etage->bloc_etablissement_id)->first();
        $bloc_etabl_nom= $bloc_etabl->nom_bloc_etablissement;
        $etablissement= Etablissement::where('id',$bloc_etabl->etablissement_id)->first();

        $posEtab =strpos($this->nom, '-')+1;
        $length=Str::length($this->nom);
        $str=substr( $this->nom, $posEtab,$length) ;

        $Etab=Etablissement::where('id',$etablissement->id)->with('bloc_poubelles')->with('poubelles')->first();
        $listeBloc=$Etab->bloc_poubelles->pluck('id');
        $listepoubelle=$Etab->poubelles->pluck('id');
        $lengthBloc=count($listeBloc);
        $lengthPoubelles=count($listepoubelle);

        $id_resp_Bloc=$this->bloc_poubelle_id;
        $id_resp_Poubelles=$this->id;

        while ($id_resp_Bloc > $lengthBloc){ $id_resp_Bloc-=$lengthBloc;};
        while ($id_resp_Poubelles > $lengthPoubelles){ $id_resp_Poubelles-=$lengthPoubelles;} ;
        $posPb =strpos($str,'-BP');
        $nom_poubelle_responsable=substr($str,0,$posPb).'-BP'.$id_resp_Bloc.'-N'.$id_resp_Poubelles ;

        return [
            'id' => $this->id,
            'bloc_poubelle_id' => $this->bloc_poubelle_id,

            'nombre_bloc'=>$lengthBloc,
            'nombre_poubelle'=>$lengthPoubelles,

            'poubelle_id_resp' => $id_resp_Poubelles,
            'bloc_poubelle_id_resp' => $id_resp_Bloc,
            'nom' => $this->nom,
            'nom_poubelle_responsable'=>$nom_poubelle_responsable,
            'etablissement'=>$etablissement->nom_etablissement ,
            'etablissement_id'=>$etablissement->id ,
            'bloc_etablissement'=> $bloc_etabl_nom,
            'bloc_etablissement_id'=> $bloc_etabl->id,
            'etage'=> $etage_nom,
            'etage_id'=> $etage->id,
            'qrcode' => $this->qrcode,
            'type' => $this->type,
            'Etat' => $this->Etat,
            'quantite' =>round((($this->Etat * config('global.capacite_poubelle'))/100)* 1000)/1000,
            'created_at' => $this->created_at->translatedFormat('H:i:s j F Y'),
            'updated_at' => $this->updated_at->translatedFormat('H:i:s j F Y'),
            'deleted_at' => $this->deleted_at,
        ];
    }
}