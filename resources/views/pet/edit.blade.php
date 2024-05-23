@php($petStatus = \App\Enum\PetStatusEnum::cases())
@extends('main')
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/" class="text-primary mb-4 d-block">< POWRÓT</a>
        <form action="{{ isset($pet) ? route('pets.update', $pet) : route('pets.store') }}" method="POST">
            @if(isset($pet))
                @method('PUT')
            @endif
            @csrf
            <div class="form-group">
                <label for="name">Nazwa</label>
                <input type="text" name="name" class="form-control" id="name" {{ isset($pet['name']) ? 'value='.$pet['name'] : 'placeholder=Nazwa zwierzaka' }}>
            </div>
            <div class="form-group">
                <label for="photo">Zdjęcie</label>
                <input type="text" name="photoUrls" class="form-control" id="photo" {{ isset($pet['photoUrls']) ? 'value='.$pet['photoUrls'] : 'placeholder=URL' }}>
            </div>
            <div class="form-group">
                <label for="category">Kategoria</label>
                <select class="form-control" name="category" id="category">
                    @foreach($categories as $category)
                        <option {{ isset($pet) and $category->id == $pet['category_id'] ? 'selected' : ''}}>{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tagi</label>
                <input type="text" name="tags" class="form-control" id="tags" {{ isset($pet) and $pet->tags->isNotEmpty() ? '' : 'placeholder=Tagi'  }}>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    @foreach($petStatus as $status)
                        <option>{{ $status->value }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary float-right">ZAPISZ</button>
        </form>
    </div>
</div>
@endsection
