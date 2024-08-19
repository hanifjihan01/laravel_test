<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CRUD Laravel 8</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Data Admisi Sekolah</h1>

  <div class="container">
    <a href="/tambahpegawai" class="btn btn-success">Tambah +</a>
    
    <div class="row g-3 align-items-center mt-2 mb-2">
  <div class="col-auto">
    <form action="/pegawai" method="get">
    <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
    </form>
  </div>

  <div class="col-auto">
  <a href="/exportpdf" class="btn btn-info">Export PDF</a>
  </div>
  <div class="col-auto">
  <a href="/exportexcel" class="btn btn-success">Export Excel</a>
  </div>
  <div class="col-auto">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Import Data
</button>
  </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="post" enctype="multipart/form-data">
        @csrf

      <div class="modal-body">
        <div class="form-group">
          <input type="file" name="file" required></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  </div>

  

</div>
    <div class="row">
      <!-- @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{$message}}
      </div>
      @endif -->
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Foto</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">No Telpon</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
                @foreach ($data as $index => $row)
                <tr>
                <th scope="row">{{$index + $data->firstItem()}}</th>
                <td>{{$row->nama}}</td>
                <td>
                    <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 40px;">
                </td>
                <td>{{$row->jeniskelamin}}</td>
                <td>0{{$row->notelpon}}</td>
                <td>{{$row->created_at->format('D M Y')}}</td>
                <td>
                   
                    <a href="/tampilkandata/{{$row->id}}"  class="btn btn-info">Edit</a>
                    <a href="#" class="btn btn-danger delete" data-id="{{$row->id}}" data-nama="{{$row->nama}}">Delete</a>
                </td>
                
              </tr> 
                @endforeach
            
            
            </tbody>
          </table>
          {{ $data->links() }}
    </div>
  </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
  <script>

    $('.delete').click(function(){
      var pegawaiid = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');

      
      swal({
  title: "Yakin??",
  text: "Anda akan menghapus "+nama+"",
  icon: "warning",  
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location="/delete/"+pegawaiid+""
    swal("Data berhasil dihapus", {
      icon: "success",
    });
  } else {
    swal("Data anda tidak jadi dihapus");
  }
});
    });
   
  </script>

  <script>
    @if (Session::has('success'))
    toastr.success("{{ Session::get('success')}}");
    @endif
    
  </script>
</html>