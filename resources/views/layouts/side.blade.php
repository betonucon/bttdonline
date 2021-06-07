<ul class="nav">
@if(Auth::user()['role_id']==1)
	<li class="nav-header">PENGGUNA APLIKASI</li>
	<li class="has-sub"><a style="color:#fff" href="{{url('pengguna')}}"><i class="fa fa-user-circle"></i><span>Internal</span></a></li>
	<li class="nav-header">MASTER </li>
	<li class="has-sub"><a style="color:#fff" href="{{url('vendor')}}"><i class="fa fa-user-circle"></i><span>Vendor</span></a></li>
	<li class="has-sub"><a style="color:#fff" href="{{url('bank')}}"><i class="fa fa-briefcase"></i><span>Rekening Vendor</span></a></li>
	<li class="has-sub"><a style="color:#fff" href="{{url('tagihan')}}"><i class="fa fa-tags"></i><span>Jenis Tagihan</span></a></li>
	
	<li class="nav-header">INFORMASI</li>
	<li class="has-sub"><a style="color:#fff" href="{{url('pengumuman')}}"><i class="fa fa-volume-up"></i><span>Pengumuman</span></a></li>
	<li class="has-sub"><a style="color:#fff" href="{{url('spt')}}"><i class="fa fa-volume-up"></i><span>SPT Vendor</span></a></li>
	<li class="has-sub active">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>Bukti Potong</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('pph')}}">PPH</a></li>
			<li><a style="color:#fff" href="{{url('ppn')}}">PPN</a></li>
		</ul>
	</li>
@endif
@if(Auth::user()['role_id']==3)
	<li class="nav-header">MASTER VENDOR</li>
	<li class="has-sub"><a style="color:#fff" href="{{url('vendor')}}"><i class="fa fa-user-circle"></i><span>Vendor</span></a></li>
	<li class="has-sub"><a style="color:#fff" href="{{url('bank')}}"><i class="fa fa-briefcase"></i><span>Rekening Vendor</span></a></li>
	<li class="nav-header">DOKUMEN BTTD</li>
	<li class="has-sub">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>Daftar BTTD</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('officer')}}">BTTD Baru</a></li>
			<li><a style="color:#fff" href="{{url('officer/terima')}}">BTTD Diterima</a></li>
		</ul>
	</li>
@endif
@if(Auth::user()['role_id']==2)
	<li class="nav-header">MASTER VENDOR</li>
	<li class="has-sub"><a style="color:#fff" href="{{url('vendor')}}"><i class="fa fa-user-circle"></i><span>Vendor</span></a></li>
	<li class="has-sub"><a style="color:#fff" href="{{url('bank')}}"><i class="fa fa-briefcase"></i><span>Rekening Vendor</span></a></li>
	<li class="nav-header">DOKUMEN BTTD</li>
	<li class="has-sub">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>Daftar BTTD</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('loket')}}">BTTD Baru</a></li>
			<li><a style="color:#fff" href="{{url('loket/terima')}}">BTTD Diterima</a></li>
			<li><a style="color:#fff" href="{{url('bttd_revisi')}}">Revisi BTTD</a></li>
		</ul>
	</li>
	<li class="has-sub"><a href="{{url('bttd/cari')}}"><i class="fa fa-map-marker-alt"></i><span>Cari BTTD</span></a></li>
	<li class="nav-header">BUKTI POTONG</li>
	<li class="has-sub">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>PPH</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('pph')}}">PPH</a></li>
			<li><a style="color:#fff" href="{{url('pph/pengambilan')}}">Penyeraha E-cupon</a></li>
		</ul>
	</li>
	<li class="has-sub">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>PPN</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('ppn')}}">PPN</a></li>
			<li><a style="color:#fff" href="{{url('ppn/pengambilan')}}">Penyeraha E-cupon</a></li>
		</ul>
	</li>
@endif
@if(Auth::user()['role_id']==7)
	<li class="nav-header">DOKUMEN BTTD</li>
	<li class="has-sub active">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>BTTD</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('bttd/baru')}}">Buat BTTD</a></li>
			<li><a style="color:#fff" href="{{url('bttd')}}">Daftar BTTD</a></li>
			<li><a style="color:#fff" href="{{url('bttd_revisi')}}">Revisi BTTD</a></li>
		</ul>
	</li>
	<li class="nav-header">BUKTI POTONG</li>
	<li class="has-sub active">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>PPH</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('pph/vendor')}}">PPH</a></li>
			<li><a style="color:#fff" href="{{url('pph/terima')}}">Cetak E-cupon</a></li>
		</ul>
	</li>
	<li class="has-sub active">
		<a style="color:#fff" href="javascript:;">
			<b class="caret"></b>
			<i class="fa fa-clone"></i>
			<span>PPN</span>
		</a>
		<ul class="sub-menu">
			<li><a style="color:#fff" href="{{url('ppn/vendor')}}">PPN</a></li>
			<li><a style="color:#fff" href="{{url('ppn/terima')}}">Cetak E-cupon</a></li>
		</ul>
	</li>
	
@endif
	
	
	
	
</ul>