<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th style="max-width:80px"> Code d'erreur</th>
            <th> Message</th>
            <th style="max-width: 80px">Platforme</th>
            <th style="max-width: 70px">Serveur</th>
            <th style="max-width: 85px">Date creation</th>
        </tr>
    </thead>
    @foreach(\App\Problems::all() as $Problem)
    <tr>
        <td style="max-width: 50px">{{ str_limit($Problem->Code_prb, 20)}}</td>
        <td style="max-width: 300px"><a href="{{url('Probleme/Consulter/'.$Problem->id)}}"> {{ str_limit($Problem->MessagePrb, 70) }} </a></td>
        <td style="max-width: 50px">
            <?php $Platformes=App\Platformes::where('id',$Problem->Platformes_id)->get()?>
            @foreach($Platformes as $platforme)
            @if( ! empty($platforme['id']))
            {{$platforme->NomPlatforme}}
            @else
            Erreur platforme manquante
            @endif
        @endforeach </td>
        <td style="max-width: 60px">
            <?php $Serveurs=App\Serveurs::where('id',$Problem->Serveurs_id)->get()?>
            @foreach($Serveurs as $serveur)
            @if( ! empty($serveur['id']))
            Serv_{{$serveur->id}}
            @else
            Erreur serveur manquante
            @endif
        </td>
        @endforeach
        <td style="max-width: 20px">
            {{$Problem->created_at}}
        </td>
        @endforeach
    </tr>
</table>