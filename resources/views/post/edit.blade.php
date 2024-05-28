@extends('layout')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3>Editer un post</h3>
                        <!-- Message d'information -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Formulaire -->
                        <form method="POST" action="{{ route('post.update', $post->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Content</label>
                                <input type="text" name="content" class="form-control" value="{{$post->content }}">
                            </div>
                            <div class="form-group">
                                <label>tags</label>
                                <input type="text" name="tags" class="form-control" value="{{ $post->tags }}">
                            </div>
                            <div class="form-group">
                                <label>image</label>
                                <input type="text" name="image" class="form-control" value="{{ $post->image }}">
                            </div>
                            
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm">Mettre à jour</button>
                        </form>
                        <!-- Fin du formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection