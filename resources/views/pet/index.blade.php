@extends('main')
@section('content')
<div class="row py-4">
    <div class="col-12 text-right m-0">
        <a href="{{ route('pets.create') }}" class="btn btn-success">DODAJ</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table">
            <thead class="thead-dark">
            <tr class="m-auto text-center">
                <th scope="col">Zdjęcie</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Tagi</th>
                <th scope="col">Status</th>
                <th scope="col">Czynność</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($pets as $pet)
                <tr>
                    <td><img style="width: 40px; height: 40px" src="{{ !empty($pet['photoUrls']) ? 'storage/pets/'.$pet['photoUrls'] : 'https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/afda6796352685.5eac47879e92f.jpg' }}" alt="Zdjęcie"/></td>
                    <td>{{ $pet['name'] }}</td>
                    <td>{{ $pet['category']['name'] }}</td>
                    <td>
                        @if($pet['tags']->isNotEmpty())
                            @foreach($pet['tags'] as $tag)
                                <span>{{ $tag['name'] }}</span>
                            @endforeach
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>{{ $pet['status'] }}</td>
                    <td>
                        <a href="{{ route('pets.edit', $pet) }}" class="text-primary">EDYTUJ</a>
                        <form action="{{ route('pets.destroy', $pet) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn text-danger">USUŃ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
