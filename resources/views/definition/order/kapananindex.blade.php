@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div align="center">{{ __('KAPANAN SİPARİŞ LİSTESİ') }} 
                </div> 
			<li align="center" type=none>
				<!--<input type="date" name="date" class="form control">
				<input type="date" name="to_date">
				<button type="submit" class="btn btn-outline-info">Ara</button>
			-->
			</li>
				<div class="asd">
					<table id="table" class="table-hover table-striped">
						<thead>
							<tr>
								<th>Firma</th>
								<th>Desen No</th>
								<th>Desen Adı</th>
								<th>Sipariş Tür</th>
								<th>İrsaliye Şekli</th>
								<th>Kalite</th>
								<th>En</th>
								<th>Sip. Trh</th>
								<th>Termin Trh</th>
								<th>Sip. Miktar</th>
								<th>Birim</th>
								<th>Renk1 (ÇÖZGÜ)</th>
								<th>Renk2 (ATKI)</th>
								<th>Çözgü NE</th>
								<th>Atkı Ne</th>
								<th>Tarak No</th>
								<th>Tarak Eni</th>
								<th>Atkı Sık.</th>
								<th>Çözgü Tel S.</th>
								<th>Çözgü Met.</th>
								<th>Ham Sip Met.</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						</tbody>
						<tfoot>	<th>Firma</th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>				
								<th></th>				
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
	<link href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">  
	<link  href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
    <style type="text/css">
    	th { font-size: 12px; }
    	td {
    		 font-size: 11px; 
    		font-weight: bold;
    	}
    	tr:hover td {background:yellow}

    </style>
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/datetime.js') }}"></script>
<script>
	$(function() {
		$('#table').on( 'click', 'tbody tr td.sil', function () {
  //var rowData = table.row( this ).data();
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
			} );
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="9" placeholder="Search '+title+'" />' );
    } );

		var table= $('#table').DataTable({
			order:[], 
			processing: true,
			serverSide: true,
			colReorder: true,
			ajax: '{{ route('kjs') }}',
			columns: [
			{ 
			 data: 'order_no'
			},
			//{ data: 'desen.no' , "defaultContent": "" },
			{data: null ,  render: function ( data, type, row) {
                //console.log(row);
                if (row.desen != null) return '<a href="{{url('desen/desen/')}}/'+data.desen_id+'" target="_blank">'+row.desen.no+'</a>';
            } },
			{ data: 'desenadi' , "defaultContent": "" },
			{ data: 'ordertur.name' , "defaultContent": ""},
			{ data: 'irsaliyesekli.name' , "defaultContent": "" },
			{ data: 'kalite' },
			{ data: 'en' },
			{ data: 'created_at' },
			{ data: 'termin' },
			{ data: 'miktar' },
			{ data: 'unit.name' , "defaultContent": "" },
			{ data: 'renk'  },
			{ data: 'renk2'  },
			//{ data: 'orderwarp.cno1' , "defaultContent": ""},
			//{ data: 'orderweft.ano1' , "defaultContent": "" },
			{
				data: "orderdetailwarp.0.cinsne","defaultContent": "",
				"render": function (data, type,  row, meta) {

					if (data != null) {
					 	if(row && row.orderdetailwarp[0].cinsne){
							result= row.orderdetailwarp[0].cinsne;
				 			//console.log(result);
				 			return result;
				 		}
		 			}
		 		 else {
					 	if(row && row.orderwarp){
				 			result= row.orderwarp.cno1;
				 			//console.log(result);
				 			return result;
				 		}	
	 		  		  }	
		 		 }
			},
			//{ data: 'orderweft.ano1' , "defaultContent": "" },
			{
					data: "orderdetailweft.0.acinsne", "defaultContent": "",
					"render": function (data, type,  row, meta) {

						if (data != null) {
							if(row && row.orderdetailweft[0].acinsne){
								result= row.orderdetailweft[0].acinsne;
						 		//console.log(result);
						 		return result;
						 	}
						 }
					 else{
						 	if(row && row.orderweft){
						 		result= row.orderweft.ano1;
					 			//console.log(result);
					 			return result;
					 		}
					 	}
				 }
				},
			{ data: 'tarakno'  },
			{ data: 'tarakeni'  },
			{ data: 'atkisikligi'  },
			{ data: 'cts'  },
			{ data: 'cozgumetraji'  },
			{ data: 'hamsip'  },
			{ data: 'action', orderable: false, searchable: false}
			],
			columnDefs:[
			{targets:[7,8], render:function(data){
				return moment(data).format('DD/MM/YYYY');
			}
			}
  			
			]
							/*columnDefs: [
				          { targets: [0, 1], "width": "20%", render: $.fn.dataTable.render.ellipsis(20, false, true) },
				          { targets: 2, "width": "33%", render: $.fn.dataTable.render.ellipsis(40, false, true) },
				          { targets: 3, "width": "16%", render: $.fn.dataTable.render.moment( 'Do MMM YYYYY' ) },
				          { targets: 4, "width": "11%", render: $.fn.dataTable.render.number(',', '.', 0) }
				    		 ]
data: function (data,type,dataToSet) {
				return data.firma.zarano+"-"+data.order_no.substr(-3);
			}
				    		  */ 
		});
		table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

	});
</script>
@endsection
