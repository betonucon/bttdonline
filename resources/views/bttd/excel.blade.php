<style>
    th{
        background:blue;
        color:#fff;
    }
</style>
<table border="2px">
    <thead>
        <tr>
            <th colspan="6" align="center">POLING {{date('Y')}}</th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th bgcolor="aqua">No</th>
            <th bgcolor="aqua" width="10px">LIFNER</th>
            <th bgcolor="aqua" width="50px">VENDOR</th>
            <th bgcolor="aqua" width="10px">S.Puas</th>
            <th bgcolor="aqua" width="10px">Puas</th>
            <th bgcolor="aqua" width="10px">T.puas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $no=>$o)
        <tr>
            <td>{{$no+1}}</td>
            <td>{{$o->LIFNR}}</td>
            <td>{{$o->name}}</td>
            <td>@if($o->sts==1) 1 @else 0 @endif</td>
            <td>@if($o->sts==2) 1 @else 0 @endif</td>
            <td>@if($o->sts==3) 1 @else 0 @endif</td>
            
        </tr>
        @endforeach
    </tbody>
</table>