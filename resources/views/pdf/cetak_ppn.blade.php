<html>
<head>
<style>
    @page { margin: 30px 25px 30px 25px; }
    .header {  left: 0px; right: 0px;  height: 100px;border:solid 1px #5d6975 }
    .footer {   left: 0px; right: 0px;  height: 140px;border:solid 1px #5d6975 }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    
    h2{
        margin:0px;
    }
    h4{
        margin:0px;
    }
    table{
        border-collapse:collapse;
        
    }
    td{
        /* border:solid 1px #fff; */
    }
    .ttd{
        border:solid 1px #5d6975;
    }
    .batas{
        border:solid 1px #5d6975;
        height:8px;
        width:100%;
        display:block;
        background:#5d6975;
        padding:1%;
        
    }
    .isinya{
        border:solid 1px #5d6975;
        width:100%;
        display:block;
        height:400px;
        padding:1%;
        
    }
  </style>
</head>
<body>
    
        <div class="header">
                <table width="100%" border="0">
                    <tr>
                        <td width="20%"><img src="{{public_path('img/logoks.png')}}" style="width:100%;height:60px"></td>
                        <td width="70%" style="text-align:center;text-transform:uppercase">
                            <h2>KUPON</h2>
                            <h4>PENGAMBILAN BUKTI POTONG PPN</h4>
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
 
    
        <div class="batas">
        </div>
        <div class="isinya">
                <table width="100%" border="0">
                    <tr>
                        <td width="20%">Nama Pemungut</td>
                        <td width="80%">: PT KRAKATAU STEEL (Persero) Tbk</td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td>: 01.000.054.5-417.001</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: JALAN INDUSTRI NO. 5 RAMANUJU PURWAKARTA KOTA CILEGON BANTEN 42431</td>
                    </tr>
                </table><br>
                <table width="100%" border="1">
                    <tr>
                        <th width="5%">NO</th>
                        <th>NO Bukti Potong</th>
                        <th>Tgl Bukti Potong</th>
                        <th>No Invoice</th>
                        <th>No Faktur Pajak</th>
                        <th>Nilai DPP (Rp)</th>
                        <th>Nilai PPH (Rp)</th>
                    </tr>
                    @foreach(cetak_ppn() as $no=>$o)
                        <tr>
                            <td style="padding-left:4px;font-size:13px;" color="blue">{{$no+1}}</td>
                            <td style="padding-left:4px;font-size:13px;"></td>
                            <td style="padding-left:4px;font-size:13px;">ss</td>
                            <td style="padding-left:4px;font-size:13px;">ss</td>
                            <td style="padding-left:4px;font-size:13px;">ss</td>
                            <td style="padding-left:4px;font-size:13px;">ss</td>
                            <td style="padding-left:4px;font-size:13px;">ss</td>
                        </tr>
                    @endforeach
                    
                    
                </table>
        </div>
    
  
        <div class="footer">
                <table width="100%" border="0">
                    <tr>
                        <td colspan="3">
                        
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="text-align:center">Penerima Bukti Potong,<br><br><font style="color:blue;font-size:14px">Cap Stempel Perusahaan</font><br><br>(...............................................)</td>
                        <td width="20%"></td>
                        <td width="40%" style="text-align:center">Petugas Loket,<br><br><font style="color:blue;font-size:14px">Cap Tanggal Stempel Loket</font><br><br>(...............................................)</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding-left:4px;font-size:13px;font-size:13px;font-style:italic">
                        Informasi : Bukti Pemotongan/Pemungutan PPh dapat diambil diloket Divisi Tax & Verification 16 Hari Setelah berakhirnya masa pajak
                        Pengambilan Bukti potong tanpa kupon tidak kami layani

                        </td>
                    </tr>
                </table>
        </div>
 
</body>
</html>