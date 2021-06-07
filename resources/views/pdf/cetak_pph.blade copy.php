<html>
    <head>
        <title></title>
        <style>
            @page { margin: 100px 25px; }
            header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: #fff; height: 100px;display:block;margin-bottom:200px; }
            footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: #fff; height: 50px; }
            
            .bodynya{
                display:block;
                width:100%;
                background:blue;
                height:500px;
            }
            .headernya{
                width:100%;
                height:100px;
                border:solid 1px #000;
            }
            .isinya{
                width:100%;
                height:300px;
                border:solid 1px #000;
                display:block;
                margin-top:44px;
                
            }
            table{
                border-collapse:collapse;
            }
            td{
                border:solid 1px #000;
            }
            h2{
                margin:0px;
            }
            h4{
                margin:0px;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="headernya">
                <table width="100%" border="">
                    <tr>
                        <td width="20%"><img src="{{url('img/logo.png')}}" style="width:100%;height:60px"></td>
                        <td width="70%" style="text-align:center;text-transform:uppercase">
                            <h2>KUPON</h2>
                            <h4>PENGAMBILAN BUKTI POTONG PPH</h4>
                            <h4>{{Auth::user()['name']}} {{Auth::user()['username']}}</h4>
                        </td>
                        <td width="10%" style="padding:6px 6px">
                            <?php
                                $bar=Auth::user()['name'].'-'.Auth::user()['username'];
                            ?>
                            {!!barcoderider($bar,3,3)!!}
                        </td>
                    </tr>
                </table>
                
            </div>
        </header>
        <main>
        @for($x=1;$x<=$jum;$x++)
           
                
                <div class="isinya">
                    <table width="100%" border="1">
                        @foreach(cetak_pph($x) as $o)
                            <tr>
                                <td width="10%" color="blue">{{$o['urut']}}-{{$o['pph']['Docno']}}</td>
                                <td width="80%">ss</td>
                                <td width="10%">xxx</td>
                            </tr>
                        @endforeach
                        
                        
                    </table>
                </div>
           
        @endfor
        </main>
    </body>
</html>