@extends('layouts.app')


@section('content')
<div class="container mt-5">
    <div class="my-5">
        <input type="text" name="search" id="search" placeholder="Pretražite klijente" class="form-control w-50 m-auto">

    </div>
    @if(count($users) > 0)
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Klijent kreiran</th>
                <th scope="col">Prikaži</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    {{ $users->links() }}
    @else
    <h3>Nemate trenutno klijenata za prikaz</h3>
    @endif
</div>
<script>
    $(document).ready(function() {
        fetch_customer_data();

        function fetch_customer_data(query = '') {

            $.ajax({

                url: "{{ route('index.action') }}",
                method: 'get',
                data: {
                    '_token': '{{csrf_token()}}',
                    query: query

                },
                dataType: 'json',
                success: function(data) {
                    $('tbody').html(data.table_data);
                }
            });
        }

        $(document).on('keyup', '#search', function() {
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });
</script>
@endsection
