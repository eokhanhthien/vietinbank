@extends('layouts.layout')
@section('content')
<div class=" container mt-4 ">
    <form action="{{ route('qr.generate') }}" method="POST">
        @csrf
        <label for="staff_id">Mã cán bộ:</label>
        <input type="text" id="staff_id" name="staff_id" required>
        <br>
        <label for="name">Tên cán bộ:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <button type="submit">Tạo Mã QR</button>
    </form>
    
      <table class="table" id="data-table">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">QR</th>
            <th scope="col">Mã cán bộ</th>
            <th scope="col">Tên cán bộ</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($staff_qr_codes as $staff_qr_code)
          <tr>
            <th scope="row">{{$loop->index + 1}}</th>
            <td><img style="width: 120px" src="{{ asset('images/QR/' . $staff_qr_code->image) }}" alt=""></td>
            <td>{{$staff_qr_code->code}}</td>
            <td>{{$staff_qr_code->name}}</td>
            <td>
             
              <a href="{{ asset('images/QR/' . $staff_qr_code->image) }}" download="qr_code_{{ $staff_qr_code->code }}.png">Download</a>

            </td>
          </tr>
          @endforeach

         
         
        </tbody>
      </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready( function () {
        $('#data-table').DataTable({
        dom: 'Blfrtip',
        });
    } );
</script>

@endsection