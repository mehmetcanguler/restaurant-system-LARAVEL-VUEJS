@extends('adminlte::page')

@section('title', 'Masalar')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Lokasyon Oluştur</h2>
    </div>
    <div class="card-body">
        <div class="d-none" id="alert"></div>
        <div class="row">
            <div class="form-group col-6">
                <input type="text" class="form-control" id="location">
                <button type="button" onclick="addTableLocation()" class="form-control btn btn-primary my-2">Lokasyon
                    Oluştur</button>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header">
            <h2>Masa Oluştur</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
                <form action="{{route('admin.table.store')}}" method="POST">
                    <div class="row">
                    @csrf
                <div class="col-6 form-group">
                    <label for="">Lokasyon Seçiniz</label>
                    <select class="form-control" name="table_location_id" id="table_location">
                        @foreach ($table_locations as $location)
                            <option value="{{ $location->id }}">{{ $location->title }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="">Oluşturulacak Masa Adeti Giriniz</label>
                    <input type="number" min="0" class="form-control" value="1" name="qty">
                </div>
                <button type="submit" class="form-control btn btn-primary">Masa Oluştur</button>
            </div>
        </form>
        </div>

    </div>
@endsection
@section('adminlte_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const addTableLocation = () => {
            let location_input = document.querySelector('#location');
            let title = location_input.value;
            let table_location_select = document.querySelector('#table_location');
            let alert = document.querySelector('#alert')
            $.ajax({
                url: "{{ route('admin.tableLocation') }}",
                method: "POST",
                data: {
                    'title': title,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(table_location) {
                    let option = document.createElement('option');
                    option.innerText = table_location.title
                    option.setAttribute('value', table_location.id);
                    table_location_select.appendChild(option)
                    location_input.value = ""
                    alert.classList.remove('d-none')
                    alert.classList.add('alert', 'alert-success')
                    alert.innerText = "Lokasyon Başarıyla Oluşturuldu"
                },
                error: function(error) {

                }

            });
        }
    </script>
@endsection
