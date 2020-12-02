
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BooksMoskow - Страница "Купоны"</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />


</head>
<body>
<div class="container">
    <br />
    <h3 align="center">BooksMoskow - Страница "Купоны"</h3>
    <br />
    <br />
    <div class="row input-daterange">
        <div class="col-md-4">
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="С"  />
        </div>
        <div class="col-md-4">
            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="По"  />
        </div>
        <div class="col-md-4">
            <button type="button" name="filter" id="filter" class="btn btn-primary">Фильтр</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-default">Обновить</button>
        </div>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="cupon_table">
            <thead>
            <tr>
                <th>Cupon ID</th>
                <th>User Email</th>
                <th>Send</th>
                <th>Date</th>
            </tr>
            </thead>

            @foreach($cupon as $var)
                    <tr>
                        <th> {{$var->id}}</th>
                        <th>{{$var->user_email}}</th>
                        <th>{{$var->send}}</th>
                        <th>{{$var->created_at}}</th>
                    </tr>
            @endforeach

        </table>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        $('.input-daterange').click({
            format:'yyyy-mm-dd',
        });

        load_data();

        function load_data(from_date = '', to_date = '')
        {
            $('#cupon_table').create({
                $ajax: {
                    type:'ajax',
                    method: 'post',
                    url:'{{ route("cupon_info") }}',
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {
                        data:'id',
                        name:'id'
                    },
                    {
                        data:'user_email',
                        name:'user_email'
                    },
                    {
                        data:'send',
                        name:'send'
                    },
                    {
                        data:'created_at',
                        name:'created_at'
                    }
                ]
            });
        }

        $('#filter').click(function(){
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                $('#cupon_table').datatables().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Нужны обе даты');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#cupon_table').datatables.destroy();
            load_data();
        });

    });
</script>










{{--<br>--}}
{{--<div class="container">--}}
{{--<p>Купоны отправлены</p>--}}
{{--    <table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Id</th>--}}
{{--        <th>User email</th>--}}
{{--        <th>Cupon send</th>--}}
{{--        <th>Date</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}

{{--@foreach($cupon as $var)--}}

{{--        <tr>--}}
{{--            <th> {{$var->id}}</th>--}}
{{--            <th>{{$var->user_email}}</th>--}}
{{--            <th>{{$var->send}}</th>--}}
{{--            <th>{{$var->created_at}}</th>--}}
{{--        </tr>--}}

{{--@endforeach--}}
{{--    </table>--}}




{{--<p>--}}
{{--    Брошенные корзины--}}
{{--</p>--}}


{{--@foreach($dropcart as $var)--}}
{{--    <table>--}}
{{--        <tr>--}}
{{--            <td> {{$var->id}}</td>--}}
{{--            <td>{{$var->user_id}}</td>--}}
{{--            <td>{{$var->user_email}}</td>--}}
{{--            <td>{{$var->user_name}}</td>--}}
{{--            <td>{{$var->send}}</td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--@endforeach--}}

{{--</div>--}}

{{--</body>--}}
{{--</html>--}}


