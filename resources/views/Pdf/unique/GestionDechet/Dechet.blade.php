<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .date{
                margin:-20px 0 0 75%  ;
            }
            .img-container{
                border-radius: 20px;
                border:2px rgb(186, 41, 205) dashed;
                width: 180px;
                height: 180px;
            }
            .page{
                padding:20px;
            }
            table{
                border:1px solid;
                width:480px;
            }
             td , th{
                border:1px solid;
                font-size:14px;
                padding:10px;
                text-align: left;
            }
            .table{
                margin:-190px 0 0 210px;
            }
        </style>
    </head>
    <body class="page"  >
        <img class="img-logo" src="{{ public_path('images/logo.png') }}" alt="logo" width="50px" height="50px"/>
        <p class='date'>{{ date('d-m-Y H:i:s') }}</p>
        <hr/>
        <br/>
        <h2 style="text-align: center;">Détails dechet Reschool ecology: {{$type_dechet}}</h2>
        <br/>
        <div>
            <?php $url = 'storage/images/dechet/'.$photo;
                $path= public_path($url);
                if(! file_exists($path) || $photo === null){
                    $path= public_path('storage/images/dechet/default.jpeg');
                }
            ?>
            <img class="img-container" src="{{ $path }}" alt="dechet"/>
            <table class="table">
                <tr>
                    <th>Identifiant:</th>
                    <td>{{$id}}</td>
                </tr>
                <tr>
                    <th>Type dechet:</th>
                    <td>{{$type_dechet}}</td>
                </tr>
                <tr>
                    <th>Prix unitaire:</th>
                    <td>{{$prix_unitaire}} DT</td>
                </tr>
                <tr>
                    <th>Pourcentage remise:</th>
                    <td>{{$pourcentage_remise}} %</td>
                </tr>
                <tr>
                    <th>Date de création:</th>
                    <td>{{$created_at}}</td>
                </tr>
                <tr>
                    <th>Date de dernier modification: </th>
                    <td>{{$updated_at}}</td>
                </tr>
            </table>
        </div>

    </body>
</html>
