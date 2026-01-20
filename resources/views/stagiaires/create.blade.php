<h1>Fiche Stagiaire:</h1>
<form action="{{ route('stagiaires.store') }}" method="POST">
    @csrf
    Nom : <input type="text" name="nom"><br>
    Prénom : <input type="text" name="prenom"><br>
    Age : <input type="text" name="age"><br>
    <button type="submit">Ajouter</button>
</form>
