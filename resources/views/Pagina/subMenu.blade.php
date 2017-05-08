<ol class="breadcrumb" style=" background:cyan"> 
<li class="treeview"><a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span>INICIO</span> </a></li>
<li style="display: none;"  id="portafolios" class="treeview"><a href="javascript:void(0);" onclick="portafolioHome();"><i class="glyphicon glyphicon-briefcase"></i> <span></span> </a></li>
<input type="text" name="docente" value="{{ Auth::user()->IdDoc}}" id="docente">
</ol>
