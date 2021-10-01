<html>
    <head>
        <title></title>
        <style>
            
            html{
                margin: 1% 2% 1% 2%;
                font-family: Tahoma;
            }
            .headernya{
                width:100%;
                height:80px;
                border:solid 1px #fff;
            }
            table{
                border-collapse:collapse;
            }
            .isinya{
                width:100%;
                height:900px;
                border:solid 1px #fff;
            }
            .isistruk{
                width:100%;
                margin-top:90px;
                min-height:900px;
                border:solid 1px #fff;
            }
            td{
                padding:1px;
                vertical-align:top;
            }
            .tth{
                font-size:13px;
                text-transform: uppercase;
                background:aqua;
            }
            .tthh{
                font-size:11px;
                text-transform: uppercase;
                background:aqua;
            }
            .ttd{
                font-size:13px;
                padding-left:3px;
            }
            .ttdp{
                font-size:13px;
                padding-left:3px;
                border:solid 1px #fff;
            }
            .footer {
                width: 100%;
                text-align: center;
                position: fixed;
                bottom:0px;
                height:170px;
                border:solid 1px #fff;
            }
        </style>
    </head>
    <body>
        <div class="headernya">
            <table width="100%" border="0">
                <tr>
                    <td width="20%"><img src="{{url('img/logoks.png')}}" width="90%" height="70px"></td>
                    <td>
                        <font style="font-weight:bold;color:blue;font-size:18px;display:block">PT. KRAKATAU STEEL (Persero) Tbk.</font>
                        <font style="font-weight:bold;color:#000;font-size:15px;display:block">DIVISI TAX & VERIFICATION</font>
                        <font style="color:#000;font-size:15px;display:block">TELP : (0254)372203, FAX : 372342</font>
                        <font style="color:#000;font-size:15px;display:block">JL. AUSTRALIA II NO 1 KAWASAN INDUSTRI KIEC-CILEGON</font>
                    </td>
                    <?php
                        $qrcd='https://app.krakatausteel.com/bttdonline/public/bttd/cari?INV='.$data['Reference'];
                    ?>
                    <td width="14%">{!! barcoderider($qrcd,3,3)!!}</td>
                </tr>
            </table>
        </div>
        <div class="isinya">
            <table width="100%" border="0">
                <tr>
                    <td style="text-align:center">
                        <font style="font-weight:bold;color:#000;font-size:18px;display:block">(BTTD)</font>
                        <font style="color:#000;font-size:15px;display:block">( BUKTI TANDA TERIMA DOKUMEN )</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <font style="color:#000;font-size:14px;display:block">Telah diterima dokumen tagihan:</font>
                    </td>
                </tr>
            </table>
            <table width="100%" border="1">
                <tr>
                    <th width="5%" class="tth">No</th>
                    <th width="40%" class="tth">Keterangan</th>
                    <th class="tth"></th>
                </tr>
                <tr>
                    <td class="ttd">1</td>
                    <td class="ttd">Kode Vendor / Rekanan</td>
                    <td class="ttd"> {{$data['LIFNR']}}</td>
                </tr>
                <tr>
                    <td class="ttd">2</td>
                    <td class="ttd">Nama Vendor / Rekanan</td>
                    <td class="ttd"> {{$data['vendor']['name']}}</td>
                </tr>
                <tr>
                    <td class="ttd">3</td>
                    <td class="ttd">Nilai Faktur Pajak (PPN 10%)</td>
                    <td class="ttd">{{$data['Amount']}}</td>
                </tr>
                <tr>
                    <td class="ttd">4</td>
                    <td class="ttd">Nilai Kwitansi / Invoice (DPP + PPN)</td>
                    <td class="ttd">{{$data['AmountInvoice']}}</td>
                </tr>
                <tr>
                    <td class="ttd">5</td>
                    <td class="ttd">No. Faktur Pajak</td>
                    <td class="ttd">{{$data['Reference']}}</td>
                </tr>
                <tr>
                    <td class="ttd">6</td>
                    <td class="ttd">Tanggal Faktur Pajak</td>
                    <td class="ttd">{{date('d-m-Y',strtotime($data['InvoiceDate']))}}</td>
                </tr>
                <tr>
                    <td class="ttd">7</td>
                    <td class="ttd">No. Kwitansi</td>
                    <td class="ttd">{{$data['HeaderText']}}</td>
                </tr>
                <tr>
                    <td class="ttd">8</td>
                    <td class="ttd">No.PO/Kontrak</td>
                    <td class="ttd">{{$data['PurchaseOrder']}}</td>
                </tr>
                <tr>
                    <td class="ttd">9</td>
                    <td class="ttd">Email / Telp / Fax Vendor</td>
                    <td class="ttd">{{$data['vendor']['email']}} / {{$data['no_tlp']}}</td>
                </tr>
                <tr>
                    <td class="ttd">10</td>
                    <td class="ttd">No. Rekening</td>
                    <td class="ttd">{{$data['PartBank']}}</td>
                </tr>
                <tr>
                    <td class="ttd">11</td>
                    <td class="ttd">Nama Bank</td>
                    <td class="ttd">{{$data['nama_bank']}}</td>
                </tr>
            </table>
            <table width="100%" border="0">
                <tr>
                    <td>
                    <font style="color:#000;font-size:10px;display:block">&nbsp;</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <font style="color:#000;font-size:14px;display:block">DOKUMEN YANG DISERAHKAN KEPADA DIVISI TAX & VERIFICATION PT. KRAKATAU STEEL (Persero) Tbk:</font>
                    </td>
                </tr>
            </table>
            <table width="100%" border="1">
                <tr>
                    <th width="5%" class="tth">No</th>
                    <th width="88%" class="tth" style="text-transform: uppercase !important;">Dokumen Tagihan {!!cek_tagihan($data['tagihan_id'])!!}</th>
                    <th class="tth"></th>
                </tr>
                @foreach(detail_tagihan($data['tagihan_id']) as $no=>$det)
                    <tr>
                        <td class="ttd">{{$no+1}}</td>
                        <td class="ttd">{{$det['name']}}</td>
                        <td class="ttd" style="text-align:center"></td>
                    </tr>
                @endforeach
            </table>
            <table width="100%" border="0">
                <tr>
                    <td>
                    <font style="color:#000;font-size:10px;display:block">&nbsp;</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <font style="color:#000;font-size:14px;display:block"><u>Diisi Oleh Officer VP:</u></font>
                    </td>
                </tr>
            </table>
            <table width="70%" border="1">
                <tr>
                    <td class="ttdp" width="3%">-</td>
                    <td class="ttdp" width="30%">No Dokumen</td>
                    <td class="ttdp" >: </td>
                </tr>
                <tr>
                    <td class="ttdp">-</td>
                    <td class="ttdp">Tanggal Jatuh Tempo</td>
                    <td class="ttdp" >:</td>
                </tr>
                <tr>
                    <td class="ttdp">-</td>
                    <td class="ttdp">Paraf Pemroses</td>
                    <td class="ttdp" >:</td>
                </tr>
            </table>
            
            <!-- <table width="100%" border="0">
                <tr>
                    <td colspan="2">
                        <font style="color:#000;font-size:12px;display:block;font-style:italic">Catatan :</font>
                    </td>
                </tr>
                <tr>
                    <td width="5%"><font style="color:#000;font-size:12px;display:block">*)</font></td>
                    <td>
                        <font style="color:#000;font-size:12px;display:block;font-style:italic">
                            SPT Masa PPN Masa ( sebelumnya ) terdiri dari :<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;- Bukti Penerimaan Surat <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;- Formulir 1111 & Formulir !!!! A2 
                        </font>
                    </td>
                </tr>
                <tr>
                    <td width="5%"><font style="color:#000;font-size:12px;display:block">**)</font></td>
                    <td>
                        <font style="color:#000;font-size:12px;display:block;font-style:italic">
                            Jika Copy, beri keterangan dokumen asli sudah da pada Invoice No. berapa pada kolom keterangan
                        </font>
                    </td>
                </tr>
                <tr>
                    <td width="5%"><font style="color:#000;font-size:12px;display:block;font-style:italic">***)</font></td>
                    <td>
                        <font style="color:#000;font-size:12px;display:block">
                            No. Telp, yang bisa dihubungi WAJIB diisi
                        </font>
                    </td>
                </tr>
            </table> -->
            
            <div class="footer">
                <table width="100%" border="0">
                    <!-- <tr>
                        <td width="30%">
                            <font style="color:#000;font-size:12px;display:block">
                                Diserahkan oleh <br><br><br><br><br>
                                Nama :.................................... <br>
                                <hr style="border: dotted 2px #000">
                                
                            </font>
                        </td>
                        <td width="40%">
                        </td>
                        <td align="center">
                            <font style="color:#000;font-size:12px;display:block">
                                Diterima oleh <br><br><br><br><br>
                                Nama :.................................... <br>
                                <hr style="border: dotted 2px #000">
                                
                            </font>
                        </td>
                    </tr> -->
                    <tr>
                        <td align="left" colspan="3">
                            <font style="color:#000;font-size:12px;display:block;font-style:italic">
                                1.Dokumen ini hanya berlaku sebagai bukti penyerahan tagihan yang sah apabila telah diotorisasi oleh PT Krakatau Steel (Persero) Tbk..
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3">
                            <font style="color:#000;font-size:12px;display:block;font-style:italic">
                                2.PT Krakatau Steel (Persero) Tbk tidak bertanggung jawab atas penyalahgunaan dan pemanfaatan dokumen ini kepada pihak lain.
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3">
                            <font style="color:#000;font-size:12px;display:block;font-style:italic">
                                3.Dokumen ini dokumen elektronik, tidak perlu tanda tangan.
                            </font>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        
        <div class="isistruk">
            <table width="100%" border="0">
                <tr>
                    <td style="text-align:center" width="100%">
                        <font style="font-weight:bold;color:#000;font-size:18px;display:block">(STRUK)</font>
                        <font style="color:#000;font-size:15px;display:block">( {{cek_kategori_tagihan(cek_struknya($data['tagihan_id']))}} )</font>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:13px;"><b>VOUCHER NO :</b> {{$data['no_voucher']}}</td>
                </tr>
                <tr>
                    <td style="font-size:13px;"><b>JATUH TEMPO :</b>  {{$data['tempo']}}</td>
                </tr>
            </table>
            <table width="60%" border="1">
                <tr>
                    <th width="7%" class="tthh">No</th>
                    <th width="20%" class="tthh">Discount</th>
                    <th width="20%" class="tthh">Qty</th>
                    <th width="25%" class="tthh">Harga Satuan</th>
                    <th  class="tthh">Total</th>
                </tr>
                <?php
                    $jumdiscount=0;
                    $jumqty=0;
                    $jumharga_satuan=0;
                    $jumtotal_harga=0;


                ?>
                @foreach(struk_get($data['Reference']) as $struk_get)
                    <?php
                        $jumdiscount+=$struk_get['discount'];
                        $jumqty+=$struk_get['qty'];
                        $jumharga_satuan+=$struk_get['harga_satuan'];
                        $jumtotal_harga+=$struk_get['total_harga'];


                    ?>
                    <tr>
                        <td class="ttd">{{$struk_get['urut']}}</td>
                        <td class="ttd" align="right">{{uang($struk_get['discount'])}}</td>
                        <td class="ttd" align="right">{{$struk_get['qty']}}</td>
                        <td class="ttd" align="right">{{uang($struk_get['harga_satuan'])}}</td>
                        <td class="ttd" align="right">{{uang($struk_get['total_harga'])}}</td>
                    </tr>

                @endforeach
                    <tr>
                        <td class="ttd"></td>
                        <td class="ttd" align="right">{{uang($jumdiscount)}}</td>
                        <td class="ttd" align="right">{{$jumqty}}</td>
                        <td class="ttd" align="right">{{uang($jumharga_satuan)}}</td>
                        <td class="ttd" align="right">{{uang($jumtotal_harga)}}</td>
                    </tr>
                @if(cek_struknya($data['tagihan_id'])==1)
                    <tr>
                        <td class="tth" colspan="4">Discount</td>
                        <td class="ttd" align="right" >{{uang($jumdiscount)}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">DPP</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga)}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">PPN 10%</td>
                        <td class="ttd" align="right" >{{uang(($jumtotal_harga*10)/100)}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">DPP + PPN</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga+(($jumtotal_harga*10)/100))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">Materai</td>
                        <td class="ttd" align="right" >{{uang(materai($jumtotal_harga))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">Denda</td>
                        <td class="ttd" align="right" >{{uang(datastruk($data['Reference'])['denda'])}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">DPP - (Materai + Denda)</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga-(materai($jumtotal_harga)+datastruk($data['Reference'])['denda']))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">PPH {{datastruk($data['Reference'])['tarif']}}%</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga*(datastruk($data['Reference'])['tarif']/100))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">Jumlah Yang Dibayarkan</td>
                        <td class="ttd" align="right" >{{uang(($jumtotal_harga-(materai($jumtotal_harga)+datastruk($data['Reference'])['denda']))-($jumtotal_harga*(datastruk($data['Reference'])['tarif']/100)))}}</td>
                    </tr>
                @endif
                @if(cek_struknya($data['tagihan_id'])==2)

                @endif
                @if(cek_struknya($data['tagihan_id'])==3)
                    <tr>
                        <td class="tth" colspan="4">Discount</td>
                        <td class="ttd" align="right" >{{uang($jumdiscount)}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">DPP</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga)}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">PPN 10%</td>
                        <td class="ttd" align="right" >{{uang(($jumtotal_harga*10)/100)}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">DPP + PPN</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga+(($jumtotal_harga*10)/100))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">UM PPH 22</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga*(datastruk($data['Reference'])['um']/100))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">DPP + PPN + UM PPH 22</td>
                        <td class="ttd" align="right" >{{uang(($jumtotal_harga+(($jumtotal_harga*10)/100))+($jumtotal_harga*(datastruk($data['Reference'])['um']/100)))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">PPH {{datastruk($data['Reference'])['tarif']}}%</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga*(datastruk($data['Reference'])['tarif']/100))}}</td>
                    </tr>
                    <tr>
                        <td class="tth" colspan="4">Jumlah Yang Dibayarkan</td>
                        <td class="ttd" align="right" >{{uang($jumtotal_harga+($jumtotal_harga*(datastruk($data['Reference'])['um']/100)))}}</td>
                    </tr>
                @endif
            </table>
            
            
        </div>
        
    </body>
</html>