
<!DOCTYPE html>
<html>
<head>
    <title>Брошенные корзины BooksMoscow</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
<br />
<div class="container box">
    <h3 align="center">Брошенные корзины BooksMoscow</h3><br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5">Всего записей - <b><span id="total_records"></span></b></div>
                <div class="col-md-5">
                    <div class="input-group input-daterange">
                        <input type="text" name="from_date" id="from_date" readonly class="form-control" />
                        <div class="input-group-addon">по</div>
                        <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Фильтр</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Обновить</button>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="10%">Id</th>
                        <th width="30%">Email пользователя</th>
                        <th width="10%">Id продукта</th>
                        <th width="30%">Продукт</th>
                        <th width="10%">Отправлено</th>
                        <th width="10%">Дата</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){

        var date = new Date();

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        var _token = $('input[name="_token"]').val();

        fetch_data();

        function fetch_data(from_date = '', to_date = '')
        {
            $.ajax({
                url:"{{ route('dropCartDateRange.fetch_data') }}",
                method:"POST",
                data:{from_date:from_date, to_date:to_date, _token:_token},
                dataType:"json",
                success:function(data)
                {
                    let output = '';
                    $('#total_records').text(data.length);
                    for(let count = 0; count < data.length; count++)
                    {
                        output += '<tr>';
                        output += '<td>' + data[count].id + '</td>';
                        output += '<td>' + data[count].user_email + '</td>';
                        output += '<td>' + data[count].good_id + '</td>';
                        output += '<td>' + data[count].good_name + '</td>';
                        output += '<td>' + data[count].send + '</td>';
                        output += '<td>' + data[count].created_at + '</td></tr>';
                    }
                    $('tbody').html(output);
                }
            })
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                fetch_data(from_date, to_date);
            }
            else
            {
                alert('Необходимы обе даты ');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            fetch_data();
        });


    });
</script>