<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="15%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor:pointer">Id</th>
            <th width="50%" class="sorting" data-sorting_type="asc" data-column_name="user_email" style="cursor: pointer">Email пользователя</th>
            <th width="15%" class="sorting" data-sorting_type="asc" data-column_name="cupon_send" style="cursor: pointer">Купон отправлен</th>
            <th width="20%" class="sorting" data-sorting_type="asc" data-column_name="date" style="cursor: pointer">Дата</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $row)
            <tr>
                <td>{{ $row->id}}</td>
                <td>{{ $row->user_email }}</td>
                <td>{{ $row->send }}</td>
                <td>{{ $row->created_at }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" align="center">
                {!! $data->links() !!}
            </td>
        </tr>

        </tbody>
    </table>
    {{ csrf_field() }}
</div>
