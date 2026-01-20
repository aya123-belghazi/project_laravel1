<h1>Liste des stagiaires</h1>
<a href="{{ route('stagiaires.create') }}">Ajouter stagiaire</a>
<table border="1">
    <tr>
        <th>Id</th><th>Nom</th><th>Prénom</th><th>Age</th><th>Action</th>
    </tr>
    @foreach($stagiaires as $stagiaire)
    <tr>
        <td>{{ $stagiaire['id'] }}</td>
        <td>{{ $stagiaire['nom'] }}</td>
        <td>{{ $stagiaire['prenom'] }}</td>
        <td>{{ $stagiaire['age'] }}</td>
        <td>
            <a href="{{ route('stagiaires.show', $stagiaire['id']) }}">Show</a>
            <a href="{{ route('stagiaires.edit', $stagiaire['id']) }}">Edit</a>
            <form action="{{ route('stagiaires.destroy', $stagiaire['id']) }}" method="POST">
    @csrf
    @method('DELETE')
    <button>delete</button>
</form>
        </td>
    </tr>
    @endforeach
</table>

