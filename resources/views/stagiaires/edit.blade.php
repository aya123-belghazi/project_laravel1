<h1>Modifier Stagiaire numéro: {{ $stagiaire['id'] }}</h1>
<form action="{{ route('stagiaires.update', $stagiaire['id']) }}" method="POST">
    @method("PUT")
    @csrf
    Nom : <input type="text" name="nom" value="{{ $stagiaire['nom'] }}"><br>
    Prénom : <input type="text" name="prenom" value="{{ $stagiaire['prenom'] }}"><br>
    Age : <input type="text" name="age" value="{{ $stagiaire['age'] }}"><br>
    <button type="submit">Modifier</button>
</form>
