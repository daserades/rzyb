@extends('layouts.app')

@section('content')
	<div>
		<div >
			@if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
			 <div align="center">{{ __('İPLİK DEPO') }}</div>
				<div class="panel body">
					<table id="table" class="table-hover">
						<thead>
							<tr>
								<th>Lot No</th>
								<th>İrsaliye No</th>
								<th>Marka</th>
								<th>Cins</th>
								<th>Boya Cins</th>
								<th>No-Ne</th>
								<th>Büküm S.</th>
								<th>Renk 1</th>
								<th>Renk 2</th>
								<th>Renk No1</th>
								<th>Renk No2</th>
								<th>Miktar</th>
								<th>Brüt M.</th>
								<th>Birim</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
						<tfoot>	
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
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
	$(function() {
		 $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="8" placeholder="Search '+title+'" />' );
    } ); 

		var table= $('#table').DataTable({
			//order : //['5','desc'],    
			order:[],    
			processing: true,
			ajax: '{{ route('iplikjs') }}',
			columns: [
			{ data: 'partino' ,"defaultContent": ""},
			{ data: 'irsaliye_no' ,"defaultContent": ""},
			// { data: 'iplikmarka' ,"defaultContent": ""},
			{data: null , name:'iplikmarka' ,render: function ( data, type, row) {
                //console.log(row);
                if (row.iplikmarka != null) return '<a href="{{url('iplikirsaliye/showreport3')}}/'+row.iplikno+'/'+row.ne+'/'+row.iplikcins_id+'/'+row.partino+'/'+row.renkno+'" target="_blank">'+row.iplikmarka+'</a>';
            } ,"defaultContent": ""},
			{ data: 'iplikcins' ,"defaultContent": ""},
			{ data: 'boyacins' ,"defaultContent": ""},
			{ data: 'iplikno' ,"defaultContent": ""},
			{ data: 'ne' ,"defaultContent": ""},
			{ data: 'renk' ,"defaultContent": ""},
			{ data: 'renksim' ,"defaultContent": ""},
			{ data: 'renkno' ,"defaultContent": ""},
			{ data: 'renknosim' ,"defaultContent": ""},
			{ data: 'miktar', render: $.fn.dataTable.render.number( '.', ',', 2) ,"defaultContent": ""},
			{ data: 'brutmiktar' , render: $.fn.dataTable.render.number( '.', ',', 2) ,"defaultContent": ""},
	/*/		{ data: 'brutmiktar' , render: function ( data, type, row ) {
            return row.brutmiktar + '<br>(' + row.unit + ')';
        } ,"defaultContent": ""},*/
			{ data: 'unit' ,"defaultContent": ""}
			]
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