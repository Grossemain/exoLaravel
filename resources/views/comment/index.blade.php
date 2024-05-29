@extends('layout')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">
                        <h3>Liste des commentaires</h3>
                        @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                        @endif
                        <!-- Tableau -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comment as $comment)
                                <tr>
                                    <th scope="row">{{$comment->id}}</th>
                                    <td>{{$comment->content}}</td>
                                    <td>{{$comment->tags}}</td>
                                    <td>{{$comment->image}}</td>
                                    <td>
                                        <a href="{{ route('comment.edit', $comment->id)}}" class="btn btn-primary btn-sm mb-4">Editer</a>
                                        <form action="{{ route('comment.destroy', $comment->id)}}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type=" submit">Supprimer</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Fin du Tableau -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection