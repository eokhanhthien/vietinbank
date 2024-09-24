@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QR Code Scanner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #output {
            margin-top: 20px;
            font-size: 1.2em;
        }
        button.dt-button {
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
        }
        td {
            font-size: 14px;
        }
        a.paginate_button {
            padding: 8px !important;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 13px;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 5px;
            width: 150px;
            outline: none;
        }
    </style>
</head>
<body>
<div class="flex flex-col min-h-screen">
        <main class="flex-1 bg-gray-100 py-2 md:py-4">
           <div class="flex flex-col items-center">
              <div class="relative container flex flex-wrap flex-1 items-start gap-6">
                 <div class="bg-white flex-1 p-8 rounded-md space-y-4 w-full min-w-full" style="min-width: 700px">

                    <form action="/roll-attendance" method="GET" style="display: none">
                        @csrf
                        <input type="text" id="staff_code" name="staff_code" required>
                        <button type="submit">Submit</button>
                    </form> 
               
                    <table class="table" id="data-table">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Mã cán bộ</th>
                            <th scope="col">Tên cán bộ</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forEach($staff_list as $key => $staff)
                                <tr>
                                    <td>{{$staff_list->count() - $key}}</td>
                                    <td>{{$staff->code}}</td>
                                    <td>{{$staff->name}}</td>
                                </tr>
                            @endForEach
                        </tbody>
                      </table>
                     
                    <button class="btn btn-danger" style="font-size: 12px;" data-toggle="modal" data-target="#confirmDeleteModal">
                        <i class="far fa-trash-alt"></i>
                    </button>
                   
            </div>

            <!-- Modal -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn chắc chắn muốn xóa toàn bộ dữ liệu điểm danh?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" id="confirmDelete"><a href="/delete-attendance" style="color: white !important;text-decoration: none !important;">Xóa</a></button>
                        </div>
                    </div>
                </div>
            </div>

                 <div class="bg-white rounded-md md:sticky md:top-[80px] flex-1 text-center space-y-4">
                   <div class="flex-1 text-center space-y-2">
                      <div class="relative max-w-[500px] mx-auto">
                         <div style="position:relative;width:100%;padding-bottom:100%" data-radix-aspect-ratio-wrapper="">
                            <div style="position:absolute;top:0;right:0;bottom:0;left:0; padding:20px">
                               {{-- <img id="qr-image" src="{{$qrCode??''}}" alt="QR Code" sizes="" srcset=""> --}}
                               <img id="avatar" style="width: 200px; margin: auto;" src="https://th.bing.com/th/id/R.c3631c652abe1185b1874da24af0b7c7?rik=XBP%2fc%2fsPy7r3HQ&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fpng-user-icon-circled-user-icon-2240.png&ehk=z4ciEVsNoCZtWiFvQQ0k4C3KTQ6wt%2biSysxPKZHGrCc%3d&risl=&pid=ImgRaw&r=0" alt="QR Code" sizes="" srcset="">
                                <h5 id="user_name" style="margin-top:20px">{{!empty($user_code) ? $user_code->name : ''}}</h5>
                                <p id="user_code">{{!empty($user_code) ? $user_code->code : ''}}</p>
                            </div>
                           </div>
                       </div>
                   </div>   
                 
                   
                 </div>
            
           </div>
        </main>
     </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        $(document).ready( function () {
            $('#data-table').DataTable({
            dom: 'Blfrtip',
            order: [[0, 'desc'],]
            });
        } );

        $(document).ready(function() {
            let qrData = ''; 
            const staffCode = $('#staff_code');
    
            $(document).keydown(function(event) {
                qrData += event.key;
                if (event.key === 'Enter') {
                    const staff_code = qrData.trim().replace(/Enter$/, '');
                    // gán value cho staffcode
                    staffCode.val(staff_code);
                    qrData = '';

                    $.ajax({
                        url: '/roll-attendance',
                        type: 'GET',
                        data: {
                            staff_code: staff_code
                        },
                        success: function(response) {
                            console.log(response);
                            $('#user_name').text(response.data.user_code.name);
                            $('#user_code').text(response.data.user_code.code);

                            if(response.status == 'success') {
                                 
                                $('#data-table tbody').empty();
                                    // Lấy đối tượng DataTable
                                    var table = $('#data-table').DataTable();

                                    // Xóa tất cả hàng hiện tại
                                    table.clear();

                                    // Thêm các hàng mới
                                    response.datatable.forEach(function(item, index) {
                                        var newIndex = response.datatable.length - index;
                                        table.row.add([
                                            newIndex, // số thứ tự
                                            item.code, // mã cán bộ
                                            item.name  // tên cán bộ
                                        ]);
                                    });

                                    // Cập nhật DataTable
                                    table.draw();
 
                            }else{
                                
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

@endsection